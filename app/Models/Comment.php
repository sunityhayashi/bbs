<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');

    const NAME_REQUIRED = false;
    const NAME_LENGTH_MAX = 20;
    const MESSAGE_REQUIRED = true;
    const MESSAGE_LENGTH_MAX = 100;
    const PASSWORD_REQUIRED = true;
    const PASSWORD_LENGTH_MIN = 6;
    const PASSWORD_LENGTH_MAX = 20;
    const PASSWORD_HALF_SIZE_ALPHABET_OR_NUMBER = true;

    const REQUIRED_CONVERT = [true => 'required', false => ''];
    const HALF_SIZE_ALPHABET_OR_NUMBER_CONVERT = [true => 'regex:/^[a-zA-Z0-9]*$/', false => ''];

    const RULE_NAME = 'max:'.self::NAME_LENGTH_MAX;
    const RULE_MESSAGE = self::REQUIRED_CONVERT[self::MESSAGE_REQUIRED].'|max:'.self::MESSAGE_LENGTH_MAX;
    const RULE_PASSWORD = self::REQUIRED_CONVERT[self::PASSWORD_REQUIRED].'|'.self::HALF_SIZE_ALPHABET_OR_NUMBER_CONVERT[self::PASSWORD_HALF_SIZE_ALPHABET_OR_NUMBER].'|between:'.self::PASSWORD_LENGTH_MIN.','.self::PASSWORD_LENGTH_MAX;

    public static $rules = [
        'name' => self::RULE_NAME,
        'message' => self::RULE_MESSAGE,
        'password' => self::RULE_PASSWORD,
    ];
    
    
    public static $messages = [
        'password.regex' => 'Password consists of alphabets or numbers.',
    ];

    

}
