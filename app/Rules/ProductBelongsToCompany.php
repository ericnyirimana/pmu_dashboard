<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;

class ProductBelongsToCompany implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        return ( Auth::user()->is_super || Auth::user()->company->products()->find($value) );
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
}
