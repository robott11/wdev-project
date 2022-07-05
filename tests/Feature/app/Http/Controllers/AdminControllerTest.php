<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{

    public function test_admin_login_view()
    {
        $response = $this->get(route('admin.login'));

        $response->assertSuccessful();
        $response->assertViewIs('admin.login');
    }

    public function test_successful_admin_login()
    {
        $password = 'password123';
        $admin = Admin::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post(route('admin.login.insert'), [
            'email' => $admin->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('admin.home'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_login_with_missing_credentials()
    {
        $response = $this->post(route('admin.login.insert'));

        $response->assertRedirect();
        $response->assertSessionHas('errors');
    }

    public function test_admin_login_with_wrong_credentials()
    {
        $admin = Admin::factory()->create();

        $response = $this->post(route('admin.login.insert'), [
            'email' => 'example@email.com',
            'password' => 'blabla'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('errors');
    }

    public function test_admin_index_view_authenticated()
    {
        $admin = Admin::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.home'));

        $response->assertViewIs('admin.home');
        $this->assertAuthenticatedAs($admin, 'admin');
    }
}
