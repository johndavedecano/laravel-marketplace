<?php

namespace App\Api\V1\Controllers;

use Image;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Http\Requests\ImageRequest;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;

/**
 * ImageController
 */
class ImageController extends Controller
{
    /**
     * Repository for the subject database table
     *
     * @var App\Repositories\ImageRepository
     */
    protected $image;

    /**
     * Instantiate a new controller instance
     *
     * @param ImageRepository $image
     */
    public function __construct(ImageRepository $image)
    {
        $this->image = $image;

        $this->middleware('jwt.auth')->except(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    /**
     * List and pagination images
     *
     * @return Response
     */
    public function index()
    {
        return ImageResource::collection($this->image->paginate());
    }

    /**
     * Create new Image resource
     *
     * @param ImageRequest $request
     * @return Response
     */
    public function store(ImageRequest $request)
    {
        $images = [];

        if (is_array($request->file('image'))) {
            foreach ($request->file('image') as $image) {
                $images[] = $this->process($image);
            }
        } else {
            $images[] = $this->process($request->file('image'));
        }

        return ImageResource::collection(collect($images));
    }

    /**
     * Process a file. Creates multiple different sizes.
     *
     * @param File $file
     * @return Image
     */
    private function process($file)
    {
        $originalName = uniqid()."_original.".$file->getClientOriginalExtension();
        $original = $this->upload((string)Image::make($file->getRealPath())->encode(), $originalName);
        $medium = $this->uploadAndResize($file, 250, 250);
        $thumbnail = $this->uploadAndResize($file, 100, 100);

        return $this->image->create([
            'user_id' => auth()->guard()->user()->id,
            'default' => "storage/images/$originalName",
            'medium' => "storage/images/$medium",
            'thumbnail' => "storage/images/$thumbnail",
        ]);
    }

    /**
     * Upload and resize the file
     *
     * @param File $file
     * @param integer $width
     * @param integer $height
     * @return string
     */
    private function uploadAndResize($file, $width = 100, $height = 100)
    {
        $image = Image::make($file->getRealPath());
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $name = uniqid()."_".$width."x".$height.".".$file->getClientOriginalExtension();

        $this->upload((string)$image->encode(), $name);

        return $name;
    }

    /**
     * Save file to the storage.
     *
     * @param File $file
     * @param string $name
     * @return string
     */
    private function upload($file, $name)
    {
        return Storage::put("public/images/$name", $file);
    }

    /**
     * Show an existing reseource
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $image = $this->image->findOrFail($id);
        
        $this->authorize($image);
        
        return new ImageResource($image);
    }

    /**
     * Delete a resource
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $image = $this->image->findOrFail($id);

        $this->authorize($image);

        $destroyed = $image->delete();
        
        return response()->json(['data' => ['success' => (bool)$destroyed]]);
    }
}
