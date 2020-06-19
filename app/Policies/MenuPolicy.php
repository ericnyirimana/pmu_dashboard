<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any menus.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->is_super || $user->is_restaurant);
        //return true;
    }

    /**
     * Determine whether the user can view the menu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Menu  $menu
     * @return mixed
     */
    public function view(User $user, Menu $menu)
    {
        return ($user->is_super || $menu->userCanView($user) || $user->is_restaurant);
    }

    /**
     * Determine whether the user can create menus.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->is_super || $user->is_owner );
    }

    /**
     * Determine whether the user can update the menu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Menu  $menu
     * @return mixed
     */
    public function update(User $user, Menu $menu)
    {
        return ($user->is_super || $menu->userCanEdit($user) || $user->is_restaurant );
    }

    /**
     * Determine whether the user can delete the menu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Menu  $menu
     * @return mixed
     */
    public function delete(User $user, Menu $menu)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the menu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Menu  $menu
     * @return mixed
     */
    public function restore(User $user, Menu $menu)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can permanently delete the menu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Menu  $menu
     * @return mixed
     */
    public function forceDelete(User $user, Menu $menu)
    {
        return ($user->is_super);
    }
}
