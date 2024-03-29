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
            'thread_title' => ValidationTest::ACCEPT_TITLE,
            'first_name' => ValidationTest::ACCEPT_NAME,
            'first_message' => ValidationTest::ACCEPT_MESSAGE,
            'first_password' => ValidationTest::ACCEPT_PASSWORD,
        ]);

        $this->assertDatabaseHas('threads', [
            'title' => ValidationTest::ACCEPT_TITLE,
        ]);
    }

    public function test_post_comment(): void
    {
        $this->post('/thread', [
            'thread_title' => ValidationTest::ACCEPT_TITLE,
            'first_name' => ValidationTest::ACCEPT_NAME,
            'first_message' => ValidationTest::ACCEPT_MESSAGE,
            'first_password' => ValidationTest::ACCEPT_PASSWORD,
        ]);
        $this->post('/thread/1/comment', [
            'name' => ValidationTest::ACCEPT_NAME,
            'message' => ValidationTest::ACCEPT_MESSAGE,
            'password' => ValidationTest::ACCEPT_PASSWORD,
        ]);

        $this->assertDatabaseHas('comments', [
            'message' => ValidationTest::ACCEPT_MESSAGE,
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
