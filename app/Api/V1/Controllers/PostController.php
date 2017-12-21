<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostCreateRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * Post repository handles database transactions
     *
     * @var App\Repositories\PostRepository
     */
    protected $post;

    /**
     * Controller constructor
     *
     * @param PostRepository $post
     */
    public function __construct(PostRepository $post)
    {
        $this->post = $post;

        $this->middleware('jwt.auth')->except(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    /**
     * List and search resources
     *
     * @return JsonResponse
     */
    public function index()
    {
        return PostResource::collection($this->post->paginate());
    }

    /**
     * Creates a resource
     *
     * @param PostCreateRequest $request
     * @return JsonResponse
     */
    public function store(PostCreateRequest $request)
    {
        $data = [
            'user_id' => auth()->guard()->user()->id,
            'location_id' => $request->get('location_id'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'status' => $request->get('status'),
        ];

        $post = $this->post->create($data);

        foreach ($request->get('images') as $imageId) {
            $post->images()->attach($imageId);
        }

        foreach ($request->get('categories') as $postId) {
            $post->categories()->attach($postId);
        }

        $post->save();
        
        return new PostResource($this->post->findOrFail($post->id));
    }

    /**
     * Updates a resource
     *
     * @param int $id
     * @param PostUpdateRequest $request
     * @return JsonResponse
     */
    public function update($id, PostUpdateRequest $request)
    {
        $post = $this->post->findOrFail($id);

        $this->authorize('update', $post);

        $data = [
            'location_id' => $request->get('location_id'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'status' => $request->get('status'),
        ];

        $post->update($data);

        foreach ($request->get('images') as $imageId) {
            $post->images()->attach($imageId);
        }

        foreach ($request->get('categories') as $postId) {
            $post->categories()->attach($postId);
        }

        $post->save();

        return new PostResource($this->post->findOrFail($id));
    }

    /**
     * Shows a resource
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return new PostResource($this->post->findOrFail($id));
    }

    /**
     * Deletes a resource
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);

        $this->authorize('delete', $post);
        
        return response()->json([
            'data' => [
                'success' => (bool)$post->delete()
            ]
        ]);
    }
}
