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
            ProductSeeder::class,
            OrderSeeder::class,
            OptionSeeder::class,
            CustomerSeeder::class,
            CategorieSeeder::class,
            ProductCategorieSeeder::class,
            ProductOptionSeeder::class,
            OrderDetailSeeder::class,
        ]);
    }
}
