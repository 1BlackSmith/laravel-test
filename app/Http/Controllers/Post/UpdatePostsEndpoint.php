<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdatePostsEndpoint extends Controller
{
    public function __invoke(Request $request, Post $post): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'text' => ['required'],
        ]);

        $post->name = $data['name'];
        $post->text = $data['text'];
        $post->save();

        return response()->json($post->toArray());
    }
}
