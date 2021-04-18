<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CRUDCategoryTest extends TestCase
{
    public function test_new_category_form_show_test()
    {
        $user = User::all()->first();

        $response = $this->actingAs($user)->get(route('page-admin-category-new'));
        $response->assertStatus(200);
    }

    public function TODOtest_add_category()
    {
        $user = User::all()->first();
        $file = 'file';

        $data = [
            '_token' => csrf_token(),
            'name' => 'TEST CATEGORY',
            'description' => 'TEST CATEGORY DESCRIPTION',
            'preview' => $file,
        ];

        $response = $this->actingAs($user)->post(route('action-admin-category-new'), $data);

        $response->assertStatus(201)
            ->assertLocation(route('page-admin-category-list'));
    }
}
