<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any companies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->is_super || $user->is_owner || $user->is_restaurant);
    }

    /**
     * Determine whether the user can view the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->is_super || $user->is_owner || $user->is_restaurant );
    }

}
