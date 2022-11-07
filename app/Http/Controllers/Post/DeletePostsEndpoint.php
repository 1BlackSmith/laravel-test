<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DeletePostsEndpoint extends Controller
{
    public function __invoke(Request $request, Post $post): Response
    {
        $post->delete();

        return response('Post is deleted.');
    }
}
