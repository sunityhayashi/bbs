<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Thread;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads = Thread::orderBy('updated_at', 'desc')->simplePaginate(5);
        return view('thread.index', ['threads' => $threads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //スレッドと最初のコメントを追加
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

            return redirect("/thread/{$thread->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect("/thread/{$id}/comment");   
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
        /*
        $thread = Thread::find($id);
        $request->
        return view('bbs.show', ['thread' => $thread]);   
        */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
