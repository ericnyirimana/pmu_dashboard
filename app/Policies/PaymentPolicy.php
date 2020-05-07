<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can create $payments.
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
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function update(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can delete the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function delete(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can restore the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function restore(User $user)
    {
        return ($user->is_super);
    }

    /**
     * Determine whether the user can permanently delete the $category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return ($user->is_super);
    }
}
