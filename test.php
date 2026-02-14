<?php

use JordJD\OmegaValidator\Rules\IsEmail;
use JordJD\OmegaValidator\Rules\IsString;
use JordJD\OmegaValidator\Rules\Required;
use JordJD\OmegaValidator\Translator;
use JordJD\OmegaValidator\Validator;

require_once __DIR__.'/vendor/autoload.php';

$data = [
    'email' => '',
];

$rules = [
    'email' => [
        new Required(),
        new IsEmail(),
        new IsString(),
    ]
];

$validator = new Validator($data, $rules);

if ($validator->fails()) {

    // English messages
    var_dump($validator->messages());

    // German messages
    var_dump($validator->messages(new Translator('de')));

    // Polish messages
    var_dump($validator->messages(new Translator('pl')));

    // etc...
}