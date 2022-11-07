<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class GetAllUsersEndpoint extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'users' => User::with(['posts', 'comments'])->get(),
        ]);
    }
}
