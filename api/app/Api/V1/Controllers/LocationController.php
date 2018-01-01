<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Requests\LocationRequest;
use App\Repositories\LocationRepository;

/**
 * LocationController
 */
class LocationController extends Controller
{
    /**
     * Repository for the subject database table
     *
     * @var App\Repositories\LocationRepository
     */
    protected $location;

    /**
     * Instantiate a new controller instance
     *
     * @param LocationRepository $location
     */
    public function __construct(LocationRepository $location)
    {
        $this->location = $location;

        $this->middleware('jwt.auth')->except(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('auth.admin')->except(['index', 'show']);
    }
    
    /**
     * List and pagination resource
     *
     * @return Response
     */
    public function index()
    {
        if (request()->has('select')) {
            $options = [];

            foreach ($this->location->all() as $location) {
                $options[] = [
                    'value' => $location->id,
                    'label' => $location->name,
                ];
            }

            return response()->json($options);
        }

        return LocationResource::collection($this->location->all());
    }

    /**
     * Create new resource
     *
     * @param LocationRequest $request
     * @return Response
     */
    public function store(LocationRequest $request)
    {
        $location = $this->location->create($request->only('name'));

        return new LocationResource($location);
    }

    /**
     * Update an existing resource
     *
     * @param int $id
     * @param LocationRequest $request
     * @return Response
     */
    public function update($id, LocationRequest $request)
    {
        $location = $this->location->findOrFail($id);

        $location->update($request->only('name'));

        return new LocationResource($location);
    }

    /**
     * Show an existing reseource
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $location = $this->location->findOrFail($id);
        
        return new LocationResource($location);
    }

    /**
     * Delete a resource
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $destroyed = $this->location->delete($id);
        
        return response()->json(['data' => ['success' => (bool)$destroyed]]);
    }
}
