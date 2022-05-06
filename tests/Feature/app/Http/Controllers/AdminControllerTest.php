<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_use_can_view_login_view()
    {
        $response = $this->get(route('admin.login'));

        $response->assertSuccessful();
        $response->assertViewIs('admin.login');
    }

    public function test_admin_can_login_with_correct_credentials()
    {
        $admin = Admin::factory()->create();

        $response = $this->post(route('admin.login.insert'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.home'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }
}
