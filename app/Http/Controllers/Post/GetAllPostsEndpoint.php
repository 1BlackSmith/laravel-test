<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class GetAllPostsEndpoint extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'posts' => Post::with(['comments', 'comments.user', 'user'])->get(),
        ]);
    }
}
