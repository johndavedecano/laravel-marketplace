<?php 

namespace App\Functional\Api\V1\Controllers;

trait LoginTrait
{
    /**
     * Login user and return a JWT token
     *
     * @return string
     */
    public function login()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@email.com',
            'password' => '123456'
        ]);
        
        $response->assertStatus(200);
        
        $responseJSON = json_decode($response->getContent(), true);
        
        return $responseJSON['token'];
    }
}
