<?php

namespace Tests\Unit\VendorProfile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendorProfileUnitTest extends TestCase

{
    use RefreshDatabase;
    
    public function test_should_show_user_vendor_profile()
    {
        $user = User::factory()->create([
            'email' => 'vendor@gmail.com',
            'password' => '111',
            'role' => 'vendor'
        ]);
    
        $this->assertEquals('vendor@gmail.com', $user->email);
    }
}