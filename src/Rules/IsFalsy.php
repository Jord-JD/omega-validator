<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsFalsy implements Rule
{
    public function passes(string $key, $value): bool
    {
        return $value == false;
    }

    public function message(): string
    {
        return 'The :key must be falsy.';
    }
}