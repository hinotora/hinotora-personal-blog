<?php

namespace Tests\Feature;

use Tests\TestCase;

class OneArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_one_article()
    {
        $response = $this->get(route('page-article-detail', 'lets-hack-somebody-using-python'));
        $response->assertSee('Let\'s hack somebody using python')
            ->assertStatus(200);
    }

    public function test_unknown_article()
    {
        $response = $this->get(route('page-article-detail', 'nani'));
        $response->assertStatus(404);
    }
}
