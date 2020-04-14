<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimeslotPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any $categorys.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can view the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Timeslot  $timeslot
     * @return mixed
     */
    public function view(User $user, Timeslot $timeslot)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can create $timeslots.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can update the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Timeslot  $timeslot
     * @return mixed
     */
    public function update(User $user, Timeslot $timeslot)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can delete the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Timeslot  $timeslot
     * @return mixed
     */
    public function delete(User $user, Timeslot $timeslot)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can restore the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Timeslot  $timeslot
     * @return mixed
     */
    public function restore(User $user, Timeslot $timeslot)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can permanently delete the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Timeslot  $timeslot
     * @return mixed
     */
    public function forceDelete(User $user, Timeslot $timeslot)
    {
        return ($user->is_super);
    }
}
