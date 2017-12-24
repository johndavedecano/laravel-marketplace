<?php

namespace App\Functional\Api\V1\Controllers;

use App\User;
use App\Image;
use App\Location;
use App\TestCase;
use App\Functional\Api\V1\Controllers\LoginTrait;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageControllerTest extends TestCase
{
    use DatabaseMigrations, LoginTrait;

    protected $image;

    public function setUp()
    {
        parent::setUp();

        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => '123456',
            'is_superadmin' => true,
            'is_activated' => true
        ]);

        $user->save();

        $this->image = Image::create([
            'user_id' => $user->id,
            'default' => 'https://d3iw72m71ie81c.cloudfront.net/male-67.jpg',
            'medium' => 'https://d3iw72m71ie81c.cloudfront.net/male-67.jpg',
            'thumbnail' => 'https://d3iw72m71ie81c.cloudfront.net/male-67.jpg',
        ]);
    }

    public function testCreate()
    {
        Storage::fake('image');

        $login = $this->login('admin@email.com', '123456');
        
        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];
        
        $response = $this->withHeaders($headers)->json('POST', '/api/images', [
            'image' => UploadedFile::fake()->image('image.jpg')
        ]);

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $login = $this->login('admin@email.com', '123456');
        
        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];
        
        $response = $this->withHeaders($headers)->json('DELETE', '/api/images/'.$this->image->id);

        $response->assertStatus(200);
    }
}
