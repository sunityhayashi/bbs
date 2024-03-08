<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = array('id');

    const TITLE_REQUIRED = true;
    const TITLE_LENGTH_MAX = 20;

    public static $rules = [
        'thread_title' => Comment::REQUIRED_CONVERT[self::TITLE_REQUIRED].'|max:'.self::TITLE_LENGTH_MAX,
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
