<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentsRequired implements Rule
{
    protected $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
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
        if ($value == null)
            return false;


        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $data =  str_replace('_', ' ', $this->type);
        return "The $data document is required.";
    }
}
