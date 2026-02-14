<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsUrl implements Rule
{
    public function passes(string $key, $value): bool
    {
        $value = filter_var($value, FILTER_SANITIZE_URL);
        return filter_var($value, FILTER_VALIDATE_URL);
    }

    public function message(): string
    {
        return 'The :key must be a valid URL.';
    }
}