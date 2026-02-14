<?php

namespace JordJD\OmegaValidator;

use JordJD\Translator\Translator as BaseTranslator;

class Translator extends BaseTranslator
{
    public function getDefaultLanguageDirectory()
    {
        return __DIR__.'/../resources/lang/';
    }
}