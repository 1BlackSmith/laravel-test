<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use DatabaseMigrations;

    protected string $seeder = UserSeeder::class;

    public function testSuccess()
    {
        $response = $this->getJson('/api/users');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->has('users.0', fn (AssertableJson $json) =>
                        $json
                            ->has('id')
                            ->has('created_at')
                            ->has('email')
                            ->has('first_name')
                            ->has('last_name')
                            ->has('secondary_name')
                            ->has('posts', 5, fn (AssertableJson $json) =>
                                $json
                                    ->has('id')
                                    ->has('created_at')
                                    ->has('name')
                                    ->has('text')
                                    ->etc()
                            )
                            ->etc()
                    )
                    ->has('users.1', fn (AssertableJson $json) =>
                        $json
                            ->has('id')
                            ->has('created_at')
                            ->has('email')
                            ->has('first_name')
                            ->has('last_name')
                            ->has('secondary_name')
                            ->has('comments', 5, fn (AssertableJson $json) =>
                                $json
                                    ->has('id')
                                    ->has('created_at')
                                    ->has('text')
                                    ->etc()
                            )
                            ->etc()
                    )
            );
    }
}
