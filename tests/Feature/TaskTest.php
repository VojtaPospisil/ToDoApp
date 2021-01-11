<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TaskTest extends TestCase
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

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
