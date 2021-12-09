<?php

namespace Worksome\WorksomeSniff\Tests\Resources\Sniffs\Classes\DisallowPhpUnitTestSniff;

use PHPUnit\Framework\TestCase;

class PhpUnitWithTestPrefixTest extends TestCase
{

    public function testItWorks()
    {
        $this->assertTrue(true);
    }

}
