<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_redirects_to_home_on_successfull_login(): void
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/auth/login' => Http::response(([
                'data' => [
                    "access_token" => "valid_access_token",
                    "token_type" => "Bearer",
                    "user" => [
                        "id" => 1,
                        "name" => "Test User",
                        "email" => "testuser@gmail.com",
                        "personal_access_token" => "valid_personal_access_token",
                        "created_at" => now(),
                        "updated_at" => now()
                    ]
                ]
            ]), 200)
        ]);

        $response = $this->post('/login', [
            'email' => 'testuser@gmail.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect(('/home'));

        $this->assertEquals(session('token'), 'valid_access_token');
        $this->assertEquals(session('name'), 'Test User');
    }

    public function test_it_redirects_to_login_on_failed_login()
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/auth/login' => Http::response([
                'message' => 'Email atau password salah.'
            ], 401)
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'testuser@gmail.com',
            'password' => 'password'
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'Email atau password salah.');
    }

    public function test_it_redirects_to_login_on_successfull_registration()
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/auth/register' => Http::response([
                'data' => [
                    'name' => 'Test User',
                    'email' => 'testuser@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id' => 1
                ]
            ], 200)
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect('/');
    }

    public function test_it_redirects_to_register_on_failed_registration()
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/auth/register' => Http::response([
                'messages' => [
                    'email' => ['The email must be a valid email address.']
                ]
            ], 401)
        ]);

        $response = $this->from('/register')->post('/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect('/register');
        $response->assertSessionHas('error', 'Alamat email tidak valid.');
    }

    public function test_logout_redirects_to_login_successfull()
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/auth/register' => Http::response([
                'message' => 'logout success'
            ], 200)
        ]);

        $this->withSession([
            'token' => 'valid_access_token',
        ]);

        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }
}
