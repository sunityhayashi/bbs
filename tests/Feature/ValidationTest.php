<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

class ValidationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_post_thread_validate_ok(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'tanakatanaka',
        ]);
 
         $response->assertValid();
    }

    public function test_post_thread_validate_need_title(): void
    {
        $response = $this->post('/thread', [
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'tanakatanaka',
        ]);

        $response->assertInvalid(['thread_title']);
    }

    public function test_post_thread_validate_length_of_title_less_than_20(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'aaaa,aaaa,aaaa,aaaa,a',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'tanakatanaka',
        ]);

        $response->assertInvalid(['thread_title']);
    }

    public function test_post_thread_validate_length_of_name_less_than_20(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'aaaa,aaaa,aaaa,aaaa,a',
            'first_message' => 'test is difficult.',
            'first_password' => 'tanakatanaka',
        ]);

        $response->assertInvalid(['first_name']);
    }

    public function test_post_thread_validate_need_message(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_password' => 'tanakatanaka',
        ]);

        $response->assertInvalid(['first_message']);
    }

    public function test_post_thread_validate_length_of_message_less_than_100(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'aaaa,aaaa,aaaa,aaaa,a',
            'first_message' => 'aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,a',
            'first_password' => 'tanakatanaka',
        ]);

        $response->assertInvalid(['first_message']);
    }

    public function test_post_thread_validate_need_password(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
        ]);

        $response->assertInvalid(['first_password']);
    }

    public function test_post_thread_validate_length_of_password_over_than_6(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'aaaaa'
        ]);

        $response->assertInvalid(['first_password']);
    }

    public function test_post_thread_validate_length_of_password_leth_than_20(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'aaaa,aaaa,aaaa,aaaa,a'
        ]);

        $response->assertInvalid(['first_password']);
    }

    public function test_post_thread_validate_password_half_size_alphabet_or_number(): void
    {
        $response = $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'ああああああ'
        ]);

        $response->assertInvalid(['first_password']);
    }

    public function test_post_comment_validate_ok(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'message' => 'test is difficult.',
            'password' => 'tanakatanaka',
        ]);
 
         $response->assertValid();
    }

    public function test_post_comment_validate_length_of_name_leth_than_20(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'aaaa,aaaa,aaaa,aaaa,a',
            'message' => 'test is difficult.',
            'password' => 'tanakatanaka',
        ]);
 
         $response->assertInValid('name');
    }

    public function test_post_comment_validate_need_message(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'password' => 'tanakatanaka',
        ]);
 
         $response->assertInValid('message');
    } 

    public function test_post_comment_validate_length_of_message_leth_than_100(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'message' => 'aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,aaaa,a',
            'password' => 'tanakatanaka',
        ]);
 
         $response->assertInValid('message');
    }

    public function test_post_comment_validate_need_password(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'message' => 'test is difficult.',
        ]);
 
         $response->assertInValid('password');
    }

    public function test_post_comment_validate_password_more_than_6(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'message' => 'test is difficult.',
            'password' => 'tanak',
        ]);
 
         $response->assertInValid('password');
    }

    public function test_post_comment_validate_password_leth_than_20(): void
    {
        $this->seed();
        $response = $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'message' => 'test is difficult.',
            'password' => 'aaaa,aaaa,aaaa,aaaa,a',
        ]);
 
        $response->assertInValid('password');
    }

    public function test_delete_comment_validate_ok(): void
    {
        $this->seed();
        $response = $this->delete('/thread/1/comment/1', [
            'input_del_pass' => 'kenjikenji',
        ]);

        $response->assertValid();
    }

    public function test_delete_comment_validate_password_mutch(): void
    {
        $this->seed();
        $response = $this->delete('/thread/1/comment/1', [
            'input_del_pass' => 'kenjiken',
        ]);

        $response->assertInValid('input_del_pass');
    }
}

