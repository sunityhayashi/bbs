<?php 

namespace App\Helpers;

use App\Models\Thread;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class Helper 
{
    public const NUMBER_OF_THREADS_BY_PAGE = 5;

    public static function convert_id_to_url($id)
    {
        $updated_at = Thread::find($id)->updated_at;
        $number = Thread::where('updated_at', '>=', $updated_at)->count();
        $page = (int)($number / self::NUMBER_OF_THREADS_BY_PAGE) + 1;
        return "thread/?page={$page}#show_thread_{$id}";
    }

    public static function is_add_comment_thread_id($thread_id)
    {
        return Session::has('add_comment_thread_id') && $thread_id == Session::get('add_comment_thread_id');
    }

    public static function is_delete_comment_id($comment_id)
    {
        return Session::has('delete_comment_id') && $comment_id == Session::get('delete_comment_id');
    }
}