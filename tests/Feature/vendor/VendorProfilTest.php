<?php

namespace Tests\Feature\vendor;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendorProfilTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_access_vendor_profile_page()
    {
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => '111',
            'role' => 'vendor'
        ]);
        $response = $this->actingAs($user)->get('/vendor/profile');

        $response->assertStatus(200);
    }

    public function test_update_vendor_profile()
    {
        $user = User::factory()->create();

        $data = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ];

        $response = $this->actingAs($user)->post('/vendor/profile/store', $data);
        $response->assertStatus(302);
    }

}
