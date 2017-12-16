<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;
    use LoginTrait;

    public function setUp()
    {
        parent::setUp();

        $user = new User([
            'name' => 'Test',
            'email' => 'test@email.com',
            'password' => '123456'
        ]);

        $user->save();
    }

    public function testCreateCategorySuccess()
    {
        $token = $this->login();
        $postData = [];
        $headers = ['Authorization' => 'Bearer ' . $token];
        
        $this->post('api/categories', $postData, $headers)->isOk();
    }
}
