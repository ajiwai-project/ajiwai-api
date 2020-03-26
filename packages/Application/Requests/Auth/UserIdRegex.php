<?php

namespace Ajiwai\Application\Requests\Auth;

use Illuminate\Contracts\Validation\Rule;

class UserIdRegex implements Rule
{
        /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z0-9@-_.]+$/u', $value);
    }

        /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return;
    }
}
