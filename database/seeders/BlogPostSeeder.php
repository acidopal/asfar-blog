<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogPost;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('name', 'Admin')->first();

        BlogPost::create([
            'title' => 'Hello World!', 
            'content' => 'Hello World!',
            'user_id' => $user->id,
        ]);
    }

}