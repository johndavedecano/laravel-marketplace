<?php

namespace App\Traits;

trait Ownership
{
    /**
     * Checks if user owns an entity
     *
     * @param Model $model
     * @param string $id
     * @return bool
     */
    public function owns(Model $model, $id = 'user_id')
    {
        return $this->id === $model->{$id};
    }
}
