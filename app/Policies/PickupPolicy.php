<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pickup;
use Illuminate\Auth\Access\HandlesAuthorization;

class PickupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pickups.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the pickup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pickup  $pickup
     * @return mixed
     */
    public function view(User $user, Pickup $pickup)
    {
        return true;
    }

    /**
     * Determine whether the user can create pickups.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the pickup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pickup  $pickup
     * @return mixed
     */
    public function update(User $user, Pickup $pickup)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the pickup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pickup  $pickup
     * @return mixed
     */
    public function delete(User $user, Pickup $pickup)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the pickup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pickup  $pickup
     * @return mixed
     */
    public function restore(User $user, Pickup $pickup)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can permanently delete the pickup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pickup  $pickup
     * @return mixed
     */
    public function forceDelete(User $user, Pickup $pickup)
    {
        return $user->is_super;
    }
}
