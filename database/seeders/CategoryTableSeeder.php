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
                'type'     => 'income',
                'id_users' => 1,
            ],
            [
                'name'     => 'Freelance',
                'type'     => 'income',
                'id_users' => 1,
            ],
            [
                'name'     => 'Savings',
                'type'     => 'income',
                'id_users' => 1,
            ],
            [
                'name'     => 'Investment',
                'type'     => 'expense',
                'id_users' => 1,
            ],
            [
                'name'     => 'House Bills',
                'type'     => 'expense',
                'id_users' => 1,
            ],
            [
                'name'     => 'Food',
                'type'     => 'expense',
                'id_users' => 1,
            ],
        ];
        
        foreach ($category as $row) {
            DB::table('categories')->insert($row);
        }
    }
}
