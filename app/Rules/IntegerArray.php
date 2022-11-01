<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IntegerArray implements Rule
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
        return collect($value)->every(fn($ele)=>is_int($ele));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute Con Only Be Integer.';
    }
}
