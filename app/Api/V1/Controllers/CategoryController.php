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
     * Repository from categories table
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
    }
    
    /**
     * List and pagination categories
     *
     * @return Response
     */
    public function index()
    {
        return CategoryResource::collection($this->category->paginate());
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
        $category = $this->category->find($id);

        $category->update($request->only('name'));

        return new CategoryResource($category);
    }

    public function show()
    {
    }

    public function destroy()
    {
    }
}
