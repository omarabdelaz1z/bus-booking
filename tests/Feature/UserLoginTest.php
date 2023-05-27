<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserLoginTest extends TestCase
{
    public function test_correct_credentials_returns_success(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_incorrect_credentials_returns_unauthorized(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'john@example.com',
            'password' => 'password1',
        ]);

        $response->assertStatus(401);
    }
}
