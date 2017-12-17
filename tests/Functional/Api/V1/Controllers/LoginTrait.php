<?php 

namespace App\Functional\Api\V1\Controllers;

trait LoginTrait
{
    /**
     * Login user and return a JWT token
     *
     * @return string
     */
    public function login($email, $password)
    {
        $response = $this->post('api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);
        
        $response->assertStatus(200);
        
        $responseJSON = json_decode($response->getContent(), true);
        
        return $responseJSON['token'];
    }
}
