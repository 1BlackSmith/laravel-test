<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class RegistrationEndpoint extends Controller
{
    public function __invoke(Request $request): Response
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'secondary_name' => ['required'],
        ]);

        if (1 === User::query()->where('email', $data['email'])->count()) {
            return response('Email already exists.', SymfonyResponse::HTTP_BAD_REQUEST);
        }

        $user = new User([
            ...$data,
            'password' => Hash::make($data['password']),
        ]);
        $user->save();

        return response('Success register.', SymfonyResponse::HTTP_CREATED);
    }
}
