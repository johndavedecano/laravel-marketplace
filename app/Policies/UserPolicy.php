<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // /**
    //  * For certain users, you may wish to authorize all actions within a given policy.
    //  * To accomplish this, define a before method on the policy.
    //  * The before method will be executed before any other methods on the policy,
    //  * giving you an opportunity to authorize the action before the intended policy
    //  * method is actually called. This feature is most commonly used for authorizing
    //  * application administrators to perform any action
    //  *
    //  * @param User $user
    //  * @param mixed $ability
    //  * @return bool
    //  */
    // public function before(User $user, $ability)
    // {
    //     if ($user->is_superadmin) {
    //         return true;
    //     }
    // }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->is_superadmin) {
            return true;
        }

        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->is_superadmin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->is_superadmin) {
            return true;
        }

        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($user->is_superadmin) {
            return true;
        }

        return false;
    }
}
