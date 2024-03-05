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
                'name_'.$thread_id => Comment::$rules['name'],
                'message_'.$thread_id => Comment::$rules['message'],
                'password_'.$thread_id => Comment::$rules['password'],
            ];
            $messages = [
                'password_'.$thread_id.'.regex' => Comment::$messages['password.regex'],
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect(ThreadController::convert_id_to_url($thread_id))
                    ->withErrors($validator)
                    ->withInput();
            }

            $name_of_name = 'name_'.$thread_id;
            $name_of_message = 'message_'.$thread_id;
            $name_of_password = 'password_'.$thread_id;
            $comment = new Comment;
            $comment->name = $request->$name_of_name ?? '';
            $comment->message = $request->$name_of_message;
            $hash_password = password_hash($request->$name_of_password, PASSWORD_DEFAULT, ['cost' => 10]);
            $comment->password = $hash_password;
            $comment->thread_id = $thread_id;
            $comment->created_at = Carbon::now();
            $comment->save();

            $thread = Thread::find($comment->thread_id);
            $thread->updated_at = $comment->created_at;
            $thread->save();

            return redirect(ThreadController::convert_id_to_url($thread_id));
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
                'input_del_pass_'.$id => "password_accept:{$comment->password}",
            ];
            $messages = [
                'input_del_pass_'.$id.'.password_accept' => 'Password is not mutch.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect(ThreadController::convert_id_to_url($thread_id))
                    ->withErrors($validator)
                    ->withInput();
            }
            $comment->delete();
            return redirect(ThreadController::convert_id_to_url($thread_id));
    }
}
