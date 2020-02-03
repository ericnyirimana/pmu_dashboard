<?php

namespace App\Traits;

use App\Models\User;


Trait UserCanTrait {



        public function userCanEdit(User $user) {

          return ( (!empty($this->brand) && $this->brand->owner_id == $user->id) || $user->is_super);

      }

      public function userCanView(User $user) {

          return ( (!empty($this->brand) && $this->brand->owner_id == $user->id) || $user->is_super);

      }

}
