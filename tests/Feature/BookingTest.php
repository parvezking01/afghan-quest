<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BookingTest extends TestCase
{
    #[Test]
    public function booking_page_requires_login()
    {
        $this->get('/book/package/sample-package')->assertRedirect('/login');
    }
}