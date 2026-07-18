<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class Required implements Rule
{
    public function passes(string $key, $value): bool
    {
        if ($value === null || $value === '') {
            return false;
        }

        if (is_array($value)) {
            return count($value) > 0;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :key is required.';
    }
}
