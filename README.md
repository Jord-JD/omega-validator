# Omega Validator

## Installation

To install Omega Validator, just run the following Composer command.

```bash
composer require jord-jd/omega-validator
```

## Usage

See the following example usage.

```php
use JordJD\OmegaValidator\Rules\IsEmail;
use JordJD\OmegaValidator\Rules\IsString;
use JordJD\OmegaValidator\Rules\Required;
use JordJD\OmegaValidator\Translator;
use JordJD\OmegaValidator\Validator;

/* ... */

$validator = new Validator([
    'email' => '',
], [
    'email' => [
        new Required(),
        new IsEmail(),
        new IsString(),
    ],
]);

if ($validator->fails()) {

    // English messages
    var_dump($validator->messages());
    
    // array(1) {
    //  ["email"]=>
    //  array(2) {
    //    ["JordJD\OmegaValidator\Rules\Required"]=>
    //    string(22) "The email is required."
    //    ["JordJD\OmegaValidator\Rules\IsEmail"]=>
    //    string(40) "The email must be a valid email address."
    //  }
    // }

    // German messages
    var_dump($validator->messages(new Translator('de')));

    // Polish messages
    var_dump($validator->messages(new Translator('pl')));

    // etc...
}
```