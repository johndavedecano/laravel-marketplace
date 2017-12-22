<?php

namespace App\Functional\Api\V1\Controllers;

use App\User;
use App\Category;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Controllers\LoginTrait;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations, LoginTrait;

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

        $user = new User([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => '123456',
            'is_superadmin' => false,
            'is_activated' => true
        ]);

        $user->save();
    }

    public function testList()
    {
        $category = Category::create(['name' => 'test']);

        $response = $this->withHeaders([])->json('GET', '/api/categories');

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testShow()
    {
        $category = Category::create(['name' => 'test']);

        $response = $this->withHeaders([])->json('GET', '/api/categories/'.$category->id);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testCreateValidationFailed()
    {
        $login = $this->login('admin@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$login['token']];

        $response = $this->withHeaders($headers)->json('POST', '/api/categories', ['name' => '']);

        $response
            ->assertJsonStructure(['error' => ['message', 'errors', 'status_code']])
            ->assertStatus(422);
    }

    public function testCreate()
    {
        $login = $this->login('admin@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$login['token']];

        $response = $this->withHeaders($headers)->json('POST', '/api/categories', ['name' => 'test']);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(201);
    }

    public function testCreateNonAdmin()
    {
        $login = $this->login('user@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$login['token']];

        $response = $this->withHeaders($headers)->json('POST', '/api/categories', ['name' => 'test']);

        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(401);
    }

    public function testUpdate()
    {
        $category = Category::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('admin@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $data = ['name' => 'hello'];

        $response = $this->withHeaders($headers)->json('PUT', '/api/categories/'.$category->id, $data);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testUpdateNonAdmin()
    {
        $category = Category::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('user@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $data = ['name' => 'hello'];

        $response = $this->withHeaders($headers)->json('PUT', '/api/categories/'.$category->id, $data);

        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(401);
    }

    public function testDelete()
    {
        $category = Category::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('admin@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $response = $this->withHeaders($headers)->json('DELETE', '/api/categories/'.$category->id);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testDeleteNonAdmin()
    {
        $category = Category::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('user@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $response = $this->withHeaders($headers)->json('DELETE', '/api/categories/'.$category->id);

        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(401);
    }
}
