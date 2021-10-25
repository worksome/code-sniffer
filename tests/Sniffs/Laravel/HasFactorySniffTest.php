<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Laravel;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Laravel\HasFactorySniff;

class HasFactorySniffTest extends TestCase
{

    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/HasFactorySniff/app/Models/WithoutHasFactory.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/HasFactorySniff/app/Models/WithHasFactory.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: HasFactorySniff::class,
        );
    }

    protected static function getSniffClassName(): string
    {
        return HasFactorySniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Laravel.HasFactory';
    }

}