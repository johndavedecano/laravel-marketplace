<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

/**
 * CategoryController
 */
class CategoryController extends Controller
{
    /**
     * Repository for the subject database table
     *
     * @var App\Repositories\CategoryRepository
     */
    protected $category;

    /**
     * Instantiate a new controller instance
     *
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;

        $this->middleware('jwt.auth')->except(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('auth.admin')->except(['index', 'show']);
    }
    
    /**
     * List and pagination categories
     *
     * @return Response
     */
    public function index()
    {
        if (request()->has('select')) {
            $options = [];

            foreach ($this->category->all() as $category) {
                $options[] = [
                    'value' => $category->id,
                    'label' => $category->name,
                ];
            }

            return response()->json($options);
        }

        return CategoryResource::collection($this->category->all());
    }

    /**
     * Create new category resource
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->category->create($request->only('name'));

        return new CategoryResource($category);
    }

    /**
     * Update an existing resource
     *
     * @param int $id
     * @param CategoryRequest $request
     * @return Response
     */
    public function update($id, CategoryRequest $request)
    {
        $category = $this->category->findOrFail($id);

        $category->update($request->only('name'));

        return new CategoryResource($category);
    }

    /**
     * Show an existing reseource
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);
        
        return new CategoryResource($category);
    }

    /**
     * Delete a resource
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $destroyed = $this->category->delete($id);
        
        return response()->json(['data' => ['success' => (bool)$destroyed]]);
    }
}
