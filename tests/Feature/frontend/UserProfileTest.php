<?php

namespace Tests\Feature\frontend;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_access_user_profile_page()
    {
        $user = User::factory()->create([
            'email' => 'user@gmail.com',
            'role' => 'user'
        ]);
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200)
                 ->assertSeeText('Home', $escaped = true);
    }

    public function test_update_user_profile()
    {
        $user = User::factory()->create();

        $data = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address()
        ];

        $response = $this->actingAs($user)->post('/user/profile/store', $data);
        $response->assertStatus(302);
    }

    public function test_update_user_password()
    {
        $user = User::factory()->create();

        $data = [
            'old_password' => '123',
            'new_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];

        $response = $this->actingAs($user)->post('/user/update/password', $data);

        $this->assertEquals($data['new_password'], $user['password']);
        $response->assertStatus(302);

    }
}
