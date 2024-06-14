<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;
use App\Models\Role;
use App\Models\BlogPost;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    // set User / Admin
    protected $roleType = 'User';
    
    public function setUp(): void 
    {
        parent::setUp();
        $this->seed(); 
    }

    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_create_comment()
    {
        $response = $this->post('/comments', [
            'text' => 'Test Comment',
            'blog_post_id' => 1,
            'user_id' => 1,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_comment()
    {
        $user = User::factory()->create();
        $role = Role::where('name', $this->roleType)->first();
        $user->assignRole($role->id);

        $blogPost = BlogPost::first();

        $response = $this->actingAs($user)->post('/comments', [
            'comment' => 'Test Comment',
            'blog_post_id' => $blogPost->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('comments', [
            'comment' => 'Test Comment',
            'blog_post_id' => $blogPost->id,
            'user_id' => $user->id,
        ]); 
    }

    public function test_authenticated_user_can_delete_comment()
    {
        $user = User::factory()->create();
        $role = Role::where('name', $this->roleType)->first();
        $user->assignRole($role->id);

        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/comments/'.$comment->id);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]); 
    }
}
