<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckKeyValue implements Rule
{

    protected $index = 0;
    protected $key = 'id';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($index = 0, $key = 'id')
    {

        $this->index = $index;
        $this->key = $key;
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


        if ($this->index > count($value) - 1)
            return true;

        $value = $value[$this->index][$this->key];

        if ($value === null || $value === 'null' || strlen($value) === 0)
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
        return "index-$this->index";
    }
}
