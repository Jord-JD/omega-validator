<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsNull implements Rule
{
    public function passes(string $key, $value): bool
    {
        return $value === null;
    }

    public function message(): string
    {
        return 'The :key must be null.';
    }
}