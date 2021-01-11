<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
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

    public function test_user_can_access_category()
    {
        $response = $this->actingAs($this->admin)->get('admin/category');
        $response->assertStatus(200);
        $response->assertViewIs('category.index');
    }

    public function test_user_cannot_access_category()
    {
//        $user = $this->createUser();
        $response = $this->actingAs($this->guest)->get('admin/category');
        $response->assertStatus(302);
    }

    public function test_create_form_category()
    {
//        $user = $this->createUser(1);
        $response = $this->actingAs($this->admin)->get('admin/category/create');
        $response->assertStatus(200);
        $response->assertSee('form');
        $response->assertSee('Vytvořit kategorii');
    }

    public function test_create_category()
    {
//        $user = $this->createUser(1);
        $category = factory(Category::class)->create();
        $response = $this->actingAs($this->admin)->get('admin/category');

        $response->assertStatus(200);
        $response->assertSee($category->name);
        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'description' => $category->description,
            ]);
//        $response->assertRedirect('admin/category');
        $response->assertViewIs('category.index');
    }

    public function test_edit_form_category()
    {
//        $user = $this->createUser(1);
        $category = factory(Category::class)->create();
        $response = $this->actingAs($this->admin)->get('admin/category/' . $category->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee('Upravit kategorii');
        $response->assertSee('value="'.$category->id.'"', false);
        $response->assertSee('value="'.$category->name.'"', false);
        $response->assertSee('value="'.$category->description.'"', false);
    }

    public function test_edit_category()
    {
//        $user = $this->createUser(1);
        $category = factory(Category::class)->create();
        $response = $this->actingAs($this->admin)->post('admin/category', [
            '__token' => csrf_token(),
            'id' => $category->id,
            'name' => 'novy nazev',
            'description' => 'novy popis'
        ]);

        $editedCategory = Category::findOrFail($category->id);
        $response->assertStatus(302);
        $this->assertEquals('novy nazev', $editedCategory->name);
        $this->assertEquals('novy popis', $editedCategory->description);
        $response->assertRedirect('admin/category');
    }
}
