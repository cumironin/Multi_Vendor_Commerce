<?php

namespace Tests\Feature\admin;

use App\Http\Controllers\BrandController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_access_brand_page()
    {
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);
        $response = $this->actingAs($user)->get('/all/brand');

        $response->assertStatus(200);
    }

    public function test_insert_image_brand()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post(action([BrandController::class, 'StoreBrand']), [
            'brand_name' => 'Doku',
            'brand_image' => $file
        ]);
        
        $response->assertStatus(302);
    }
}
