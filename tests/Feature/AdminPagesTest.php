<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard_page()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('page-admin-dashboard'));
        $response->assertStatus(200);
    }

    public function test_articles_page()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('page-admin-article-list'));
        $response->assertStatus(200);
    }

    public function test_categories_page()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('page-admin-category-list'));
        $response->assertStatus(200);
    }
}
