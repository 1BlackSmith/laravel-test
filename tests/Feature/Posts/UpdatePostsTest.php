<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdatePostsTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccess()
    {
        $user = User::factory()->create();
        Post::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['banned' => false])
            ->putJson('/api/posts/1', [
                'name' => 'Test name',
                'text' => 'Test text',
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('id')
                ->has('user_id')
                ->has('created_at')
                ->has('name')
                ->has('text')
                ->etc()
            );
    }
}
