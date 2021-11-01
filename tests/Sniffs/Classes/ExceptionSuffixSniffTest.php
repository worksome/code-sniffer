<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Classes\ExceptionSuffixSniff;

class ExceptionSuffixSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/app/CorrectException.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testNoErrorsForFullyQualifiedBaseException(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/app/FullyQualifiedException.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Classes/ExceptionSuffixSniff/app/WrongExceptionName.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 7,
            code: ExceptionSuffixSniff::class
        );
    }

//    public function testCanChangeSuffix(): void
//    {
//        $report = self::checkFile(
//            __DIR__ . '/../../Resources/Sniffs/Laravel/EventListenerSuffixSniff/app/Listeners/ChangedSuffixListener.php',
//            [
//                'suffix' => 'Hears'
//            ]
//        );
//
//        self::assertSame(1, $report->getErrorCount());
//
//        self::assertSniffError(
//            phpcsFile: $report,
//            line: 5,
//            code: ExceptionSuffixSniff::class
//        );
//    }

    protected static function getSniffClassName(): string
    {
        return ExceptionSuffixSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Classes.ExceptionSuffix';
    }
}
