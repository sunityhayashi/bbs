<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');

    const RULE_NAME = 'max:20';
    const RULE_MESSAGE = 'required|max:100';
    const RULE_PASSWORD = 'required|regex:/^[a-zA-Z0-9]*$/|between:6,20';

    public static $rules = [
        'name' => self::RULE_NAME,
        'message' => self::RULE_MESSAGE,
        'password' => self::RULE_PASSWORD,
    ];
    
    
    public static $messages = [
        'password.regex' => 'Password consists of alphabets or numbers.',
    ];

    

}
