<?php

namespace Tests\Feature;

use Tests\TestCase;

class OneCategoryTest extends TestCase
{
    public function test_one_category()
    {
        $response = $this->get(route('page-category-detail', 'php-series'));
        $response
            ->assertSee('PHP Series')
            ->assertStatus(200);
    }

    public function test_unknown_category()
    {
        $response = $this->get(route('page-category-detail', 'onii-chan'));
        $response->assertStatus(404);
    }
}
