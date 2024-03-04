<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = array('id');

    public static $rules = [
        'thread_title' => 'required|max:20',
        'first_name' => 'max:20',
        'first_message' => 'required|max:100',
        'first_password' => 'required|regex:/^[a-zA-Z0-9]*$/|between:6,20',
    ];

    public static $messages = [
        'first_password.regex' => 'Password consists of alphabets or numbers.',
    ];

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
