<?php

namespace farazasifali\Larapress\Tests\Feature;

use farazasifali\Larapress\Models\Post;
use farazasifali\Larapress\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SavePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created_with_the_factory()
    {
        //Creating post
        Post::factory()->create();

        $this->assertCount(1, Post::all());
    }
}
