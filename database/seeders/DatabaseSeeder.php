<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Aqui chamamos o ProductSeeder para popular o banco
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
