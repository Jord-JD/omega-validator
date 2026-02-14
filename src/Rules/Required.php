<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class Required implements Rule
{
    public function passes(string $key, $value): bool
    {
        return !empty($value);
    }

    public function message(): string
    {
        return 'The :key is required.';
    }
}