<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class ImageRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return App\Image::class;
    }
}
