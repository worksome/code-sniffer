<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Laravel;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Laravel\EventListenerSuffixSniff;

class EventListenerSuffixSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/EventListenerSuffixSniff/app/Listeners/CorrectListenerNameListener.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/EventListenerSuffixSniff/app/Listeners/WrongListenerName.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: EventListenerSuffixSniff::class
        );
    }

    public function testCanChangeSuffix(): void
    {
        $report = self::checkFile(
            __DIR__ . '/../../Resources/Sniffs/Laravel/EventListenerSuffixSniff/app/Listeners/ChangedSuffixListener.php',
            [
                'suffix' => 'Hears'
            ]
        );

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: EventListenerSuffixSniff::class
        );
    }

    protected static function getSniffClassName(): string
    {
        return EventListenerSuffixSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Laravel.EventListenerSuffix';
    }
}
