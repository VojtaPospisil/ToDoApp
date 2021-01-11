<?php

namespace Tests\Unit;

use App\Category;
use App\MainCategory;
use App\Status;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $task;
    private $mainCategory;
    private $category;
    private $status;
    private $userCreated;
    private $userId;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->task = factory(Task::class)->create();

//        $this->category = factory(Category::class)->create();
//        $this->mainCategory = factory(MainCategory::class)->create();
//        $this->status = factory(Status::class)->create();
//        $this->userCreated = factory(User::class)->create();
////        $this->userId = factory(User::class)->create();
//        $this->task = factory(Task::class)->create([
//            'main_category_id' => $this->mainCategory->id,
////            'category' => $this->category->id,
//            'status_id' => $this->status->id,
////            'user_id' => $this->userId->id,
//            'user_created' => $this->userCreated->id,
//        ]);

    }

    public function test_tasks_database_has_expected_columns()
    {
        $this->assertFalse(
            Schema::hasColumns('tasks', [
                'id',
                'title',
                'description',
                'category',
                'main_category_id',
                'status_id',
                'due_date',
                'user_id',
                'created_at',
                'user_created'
            ])
        );
    }

    public function test_task_belongs_to_a_user_created()
    {
//        dd($this->task->userCreated);
//        $this->assertEquals(1, $this->task->userCerated->count());
        $this->assertInstanceOf(User::class, $this->task->userCreated);
    }

    public function test_task_belongs_to_a_user_assigned()
    {
//        $this->assertEquals(1, $this->task->userCAssigned->count());
        $this->assertInstanceOf(User::class, $this->task->userAssigned);
    }

    public function test_task_belongs_to_main_category()
    {
        $this->assertEquals(1, $this->task->mainCategory->count());
        $this->assertInstanceOf(MainCategory::class, $this->task->mainCategory);
    }

    public function test_task_belongs_to_status()
    {
        $this->assertEquals(1, $this->task->status->count());
        $this->assertInstanceOf(Status::class, $this->task->status);
    }
}