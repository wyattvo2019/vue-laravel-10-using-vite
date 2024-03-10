<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('teachers')->insert(
            ['name' => 'John','age' => 35],
            ['name' => 'Lyn','age' => 40],
            ['name' => 'Adam','age' => 37]
        );
    }
}
