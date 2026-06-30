<?php

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TouristAccessTest extends TestCase
{
    #[Test]
    public function tourist_can_access_their_dashboard()
    {
        $tourist = User::factory()->create(['role' => 'tourist', 'is_approved' => true]);
        $this->actingAs($tourist)->get('/tourist/dashboard')->assertStatus(200);
    }

    #[Test]
    public function tourist_can_view_their_bookings()
    {
        $tourist = User::factory()->create(['role' => 'tourist', 'is_approved' => true]);
        $this->actingAs($tourist)->get('/tourist/bookings')->assertStatus(200);
    }

    #[Test]
    public function tourist_can_view_profile()
    {
        $tourist = User::factory()->create(['role' => 'tourist', 'is_approved' => true]);
        $this->actingAs($tourist)->get('/tourist/profile')->assertStatus(200);
    }

    #[Test]
    public function booking_requires_login()
    {
        $this->get('/book/package/test-package')->assertRedirect('/login');
    }
}