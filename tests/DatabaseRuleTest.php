<?php

namespace JordJD\OmegaValidator\Tests;

use JordJD\OmegaValidator\Rules\DoesNotExistInDatabase;
use JordJD\OmegaValidator\Rules\ExistsInDatabase;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseRuleTest extends TestCase
{
    public function testDatabaseRules()
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->exec('create table users (email text not null)');
        $pdo->exec("insert into users (email) values ('person@example.com')");

        $exists = new ExistsInDatabase($pdo, 'users', 'email');
        $doesNotExist = new DoesNotExistInDatabase($pdo, 'users', 'email');

        $this->assertTrue($exists->passes('email', 'person@example.com'));
        $this->assertFalse($exists->passes('email', 'missing@example.com'));
        $this->assertTrue($doesNotExist->passes('email', 'missing@example.com'));
    }
}
