<?php

namespace Tests\Feature;

use Tests\TestCase;

class MainPagesTest extends TestCase
{
    public function test_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_articles_page()
    {
        $response = $this->get('/article');
        $response->assertStatus(200);
    }

    public function test_categories_page()
    {
        $response = $this->get('/category');
        $response->assertStatus(200);
    }

    public function test_contacts_page()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    public function test_about_page()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    public function test_unknown_page()
    {
        $response = $this->get('/ohayoo-gozaimasu');
        $response->assertStatus(404);
    }
}
