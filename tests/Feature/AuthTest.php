<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_unauth_access()
    {
        $response = $this->get(route('page-admin-dashboard'));
        $response
            ->assertLocation(route('page-admin-login'))
            ->assertStatus(302);
    }

    public function test_show_login()
    {
        $response = $this->get(route('page-admin-login'));
        $response->assertStatus(200);
    }

    public function test_wrong_credentials()
    {
        $data = [
            '_token' => csrf_token(),
            'email' => 'wrong@mail.com',
            'password' => 'wrong',
        ];

        $response = $this->post(route('action-admin-login'), $data);

        $response
            ->assertLocation(route('page-admin-login'))
            ->assertStatus(400);
    }

    public function test_user_login()
    {
        $data = [
            '_token' => csrf_token(),
            'email' => 'example@mail.com',
            'password' => 'root',
        ];

        $response = $this->post(route('action-admin-login'), $data);

        $response
            ->assertLocation(route('page-admin-dashboard'))
            ->assertStatus(200);
    }

    public function test_user_logout() {
        $response = $this->get(route('action-admin-logout'));
        $response
            ->assertLocation(route('page-admin-login'))
            ->assertStatus(200);
    }
}
