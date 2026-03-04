<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            ArticleSeeder::class,
            DocumentSeeder::class,
            LinkSeeder::class,
            NewsSeeder::class,
            PhotoSeeder::class,
            SiteSeeder::class,
            VideoSeeder::class
        ]);
    }
}
