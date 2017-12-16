<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
    });
    //'middleware' => 'jwt.auth'
    $api->group([], function (Router $api) {
        $api->resource('categories', 'App\\Api\\V1\\Controllers\\CategoryController', ['except' => ['create', 'edit']]);
        $api->resource('comments', 'App\\Api\\V1\\Controllers\\CommentController', ['except' => ['create', 'edit']]);
        $api->resource('locations', 'App\\Api\\V1\\Controllers\\LocationController', ['except' => ['create', 'edit']]);
        $api->resource('images', 'App\\Api\\V1\\Controllers\\ImageController', ['except' => ['create', 'edit']]);
        $api->resource('posts', 'App\\Api\\V1\\Controllers\\PostController', ['except' => ['create', 'edit']]);
        $api->resource('users', 'App\\Api\\V1\\Controllers\\UserController', ['except' => ['create', 'edit']]);
        
        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function () {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->get('hello', function () {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
