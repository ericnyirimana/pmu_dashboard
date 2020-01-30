<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any brands.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->is_admin || $user->is_pmu || $user->is_owner);
    }

    /**
     * Determine whether the user can view the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function view(User $user, Brand $brand)
    {
        return ($user->is_super || ( $user->is_owner && $brand->UserIsOwner($user) ) );
    }

    /**
     * Determine whether the user can create brands.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can update the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function update(User $user, Brand $brand)
    {
        return ($user->is_super || ( $user->is_owner && $brand->UserIsOwner($user) ) );
    }

    /**
     * Determine whether the user can delete the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function delete(User $user, Brand $brand)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can restore the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function restore(User $user, Brand $brand)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can permanently delete the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function forceDelete(User $user, Brand $brand)
    {
        return ($user->is_super);
    }
}
