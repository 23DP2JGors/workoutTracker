<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
{
    $response = $this->post('/register', [
        'username' => 'testuser', // Changed from 'name'
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // Breeze API returns 204 No Content upon successful registration
    $response->assertNoContent(); 
    $this->assertAuthenticated();
}

}
