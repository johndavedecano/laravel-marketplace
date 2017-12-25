<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $user = auth()->guard()->user();
        
        /**
         * If the current user is an admin then well show all the fields.
         */
        if ($user && $user->is_superadmin) {
            return parent::toArray($request);
        }

        /**
         * Well show selected fields instead.
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar,
        ];
    }
}
