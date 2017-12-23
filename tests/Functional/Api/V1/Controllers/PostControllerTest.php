<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\Category;
use App\Image;
use App\Post;
use App\Location;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Controllers\LoginTrait;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations, LoginTrait;

    protected $admin;

    protected $user;

    protected $image;

    protected $category;

    public function setUp()
    {
        parent::setUp();

        $this->location = Location::create(['name' => 'Pasig City']);

        $this->user = new User([
            'name' => 'Test',
            'email' => 'test@email.com',
            'password' => '123456',
            'is_activated' => true
        ]);

        $this->user->save();

        $this->admin = new User([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => '123456',
            'is_superadmin' => true,
            'is_activated' => true
        ]);

        $this->admin->save();

        $this->category = Category::create(['name' => 'test']);

        $this->image = Image::create([
            'default' => 'https://d3iw72m71ie81c.cloudfront.net/male-67.jpg',
            'medium' => 'https://d3iw72m71ie81c.cloudfront.net/male-67.jpg',
            'thumbnail' => 'https://d3iw72m71ie81c.cloudfront.net/male-67.jpg',
        ]);
    }

    private function createDummyPost()
    {
        $data = [
            'user_id' => $this->user->id,
            'location_id' => $this->location->id,
            'title' => 'Hello Title',
            'description' => 'Test Description',
            'price' => 100,
            'status' => 'active',
        ];

        $post = Post::create($data);

        $post->images()->attach($this->image->id);

        $post->categories()->attach($this->category->id);

        $post->save();

        return Post::find($post->id);
    }

    public function testShow()
    {
        $post = $this->createDummyPost();

        $response = $this
            ->json(
                'GET',
                '/api/posts/'.$post->id
            );
                
        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $response = $this
            ->json(
                'GET',
                '/api/posts'
            );
                
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $login = $this->login($this->user->email, '123456');
        
        $headers = [
            'Authorization' => 'Bearer ' . $login['token']
        ];

        $data = [
            'location_id' => $this->location->id,
            'title' => 'Hello Title',
            'description' => 'Test Description',
            'price' => 100,
            'status' => 'active',
            'images' => [$this->image->id],
            'category' => $this->category->id,
        ];
        
        $response = $this
            ->withHeaders($headers)
            ->json(
                'POST',
                '/api/posts',
                $data
            );
                
        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $login = $this->login($this->user->email, '123456');
        $post = $this->createDummyPost();
        
        $headers = [
            'Authorization' => 'Bearer ' . $login['token'],
            'Content-Type' => 'x-www-form-urlencoded',
        ];

        $data = [
            'location_id' => $this->location->id,
            'title' => 'Hello Title',
            'description' => 'Test Description',
            'price' => 100,
            'status' => 'active',
            'images' => [$this->image->id],
            'category' => $this->category->id,
        ];
        
        $response = $this
            ->withHeaders($headers)
            ->json(
                'PUT',
                '/api/posts/'.$post->id,
                $data
            );
                
        $response->assertStatus(200);
    }

    public function testUpdateAdmin()
    {
        $login = $this->login($this->admin->email, '123456');
        $post = $this->createDummyPost();
        
        $headers = [
            'Authorization' => 'Bearer ' . $login['token'],
            'Content-Type' => 'x-www-form-urlencoded',
        ];

        $data = [
            'location_id' => $this->location->id,
            'title' => 'Hello Title',
            'description' => 'Test Description',
            'price' => 100,
            'status' => 'active',
            'images' => [$this->image->id],
            'category' => $this->category->id,
        ];
        
        $response = $this
            ->withHeaders($headers)
            ->json(
                'PUT',
                '/api/posts/'.$post->id,
                $data
            );
                
        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $login = $this->login($this->user->email, '123456');
        $post = $this->createDummyPost();
        
        $headers = [
            'Authorization' => 'Bearer ' . $login['token'],
        ];

        $response = $this
            ->withHeaders($headers)
            ->json(
                'DELETE',
                '/api/posts/'.$post->id
            );
                
        $response->assertStatus(200);
    }

    public function testDeleteAdmin()
    {
        $login = $this->login($this->admin->email, '123456');
        $post = $this->createDummyPost();
        
        $headers = [
            'Authorization' => 'Bearer ' . $login['token'],
        ];

        $response = $this
            ->withHeaders($headers)
            ->json(
                'DELETE',
                '/api/posts/'.$post->id
            );
                
        $response->assertStatus(200);
    }
}
