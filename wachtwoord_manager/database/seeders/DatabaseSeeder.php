<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Default User',
            'password' => bcrypt('Welkom123!')
        ]);

        $categories = [
            ['category_name' => 'Sociale media'],
            ['category_name' => 'E-mailaccounts'],
            ['category_name' => 'Werkaccounts'],
            ['category_name' => 'Overige'],
        ];
        
        DB::table('categories')->insert($categories);
    }
}
