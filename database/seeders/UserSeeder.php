<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    use WithoutModelEvents;

    public function run()
    {
        DB::table('users')->insert([
            [
                'firstname' => 'Akutaweji',
                'middlename' => 'Ayoub',
                'lastname' => 'Mtumbika',
                'email' => 'akutaweji@examsharing.com',
                'phone' => '+255762345678',
                'gender' => 'F',
                'password' => Hash::make('akutaweji123'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
