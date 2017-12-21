<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Repositories\FindOrFail;
use App\Repositories\CacheableQuery;

class PostRepository extends Repository
{
    use FindOrFail, CacheableQuery;

    /**
     * @return string
     */
    public function model()
    {
        return App\Post::class;
    }

    /**
     * Returns all resources
     *
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($columns = ['*'])
    {
        return $this->cache('posts', 60, $this->model->all($columns));
    }
}
