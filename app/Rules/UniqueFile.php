<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueFile implements Rule
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
        $hashes = collect($value)->map(function ($file) {
            return md5_file($file->getRealPath());
        });

        return $hashes->unique()->count() === count($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Los archivos deben ser únicos.';
    }
}