<?php

namespace App\Api\V1\Controllers;

use Auth;
use App\Api\V1\Requests\LoginRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

/**
 * UserController
 */
class UserController extends Controller
{
    /**
     * @var App\Repositories\UserRepository
     */
    protected $user;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('jwt.auth')->only(['me', 'update']);
        $this->middleware('auth:api')->only(['me', 'update']);

        $this->user = $user;
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return new UserResource(Auth::guard()->user());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return UserResource::collection($this->user->paginate());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return new UserResource($this->user->findOrFail($id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2|max:100'
        ]);

        $user = $this->user->findOrFail($id);

        $this->authorize('update', $user);

        $user->update($data);

        return new UserResource($this->user->findOrFail($id));
    }

    /**
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws Illuminate\Auth\Access\AuthorizationException
     */
    public function password($id, Request $request)
    {
        $request->validate([
            'password' => 'required_with:new_password|password|max:16|min:5',
            'new_password' => 'confirmed|max:16|min:5',
        ]);

        $user = $this->user->findOrFail($id);

        if (!$user->isPasswordValid($request->get('password'))) {
            throw new AuthorizationException('Password did not match against the account.');
        }

        $this->authorize('update', $user);

        $user->update([
            'password' => $request->get('password')
        ]);

        return new UserResource($this->user->findOrFail($id));
    }

    /**
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function account($id, Request $request)
    {
        $user = $this->user->findOrFail($id);

        $request->validate([
            'email' => 'required|unique:users,email,'.$id
        ]);

        $this->authorize('update', $user);

        $user->update([
            'email' => $request->get('email')
        ]);

        return new UserResource($this->user->findOrFail($id));
    }
}
