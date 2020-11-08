<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_categories')->insert([
            [
                'name' => 'Nice To Have'
            ], [
                'name' => 'Must Have'
            ]
        ]);
    }
}
