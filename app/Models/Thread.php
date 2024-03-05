<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = array('id');

    public static $rules = [
        'thread_title' => 'required|max:20',
        'first_name' => Comment::RULE_NAME,
        'first_message' => Comment::RULE_MESSAGE,
        'first_password' => Comment::RULE_PASSWORD,
    ];

    public static $messages = [
        'first_password.regex' => 'Password consists of alphabets or numbers.',
    ];

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
