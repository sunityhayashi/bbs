<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_post_thread(): void
    {
        $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'tanakatanaka',
        ]);

        $this->assertDatabaseHas('threads', [
            'title' => 'test',
        ]);
    }

    public function test_post_comment(): void
    {
        $this->post('/thread', [
            'thread_title' => 'test',
            'first_name' => 'tanaka',
            'first_message' => 'test is difficult.',
            'first_password' => 'tanakatanaka',
        ]);
        $this->post('/thread/1/comment', [
            'name' => 'tanaka',
            'message' => 'Today is Monday.',
            'password' => 'tanakatanaka',
        ]);

        $this->assertDatabaseHas('comments', [
            'message' => 'Today is Monday.',
        ]);


    }

    public function test_delete_comment(): void
    {
        $this->seed();
        $this->delete('/thread/1/comment/1');

        $this->assertDatabaseMissing('comments', [
            'id' => 1,
        ]);
    }
}
