<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogPost;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as FakerFactory;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('name', 'Admin')->first();
    
        $faker = FakerFactory::create();
    
        for ($i = 0; $i < 10; $i++) {
            BlogPost::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => $user->id,
            ]);
        }
    }
}