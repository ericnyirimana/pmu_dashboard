<?php

namespace App\Traits;

use App\Models\User;


Trait UserCanTrait
{


    public function userCanEdit(User $user)
    {

        if ($user->is_super) {
            return $user->is_super;
        } else {
            return (!empty($this->company) && $this->company->id == $user->brand->first()->id);
        }
        return ((!empty($this->company) && $this->company->id == $user->brand->first()->id) || $user->is_super);

    }

    public function userCanView(User $user)
    {

        if ($user->is_super) {
            return $user->is_super;
        } else {
            return (!empty($this->company) && $this->company->id == $user->brand->first()->id);
        }

    }

}
