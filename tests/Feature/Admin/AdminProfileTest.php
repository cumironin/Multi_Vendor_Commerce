<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_access_profile_page()
    {
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => '111',
            'role' => 'admin'
        ]);


        $response = $this->actingAs($user)->get('/admin/profile');

        $response->assertStatus(200);
    }

    public function test_update_admin_profile()
    {
        $user = User::factory()->create();

        $data = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address()
        ];

        $response = $this->actingAs($user)->post('/admin/profile/store', $data);
        $response->assertStatus(302);
    }
}
