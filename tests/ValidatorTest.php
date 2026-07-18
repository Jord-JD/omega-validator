<?php

namespace JordJD\OmegaValidator\Tests;

use JordJD\OmegaValidator\Exceptions\InvalidRuleException;
use JordJD\OmegaValidator\Interfaces\Rule;
use JordJD\OmegaValidator\Rules\IsEmail;
use JordJD\OmegaValidator\Rules\IsString;
use JordJD\OmegaValidator\Rules\Required;
use JordJD\OmegaValidator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testPassesFailsAndMessages()
    {
        $valid = new Validator(['email' => 'person@example.com'], [
            'email' => [new Required(), new IsEmail(), new IsString()],
        ]);
        $invalid = new Validator(['email' => 'invalid'], [
            'email' => [new Required(), new IsEmail()],
        ]);

        $this->assertTrue($valid->passes());
        $this->assertFalse($valid->fails());
        $this->assertTrue($invalid->fails());
        $this->assertSame(
            'The email must be a valid email address.',
            $invalid->messages()['email']['JordJD\OmegaValidator\Rules\IsEmail']
        );
    }

    public function testMessagesRenderArrayValuesWithoutWarnings()
    {
        $rule = new class implements Rule {
            public function passes(string $key, $value): bool
            {
                return false;
            }

            public function message(): string
            {
                return 'The :key value :value is invalid.';
            }
        };
        $validator = new Validator(['payload' => ['invalid']], [
            'payload' => [$rule],
        ]);
        $messages = $validator->messages()['payload'];

        $this->assertSame('The payload value ["invalid"] is invalid.', reset($messages));
    }

    public function testRejectsObjectsThatAreNotRules()
    {
        $this->expectException(InvalidRuleException::class);

        new Validator([], ['field' => [new \stdClass()]]);
    }
}
