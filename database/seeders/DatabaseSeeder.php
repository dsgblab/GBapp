<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeDocumentIdentificationSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DesignPrioritySeeder::class,
            DesignStateSeeder::class,
            DesignTimeStateSeeder::class,
        ]);
    }
}
