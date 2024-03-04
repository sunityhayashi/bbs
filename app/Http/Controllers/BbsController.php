<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Thread;

class BbsController extends Controller
{
    //スレッドとコメントを取り出す
    public function index() {
        $threads = Thread::orderBy('updated_at', 'desc')->simplePaginate(5);
        return view('bbs.index', ['threads' => $threads]);
    }

    public function post(Request $request) {
        //スレッドと最初のコメントを追加
        if ($request->mode == 'add_thread') {
            $this->validate($request, Thread::$rules, Thread::$messages);
            $thread = new Thread;
            $thread->title = $request->thread_title;
            $thread->updated_at = Carbon::now();
            $thread->save();

            $comment = new Comment;
            $comment->name = $request->first_name ?? '';
            $comment->message = $request->first_message;
            $comment->password = $request->first_password;
            $comment->thread_id = $thread->id;
            $comment->created_at = Carbon::now();
            $comment->save();

            return redirect('/');
        } 
        
        //コメントを追加
        if ($request->mode == 'add_comment') {
            $rules = [
                'name_'.$request->thread_id => Comment::$rules['name'],
                'message_'.$request->thread_id => Comment::$rules['message'],
                'password_'.$request->thread_id => Comment::$rules['password'],
            ];
            $messages = [
                'password_'.$request->thread_id.'.regex' => Comment::$messages['password.regex'],
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect("/?page={$request->page}#show_thread_{$request->thread_id}")
                    ->withErrors($validator)
                    ->withInput();
            }

            $name_field = 'name_'.$request->thread_id;
            $message_field = 'message_'.$request->thread_id;
            $password_field = 'password_'.$request->thread_id;
            $comment = new Comment;
            $comment->name = $request->$name_field ?? '';
            $comment->message = $request->$message_field;
            $comment->password = $request->$password_field;
            $comment->thread_id = $request->thread_id;
            $comment->created_at = Carbon::now();
            $comment->save();

            $thread = Thread::find($comment->thread_id);
            $thread->updated_at = $comment->created_at;
            $thread->save();

            return redirect('/');
        }

        //コメントを削除
        if ($request->mode == 'delete_comment') {
            $comment = Comment::find($request->del_id);
            $rules = [
                'input_del_pass_'.$request->del_id => "in:{$comment->password}",
            ];
            $messages = [
                'input_del_pass_'.$request->del_id.'.in' => 'Password is not mutch.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect("/?page={$request->page}#show_thread_{$request->del_comment_thread_id}")
                    ->withErrors($validator)
                    ->withInput();
            }
            $comment->delete();
            return redirect("/?page={$request->page}#show_thread_{$request->del_comment_thread_id}");
        }
    }
}
