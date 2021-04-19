<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CRUDCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_category_form_show_test()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('page-admin-category-new'));
        $response->assertStatus(200);
    }

    public function test_add_category()
    {
        $user = User::all()->first();

        Storage::fake('test');

        $file = UploadedFile::fake()->image('preview.jpg');

        $data = [
            '_token' => csrf_token(),
            'name' => 'TEST CATEGORY',
            'description' => 'TEST CATEGORY DESCRIPTION',
            'preview' => $file,
        ];

        $response = $this->actingAs($user)->post(route('action-admin-category-new'), $data);

        $response->assertRedirect(route('page-admin-category-list'));
    }

    public function test_update_category()
    {
        $user = User::all()->first();

        $data = [
            '_token' => csrf_token(),
            'name' => 'UPDATED CATEGORY',
            'description' => 'UPDATED DESCR',
        ];

        $response = $this->actingAs($user)->post(route('action-admin-category-update', ['id' => 1]), $data);

        $response->assertRedirect(route('page-admin-category-list'));
    }

    public function test_delete_category()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('action-admin-category-delete', ['id' => 1]));

        $response->assertRedirect(route('page-admin-category-list'));
    }
}
