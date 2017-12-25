<?php

namespace App\Api\V1\Controllers;

use App\User;
use App\Mail\UserRegisteredMail;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use Config;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'activation_code' => $request->get('name'),
        ]);

        if (!$user->save()) {
            throw new HttpException(500);
        }

        Mail::to($user->email)->send(new UserRegisteredMail($user));

        return response()->json([
            'status' => 'ok',
            'message' => 'Activation code was successfully sent to your email.'
        ], 201);
    }
}
