<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use WithoutModelEvents; // use WithoutModelEvents trait

    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_type' => 'System administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_type' => 'School administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_type' => 'Teacher',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_type' => 'Student',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_type' => 'Examination board',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_type' => 'Government agency',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
