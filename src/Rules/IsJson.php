<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsJson implements Rule
{
    public function passes(string $key, $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE;
    }

    public function message(): string
    {
        return 'The :key must be valid JSON.';
    }
}
