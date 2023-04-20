<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     * @return void
     */
    use WithoutModelEvents;
    public function run()
    {
        DB::table('classes')->insert([
            ['class_name' => 'FORM I', 'created_at' => now(), 'updated_at' => now()],
            ['class_name' => 'FORM II', 'created_at' => now(), 'updated_at' => now()],
            ['class_name' => 'FORM III', 'created_at' => now(), 'updated_at' => now()],
            ['class_name' => 'FORM IV', 'created_at' => now(), 'updated_at' => now()],
            ['class_name' => 'FORM V', 'created_at' => now(), 'updated_at' => now()],
            ['class_name' => 'FORM VI', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
