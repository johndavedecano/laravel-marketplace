<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class CommentRepository extends Repository
{
    /**
     * Returns the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Comment';
    }
}
