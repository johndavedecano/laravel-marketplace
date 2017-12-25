<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Cache;

/**
 * CacheableQuery
 */
trait CacheableQuery
{
    /**
     * Cache given query
     *
     * @param string $key
     * @param integer $time
     * @param Illuminate\Database\Eloquent\Collection|Illuminate\Database\Eloquent\Model $query
     * @return Illuminate\Database\Eloquent\Collection|Illuminate\Database\Eloquent\Model
     */
    public function cache($key, $time = 60, $query)
    {
        return Cache::remember($key, $time, function () use ($query) {
            return $query;
        });
    }
}
