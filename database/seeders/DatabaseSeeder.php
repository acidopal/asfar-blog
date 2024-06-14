<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\CreateAdminSeeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\BlogPostSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            CreateAdminSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
