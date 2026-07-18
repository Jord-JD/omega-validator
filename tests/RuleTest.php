<?php

namespace JordJD\OmegaValidator\Tests;

use JordJD\OmegaValidator\Rules\IsArray;
use JordJD\OmegaValidator\Rules\IsBetween;
use JordJD\OmegaValidator\Rules\IsBoolean;
use JordJD\OmegaValidator\Rules\IsEmail;
use JordJD\OmegaValidator\Rules\IsEqualTo;
use JordJD\OmegaValidator\Rules\IsFalsy;
use JordJD\OmegaValidator\Rules\IsGreaterThan;
use JordJD\OmegaValidator\Rules\IsGreaterThanOrEqualTo;
use JordJD\OmegaValidator\Rules\IsInteger;
use JordJD\OmegaValidator\Rules\IsJson;
use JordJD\OmegaValidator\Rules\IsLessThan;
use JordJD\OmegaValidator\Rules\IsLessThanOrEqualTo;
use JordJD\OmegaValidator\Rules\IsNull;
use JordJD\OmegaValidator\Rules\IsNumeric;
use JordJD\OmegaValidator\Rules\IsOneOf;
use JordJD\OmegaValidator\Rules\IsString;
use JordJD\OmegaValidator\Rules\IsTruthy;
use JordJD\OmegaValidator\Rules\IsUrl;
use JordJD\OmegaValidator\Rules\NotEqualTo;
use JordJD\OmegaValidator\Rules\NotNull;
use JordJD\OmegaValidator\Rules\NotOneOf;
use JordJD\OmegaValidator\Rules\Required;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    public function ruleProvider()
    {
        return [
            [new IsArray(), [], 'array'],
            [new IsBetween(1, 3), 2, 4],
            [new IsBetween(1, 3, false), 2, 1],
            [new IsBoolean(), true, 1],
            [new IsEmail(), 'person@example.com', 'person()@example.com'],
            [new IsEqualTo('1'), '1', 1],
            [new IsFalsy(), 0, 1],
            [new IsGreaterThan(2), 3, 2],
            [new IsGreaterThanOrEqualTo(2), 2, 1],
            [new IsInteger(), 1, '1'],
            [new IsJson(), 'null', '{invalid'],
            [new IsLessThan(2), 1, 2],
            [new IsLessThanOrEqualTo(2), 2, 3],
            [new IsNull(), null, ''],
            [new IsNumeric(), '1.5', 'number'],
            [new IsOneOf(['a', 'b']), 'a', 'c'],
            [new IsString(), 'value', 1],
            [new IsTruthy(), 1, 0],
            [new IsUrl(), 'https://example.com/path', 'not a url'],
            [new NotEqualTo('a'), 'b', 'a'],
            [new NotNull(), false, null],
            [new NotOneOf(['a', 'b']), 'c', 'a'],
            [new Required(), 0, ''],
        ];
    }

    /** @dataProvider ruleProvider */
    public function testRulesAcceptAndRejectExpectedValues($rule, $validValue, $invalidValue)
    {
        $this->assertTrue($rule->passes('field', $validValue));
        $this->assertFalse($rule->passes('field', $invalidValue));
        $this->assertNotSame('', $rule->message());
    }
}
