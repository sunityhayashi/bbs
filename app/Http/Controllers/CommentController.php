<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Thread;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($thread_id)
    {
        $thread = Thread::find($thread_id);
        $comments = $thread->comments;
        return view('comment.index', ['thread_id' => $thread_id , 'comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $thread_id)
    {
        //コメントを追加
            $rules = [
                'name' => Comment::$rules['name'],
                'message' => Comment::$rules['message'],
                'password' => Comment::$rules['password'],
            ];
            $messages = [
                'password.regex' => Comment::$messages['password.regex'],
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect("/thread/{$thread_id}/comment")
                    ->withErrors($validator)
                    ->withInput();
            }

            $comment = new Comment;
            $comment->name = $request->name ?? '';
            $comment->message = $request->message;
            $comment->password = $request->password;
            $comment->thread_id = $thread_id;
            $comment->created_at = Carbon::now();
            $comment->save();

            $thread = Thread::find($comment->thread_id);
            $thread->updated_at = $comment->created_at;
            $thread->save();

            return redirect("/thread/{$thread_id}/comment");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $thread_id, string $id, Request $request)
    {
        //コメントを削除
            $comment = Comment::find($id);
            $rules = [
                'input_del_pass_'.$id => "in:{$comment->password}",
            ];
            $messages = [
                'input_del_pass_'.$id.'.in' => 'Password is not mutch.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect("/thread/{$thread_id}/comment/")
                    ->withErrors($validator)
                    ->withInput();
            }
            $comment->delete();
            return redirect("/thread/{$thread_id}/comment/");
    }
}
