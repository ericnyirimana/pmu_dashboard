<?php

namespace App\Rules;

use Auth;
use Illuminate\Contracts\Validation\Rule;

class TimeslotBelongsToRestaurant implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (Auth::user()->is_super) {
            return true;
        } else {
            return $this->checkTimeslot($value);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute doesn\'t exists.';
    }

    protected function checkTimeslot($value)
    {
        if (Auth::user()->brand->first()->restaurants->map(function ($restaurant) use ($value) {
            return $restaurant->timeslots->map(function ($timeslot) use ($value) {
                if ($timeslot->get()->contains($value)) {
                    return true;
                }
            });
        })) {
            return true;
        }
        return false;
    }
}
