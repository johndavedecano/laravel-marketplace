<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

trait FindOrFailTrait
{
    /**
     * Find a given resource then throw an exception if not found
     *
     * @param int $id
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @return Model
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}
