<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Classes\DisallowPhpUnitTestSniff;
use Worksome\WorksomeSniff\Sniffs\Classes\ExceptionSuffixSniff;

class DisallowPhpUnitTestSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPhpUnitTestSniff/PestTest.php.stub');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrorWhenPhpUnitTestAnnotationEncountered(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPhpUnitTestSniff/PhpUnitWithTestAnnotationTest.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 11,
            code: DisallowPhpUnitTestSniff::class
        );
    }

    public function testErrorWhenPhpUnitTestPrefixEncountered(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPhpUnitTestSniff/PhpUnitWithTestPrefixTest.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 10,
            code: DisallowPhpUnitTestSniff::class
        );
    }

    protected static function getSniffClassName(): string
    {
        return DisallowPhpUnitTestSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Classes.DisallowPhpUnitTest';
    }
}
