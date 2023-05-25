<?php

namespace App\Http\Services;

use App\Exceptions\InvalidCredentialException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param  array  $credentials ['email' => string, 'password' => string]
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function authenticate($credentials)
    {
        $user = User::query()->where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialException('Invalid credentials');
        }

        return $user;
    }

    /**
     * @param  array  $credentials ['name' => string, 'email' => string, 'password' => string]
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function register($credentials)
    {
        $hashedPassword = bcrypt($credentials['password']);

        return User::query()->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $hashedPassword,
        ]);
    }
}
