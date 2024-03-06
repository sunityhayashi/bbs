<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Thread;
use App\Helpers\Helper;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads = Thread::orderBy('updated_at', 'desc')->simplePaginate(Helper::NUMBER_OF_THREADS_BY_PAGE);
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
        $validator = Validator::make($request->all(), Thread::$rules, Thread::$messages);
        if ($validator->fails()) {
            return redirect("/thread")
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::beginTransaction();
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
            DB::commit();
            return redirect(Helper::convert_id_to_url($thread->id));
        } catch (\Exception) {
            DB::rollback();
            return redirect('/thread');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
