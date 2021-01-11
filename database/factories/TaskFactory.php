<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MainCategory;
use App\Status;
use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'description' => $faker->text,
        'due_date' => $faker->date(),
        'user_created' => factory(User::class)->create(),
        'user_id' => factory(User::class)->create(),
        'main_category_id' => factory(MainCategory::class)->create(),
        'status_id' => factory(Status::class)->create(),
    ];
});
