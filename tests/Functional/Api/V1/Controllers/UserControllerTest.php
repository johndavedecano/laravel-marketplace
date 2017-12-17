<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Controllers\LoginTrait;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations, LoginTrait;

    public function setUp()
    {
        parent::setUp();

        $user = new User([
            'name' => 'Test',
            'email' => 'test@email.com',
            'password' => '123456'
        ]);

        $user->save();

        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => '123456',
            'is_superadmin' => true
        ]);

        $user->save();
    }

    public function testMe()
    {
        $token = $this->login('test@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$token];
        $response = $this->withHeaders($headers)->json('GET', '/api/auth/me');
        $response
            ->assertJsonStructure(['data' => ['id', 'avatar', 'name']])
            ->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->withHeaders([])->json('GET', '/api/users/1');
        $response
            ->assertJsonStructure(['data' => ['id', 'avatar', 'name']])
            ->assertStatus(200);
    }

    public function testShow404()
    {
        $response = $this->withHeaders([])->json('GET', '/api/users/3515295123952512');
        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(404);
    }

    public function testIndex()
    {
        $response = $this->withHeaders([])->json('GET', '/api/users');
        $response
            ->assertJsonStructure(['data', 'links'])
            ->assertStatus(200);
    }
}
