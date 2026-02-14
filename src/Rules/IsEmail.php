<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsEmail implements Rule
{
    public function passes(string $key, $value): bool
    {
        $value = filter_var($value, FILTER_SANITIZE_EMAIL);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function message(): string
    {
        return 'The :key must be a valid email address.';
    }
}