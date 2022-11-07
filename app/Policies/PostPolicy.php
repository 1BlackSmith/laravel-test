<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function create(User $user): bool
    {
        return null !== $user->id;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
