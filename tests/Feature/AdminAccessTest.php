<?php

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    #[Test]
    public function admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_approved' => true]);
        $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
    }

    #[Test]
    public function tourist_cannot_access_admin_dashboard()
    {
        $tourist = User::factory()->create(['role' => 'tourist', 'is_approved' => true]);
        $this->actingAs($tourist)->get('/admin/dashboard')->assertStatus(403);
    }

    #[Test]
    public function guest_cannot_access_admin_dashboard()
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    #[Test]
    public function admin_can_access_provinces_management()
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_approved' => true]);
        $this->actingAs($admin)->get('/admin/provinces')->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_bookings()
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_approved' => true]);
        $this->actingAs($admin)->get('/admin/bookings')->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_users_management()
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_approved' => true]);
        $this->actingAs($admin)->get('/admin/users')->assertStatus(200);
    }
}