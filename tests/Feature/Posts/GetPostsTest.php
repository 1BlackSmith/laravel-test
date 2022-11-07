<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetPostsTest extends TestCase
{
    use DatabaseMigrations;

    protected string $seeder = PostSeeder::class;

    public function testSuccess()
    {
        $response = $this->getJson('/api/posts');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->has('posts', 3, fn (AssertableJson $json) =>
                        $json
                            ->has('id')
                            ->has('user_id')
                            ->has('created_at')
                            ->has('name')
                            ->has('text')
                            ->has('comments', 5, fn (AssertableJson $json) =>
                                $json
                                    ->has('id')
                                    ->has('user_id')
                                    ->has('created_at')
                                    ->has('text')
                                    ->has('user', fn (AssertableJson $json) =>
                                        $json
                                            ->has('id')
                                            ->has('created_at')
                                            ->has('email')
                                            ->has('first_name')
                                            ->has('last_name')
                                            ->has('secondary_name')
                                            ->etc()
                                    )
                                    ->etc()
                            )
                            ->has('user', fn (AssertableJson $json) =>
                                $json
                                    ->has('id')
                                    ->has('created_at')
                                    ->has('email')
                                    ->has('first_name')
                                    ->has('last_name')
                                    ->has('secondary_name')
                                    ->etc()
                            )
                            ->etc()
                    )
            );
    }
}
