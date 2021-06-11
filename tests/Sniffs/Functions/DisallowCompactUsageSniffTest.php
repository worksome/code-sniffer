<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Functions;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Functions\DisallowCompactUsageSniff;

class DisallowCompactUsageSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Functions/DisallowCompactUsageSniff/NoCompactCall.php');
        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Functions/DisallowCompactUsageSniff/CompactCall.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 13,
            code: DisallowCompactUsageSniff::class
        );

        self::assertAllFixedInFile($report);
    }

    protected static function getSniffClassName(): string
    {
        return DisallowCompactUsageSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Functions.DisallowCompactUsage';
    }
}