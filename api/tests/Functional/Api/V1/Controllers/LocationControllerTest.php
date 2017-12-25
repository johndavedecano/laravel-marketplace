<?php

namespace App\Functional\Api\V1\Controllers;

use App\User;
use App\Location;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Controllers\LoginTrait;

class LocationControllerTest extends TestCase
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
        $location = Location::create(['name' => 'test']);

        $response = $this->withHeaders([])->json('GET', '/api/locations');

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testShow()
    {
        $location = Location::create(['name' => 'test']);

        $response = $this->withHeaders([])->json('GET', '/api/locations/'.$location->id);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testCreateValidationFailed()
    {
        $login = $this->login('admin@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$login['token']];

        $response = $this->withHeaders($headers)->json('POST', '/api/locations', ['name' => '']);

        $response
            ->assertJsonStructure(['error' => ['message', 'errors', 'status_code']])
            ->assertStatus(422);
    }

    public function testCreate()
    {
        $login = $this->login('admin@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$login['token']];

        $response = $this->withHeaders($headers)->json('POST', '/api/locations', ['name' => 'test']);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(201);
    }

    public function testCreateNonAdmin()
    {
        $login = $this->login('user@email.com', '123456');
        $headers = ['Authorization' => 'Bearer '.$login['token']];

        $response = $this->withHeaders($headers)->json('POST', '/api/locations', ['name' => 'test']);

        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(401);
    }

    public function testUpdate()
    {
        $location = Location::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('admin@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $data = ['name' => 'hello'];

        $response = $this->withHeaders($headers)->json('PUT', '/api/locations/'.$location->id, $data);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testUpdateNonAdmin()
    {
        $location = Location::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('user@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $data = ['name' => 'hello'];

        $response = $this->withHeaders($headers)->json('PUT', '/api/locations/'.$location->id, $data);

        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(401);
    }

    public function testDelete()
    {
        $location = Location::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('admin@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $response = $this->withHeaders($headers)->json('DELETE', '/api/locations/'.$location->id);

        $response
            ->assertJsonStructure(['data'])
            ->assertStatus(200);
    }

    public function testDeleteNonAdmin()
    {
        $location = Location::create(['name' => 'kjdsfasfdsfa']);

        $login = $this->login('user@email.com', '123456');

        $headers = [
            'Authorization' => 'Bearer '.$login['token'],
            'Content-Type' => 'x-www-form-urlencoded'
        ];

        $response = $this->withHeaders($headers)->json('DELETE', '/api/locations/'.$location->id);

        $response
            ->assertJsonStructure(['error'])
            ->assertStatus(401);
    }
}
