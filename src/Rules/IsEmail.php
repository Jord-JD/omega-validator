<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsEmail implements Rule
{
    public function passes(string $key, $value): bool
    {
        return is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function message(): string
    {
        return 'The :key must be a valid email address.';
    }
}
