<?php

namespace Tests\Unit\AdminProfile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AdminProfileUnitTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_should_show_user_admin_profile()
    {
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => '111',
            'role' => 'admin'
        ]);

        $this->assertEquals('admin@gmail.com', $user->email);
        
    }
}
