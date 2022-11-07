<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeletePostsTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccess()
    {
        $user = User::factory()->create();
        Post::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('/api/posts/1');

        $response->assertStatus(Response::HTTP_OK);
    }
}
