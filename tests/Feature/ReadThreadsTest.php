<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }
    /** @test */
    public function a_user_can_view_all_threads()
    {

        $this->get('/threads')
        ->assertSee($this->thread->title);
    }

     /** @test */
     public function a_user_can_view_specific_thread()
     {
        $this->get('/threads/'. $this->thread->id)
        ->assertSee($this->thread->title);
     }
     /** @test */
    public function a_user_can_see_a_replies_that_is_associated_with_thread()
    {
        //Given we have a thread
        //And That Thread includes replaies
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        //When we visit the page
        $this->get('/threads/'. $this->thread->id)
            ->assertSee($reply->body);
        //Then we should see the replies
    }

}
