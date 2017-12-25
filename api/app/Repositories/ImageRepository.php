<?php namespace App\Repositories;

use App\Image;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Repositories\FindOrFail;

class ImageRepository extends Repository
{
    use FindOrFail;
    
    /**
     * @return string
     */
    public function model()
    {
        return Image::class;
    }
}
