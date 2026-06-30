<?php

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthTest extends TestCase
{
    #[Test]
    public function user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'role' => 'tourist',
            'is_approved' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/tourist/dashboard');
        $this->assertAuthenticated();
    }

    #[Test]
    public function user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'test2@test.com',
            'password' => bcrypt('password'),
            'role' => 'tourist',
        ]);

        $response = $this->post('/login', [
            'email' => 'test2@test.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    #[Test]
    public function user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'newuser@test.com',
            'phone' => '0700000001',
            'whatsapp' => '0700000001',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'tourist',
        ]);

        $response->assertRedirect('/tourist/dashboard');
        $this->assertDatabaseHas('users', ['email' => 'newuser@test.com']);
    }

    #[Test]
    public function hotel_owner_registration_requires_approval()
    {
        $response = $this->post('/register', [
            'name' => 'Hotel Owner',
            'email' => 'owner@test.com',
            'phone' => '0700000002',
            'whatsapp' => '0700000002',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'hotel_owner',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'email' => 'owner@test.com',
            'is_approved' => false,
        ]);
    }
}