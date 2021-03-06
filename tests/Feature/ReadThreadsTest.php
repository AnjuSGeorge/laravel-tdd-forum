<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();

    }
    public function test_a_user_can_view_all_threads()
    {
       $response = $this->get('/threads')
        ->assertSee($this->thread->title);


    }
    function test_a_user_can_read_a_single_threads()
    {

         $this->get($this->thread->path())
        ->assertSee($this->thread->title);

    }
    function test_a_user_can_read_replies_associated_with_a_thread()
    {

        $reply =  factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }
}
