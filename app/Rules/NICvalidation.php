<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NicValidation implements Rule
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
        $regex1 = '/^[0-9]{2}[5-8]{1}[0-9]{6}[vVxX]$/';
        $regex2 = '/^[0-9]{4}[5-8]{1}[0-9]{7}$/';

        if(((!empty($value) && strlen($value) == 10 && (preg_match($regex1, $value)))) ||((!empty($value) && strlen($value)==12) && (preg_match($regex2, $value)))){

            return true;

        }
        else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The NIC format is not valid';
    }
}
