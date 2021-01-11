<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    private $guest;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = $user = $this->createUser('admin@email.com',1);
        $this->guest = $user = $this->createUser('guest@email.com');
    }

    private function createUser($email, $is_admin = 0)
    {
        return factory(User::class)->create([
            'email' => $email,
            'password' => bcrypt('adminadmin'),
            'is_admin' => $is_admin,
        ]);
    }

    public function test_see_admin_login_form()
    {
        $response = $this->get('admin/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_authenticated_cannot_see_admin_login_form()
    {
        $response = $this->actingAs($this->admin)->get('admin/login');
        $response->assertRedirect('admin');
    }

    public function test_admin_login_fail()
    {
        $response = $this->call('POST', 'admin/login', [
           'email' => $this->guest->email,
            'password' => 'adminadmin',
            '__token' => csrf_token()
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_admin_login_pass()
    {
        $response = $this->call('POST', 'admin/login', [
            'email' => $this->admin->email,
            'password' => 'adminadmin',
            '__token' => csrf_token()
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('admin');
    }
}
