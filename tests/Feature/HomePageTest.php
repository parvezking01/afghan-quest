<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    #[Test]
    public function homepage_loads_successfully()
    {
        $this->get('/')->assertStatus(200);
    }

    #[Test]
    public function provinces_page_loads()
    {
        $this->get('/provinces')->assertStatus(200);
    }

    #[Test]
    public function destinations_page_loads()
    {
        $this->get('/destinations')->assertStatus(200);
    }

    #[Test]
    public function hotels_page_loads()
    {
        $this->get('/hotels')->assertStatus(200);
    }

    #[Test]
    public function packages_page_loads()
    {
        $this->get('/packages')->assertStatus(200);
    }

    #[Test]
    public function login_page_loads()
    {
        $this->get('/login')->assertStatus(200);
    }

    #[Test]
    public function register_page_loads()
    {
        $this->get('/register')->assertStatus(200);
    }
}