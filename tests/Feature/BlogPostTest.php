<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\Role;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    // set User / Admin
    protected $roleType = 'Admin';
    
    public function setUp(): void 
    {
        parent::setUp();
        $this->seed(); 
    }

    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_create_blog_post()
    {
        $response = $this->post('/blog-posts', [
            'title' => 'Test Blog Post',
            'content' => 'Test content.',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_blog_post()
    {
        $user = User::factory()->create();
        $role = Role::where('name', $this->roleType)->first();
        $user->assignRole($role->id);

        $response = $this->actingAs($user)->post('/blog-posts', [
            'title' => 'Test Blog Post',
            'content' => 'Test content.',
        ]);

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test Blog Post',
            'content' => 'Test content.',
            'user_id' => $user->id,
        ]); 
    }

    public function test_authenticated_user_can_update_blog_post()
    {
        // Create a user and assign a role
        $user = User::factory()->create();
        $role = Role::where('name', $this->roleType)->first();
        $user->assignRole($role->id);
    
        // Create a blog post owned by the user
        $blogPost = BlogPost::factory()->create(['user_id' => $user->id]);
    
        // New data for updating the blog post
        $newData = [
            'title' => 'Updated Test Blog Post',
            'content' => 'Updated Test content.',
        ];
    
        // Send a PUT request to update the blog post
        $response = $this->actingAs($user)->put('/blog-posts/'.$blogPost->id, $newData);
    
        // Assert that the database has the updated blog post
        $this->assertDatabaseHas('blog_posts', [
            'id' => $blogPost->id,
            'title' => $newData['title'],
            'content' => $newData['content'],
            'user_id' => $user->id,
        ]); 
    }

    public function test_authenticated_user_can_delete_blog_post()
    {
        $user = User::factory()->create();
        $role = Role::where('name', $this->roleType)->first();
        $user->assignRole($role->id);

        $blogPost = BlogPost::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/blog-posts/'.$blogPost->id);

        $this->assertDatabaseMissing('blog_posts', [
            'id' => $blogPost->id,
        ]); 
    }
}