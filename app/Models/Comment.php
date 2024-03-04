<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');

    public static $rules = [
        'name' => 'max:20',
        'message' => 'required|max:100',
        'password' => 'required|regex:/^[a-zA-Z0-9]*$/|between:6,20'
    ];
    
    
    public static $messages = [
        'password.regex' => 'Password consists of alphabets or numbers.',
    ];

    

}
