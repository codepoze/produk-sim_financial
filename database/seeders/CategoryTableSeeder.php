<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name'     => 'Salary',
                'by_users' => 1,
            ],
            [
                'name'     => 'Freelance',
                'by_users' => 1,
            ],
            [
                'name'     => 'Savings',
                'by_users' => 1,
            ],
            [
                'name'     => 'Investment',
                'by_users' => 1,
            ],
            [
                'name'     => 'House Bills',
                'by_users' => 1,
            ],
            [
                'name'     => 'Food',
                'by_users' => 1,
            ],
        ];
        foreach ($category as $row) {
            DB::table('categories')->insert($row);
        }
    }
}
