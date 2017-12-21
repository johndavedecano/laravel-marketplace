<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth')->except(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    public function index()
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function show()
    {
    }

    public function destroy()
    {
    }
}
