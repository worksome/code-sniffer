<?php

namespace Worksome\WorksomeSniff\Tests\Resources\Sniffs\Classes\DisallowPhpUnitTestSniff;

use PHPUnit\Framework\TestCase;

class PhpUnitWithTestAnnotationTest extends TestCase
{

    /**
     * @test
     */
    public function it_tests_something()
    {
        $this->assertTrue(true);
    }

}
