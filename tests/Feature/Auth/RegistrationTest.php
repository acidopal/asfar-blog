<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void 
    {
        parent::setUp();
        $this->seed(); 
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Directly retrieve the user from the database
        $user = User::where('email', 'test@example.com')->first();

        // Assign the role to the user (if applicable)
        if ($user) {
            $role = Role::where('name', 'User')->first();
            $user->assignRole($role->id);
        }

        $this->assertAuthenticated();
        $response->assertRedirect(route('home.index'));
    }
}
