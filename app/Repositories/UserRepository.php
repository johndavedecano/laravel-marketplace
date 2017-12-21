<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Repositories\FindOrFail;
use App\Repositories\CacheableQuery;

/**
 * UserRepository
 */
class UserRepository extends Repository
{
    use FindOrFail, CacheableQuery;

    /**
     * Returns the model to be used by repository
     *
     * @return string
     */
    public function model()
    {
        return App\User::class;
    }

    /**
     * Returns all resources
     *
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($columns = ['*'])
    {
        return $this->cache('users', 60, $this->model->all($columns));
    }
}
