<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Classes\ExceptionSuffixSniff;

class ExceptionSuffixSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/CorrectException.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testNoErrorsForFullyQualifiedBaseException(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/FullyQualifiedException.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrorWithoutExceptionSuffix(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/WrongExceptionName.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 7,
            code: ExceptionSuffixSniff::class
        );
    }

    public function testErrorWithoutExceptionSuffixFullyQualified(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/WrongExceptionNameWithFullyQualified.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: ExceptionSuffixSniff::class
        );
    }

    public function testNoErrorsOnNonExceptionClass(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/RandomClass.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrorWhenExtendingExceptionAndInterface(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/WrongExceptionNameWithInterface.php.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: ExceptionSuffixSniff::class
        );
    }

    public function testErrorWhenExtendingCustomExceptionWithFQCN(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/WrongExceptionNameWithCustomFullyQualified.php.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: ExceptionSuffixSniff::class
        );
    }

    public function testNoErrorsWhenImplementingInterfaces(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/NonExceptionWithInterface.php');

        self::assertNoSniffErrorInFile($report);
    }

    protected static function getSniffClassName(): string
    {
        return ExceptionSuffixSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Classes.ExceptionSuffix';
    }
}
