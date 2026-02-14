<?php

namespace JordJD\OmegaValidator\Rules;

use JordJD\OmegaValidator\Interfaces\Rule;

class IsLessThan implements Rule
{
    private $comparisonValue;

    public function __construct($comparisonValue)
    {
        $this->comparisonValue = $comparisonValue;
    }

    public function passes(string $key, $value): bool
    {
        return $value < $this->comparisonValue;
    }

    public function message(): string
    {
        return 'The :key must be less than '.$this->comparisonValue.'.';
    }
}