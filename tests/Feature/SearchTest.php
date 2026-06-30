<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchTest extends TestCase
{
    #[Test]
    public function search_page_loads()
    {
        $this->get('/search?q=kabul')->assertStatus(200);
    }

    #[Test]
    public function search_with_empty_query_works()
    {
        $this->get('/search?q=')->assertStatus(200);
    }
}