<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use App\Models\Comment;
use App\Models\Thread;

class ValidationTest extends TestCase
{
    const ACCEPT_TITLE = 'test';
    const TOO_LONG_TITLE = 'aaaa,aaaa,aaaa,aaaa,a';
    const ACCEPT_NAME = 'tanaka';
    const TOO_LONG_NAME = 'aaaa,aaaa,aaaa,aaaa,a';
    const ACCEPT_MESSAGE = 'Test is difficult.';
    const TOO_LONG_MESSAGE = 'aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,a';
    const ACCEPT_PASSWORD = 'tanakatanaka';
    const TOO_SHORT_PASSWORD = 'aaaa,';
    const TOO_LONG_PASSWORD = 'aaaa,aaaa,aaaa,aaaa,a';
    const NOT_HALF_SIZE_ALPHABET_OR_NUMBER_PASSWORD = 'ああああああ';

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */ 

    /**
     * @dataProvider formDataExample
    */
    public function test_post_thread_validation($items, $data, $expect): void
    {
        $datalist = array_combine($items, $data);
        $response = $this->post('/thread', $datalist);
 
        if ($expect) {
            $response->assertValid();
        } else {
            $response->assertInValid();
        }
    }

    public static function formDataExample()
    {
        return [
            'OK' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::ACCEPT_MESSAGE, self::ACCEPT_PASSWORD],
                true
            ],
            'no title NG' => [
                ['first_name', 'first_message', 'first_password'],
                [self::ACCEPT_NAME, self::ACCEPT_MESSAGE, self::ACCEPT_PASSWORD],
                false
            ],
            'too long title NG' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::TOO_LONG_TITLE, self::ACCEPT_NAME, self::ACCEPT_MESSAGE, self::ACCEPT_PASSWORD],
                false
            ],
            'no name OK' => [
                ['thread_title', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_MESSAGE, self::ACCEPT_PASSWORD],
                true
            ],
            'too long name NG' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::TOO_LONG_NAME, self::ACCEPT_MESSAGE, self::ACCEPT_PASSWORD],
                false
            ],
            'no message NG' => [
                ['thread_title', 'first_name', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::ACCEPT_PASSWORD],
                false
            ],
            'too long message NG' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::TOO_LONG_MESSAGE, self::ACCEPT_PASSWORD],
                false
            ],
            'no password' => [
                ['thread_title', 'first_name', 'first_message'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::ACCEPT_MESSAGE],
                false
            ],
            'too short password' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::ACCEPT_MESSAGE, self::TOO_SHORT_PASSWORD],
                false
            ],
            'too long password' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::ACCEPT_MESSAGE, self::TOO_LONG_PASSWORD],
                false
            ],
            'not half size alphabet or number password NG' => [
                ['thread_title', 'first_name', 'first_message', 'first_password'],
                [self::ACCEPT_TITLE, self::ACCEPT_NAME, self::ACCEPT_MESSAGE, self::NOT_HALF_SIZE_ALPHABET_OR_NUMBER_PASSWORD],
                false
            ],
        ];
    }
}