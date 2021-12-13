<?php

namespace Worksome\WorksomeSniff\Tests\Resources\Sniffs\Classes\DisallowPhpUnitTestSniff;

use PHPUnit\Framework\TestCase;

class PhpUnitWithTestAnnotationTest extends TestCase
{
    /** @test */
    private string $property = 'foo';

    /**
     * @test
     */
    public function it_tests_something()
    {
        $this->assertTrue(true);
    }

    /**
     * @depends it_tests_something
     * @test
     * @testWith [1, 2, 3]
     */
    public function it_tests_something_else()
    {
        $this->assertTrue(true);
    }

}
