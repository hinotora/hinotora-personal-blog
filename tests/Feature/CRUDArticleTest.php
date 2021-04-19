<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CRUDArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_article_form_show_test()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('page-admin-article-new'));
        $response->assertStatus(200);
    }

    public function test_add_article()
    {
        $user = User::all()->first();

        Storage::fake('test');

        $file = UploadedFile::fake()->image('preview.jpg');

        $data = [
            '_token' => csrf_token(),
            'category' => 1,
            'title' => 'HELLO WORLD',
            'description' => 'HELLO WORLD',
            'preview' => $file,
            'body' => 'Hello world',
        ];

        $response = $this->actingAs($user)->post(route('action-admin-article-new'), $data);

        $response->assertRedirect(route('page-admin-article-list'));
    }

    public function test_update_article()
    {
        $user = User::all()->first();

        $data = [
            '_token' => csrf_token(),
            'category' => 1,
            'title' => 'UPDATED ARTICLE',
            'description' => 'UPDATED DESC',
            'body' => 'updated body',
        ];

        $response = $this->actingAs($user)->post(route('action-admin-article-update', ['id' => 1]), $data);

        $response->assertRedirect(route('page-admin-article-list'));
    }

    public function test_delete_article()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('action-admin-article-delete', ['id' => 1]));

        $response->assertRedirect(route('page-admin-article-list'));
    }
}
