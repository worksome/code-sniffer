<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Classes\DisallowPhpUnitTestSniff;
use Worksome\WorksomeSniff\Sniffs\Classes\ExceptionSuffixSniff;

class DisallowPhpUnitTestSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPhpUnitTestSniff/PestTest.php.stub', [
            'testDirectories' => ['/tests/']
        ]);

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrorWhenPhpUnitTestAnnotationEncountered(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPhpUnitTestSniff/PhpUnitWithTestAnnotationTest.php', [
            'testDirectories' => ['/tests/']
        ]);

        self::assertSame(3, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 9,
            code: DisallowPhpUnitTestSniff::class
        );

        self::assertSniffError(
            phpcsFile: $report,
            line: 13,
            code: DisallowPhpUnitTestSniff::class
        );

        self::assertSniffError(
            phpcsFile: $report,
            line: 22,
            code: DisallowPhpUnitTestSniff::class
        );
    }

    public function testErrorWhenPhpUnitTestPrefixEncountered(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPhpUnitTestSniff/PhpUnitWithTestPrefixTest.php', [
            'testDirectories' => ['/tests/']
        ]);

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
