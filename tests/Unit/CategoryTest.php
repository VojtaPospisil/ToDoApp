<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $task;


    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
//        $this->user = factory(User::class)->create();
//        $this->task = factory(Task::class)->create();
    }

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
//
//    public function test_category_database_has_expected_columns()
//    {
//        $this->assertTrue(
//            Schema::hasColumns('categories', [
//                'id', 'name', 'description', 'created_at', 'updated_at'
//                ])
//        );
//    }

//    public function test_category_belongs_to_many_task()
//    {
//        $this->assertEquals(1, $this->task->category->count());
//        $this->assertInstanceOf(Task::);
//    }
}
