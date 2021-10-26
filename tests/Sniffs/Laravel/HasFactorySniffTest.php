<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Laravel;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Laravel\DisallowHasFactorySniff;

class HasFactorySniffTest extends TestCase
{

    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithoutHasFactory.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrorsInNamespace(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithHasFactory.php');

        self::assertSame(2, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 5,
            code: DisallowHasFactorySniff::class,
        );

        self::assertSniffError(
            phpcsFile: $report,
            line: 9,
            code: DisallowHasFactorySniff::class,
        );
    }

    public function testErrorsWhenUsingDirectly(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithHasFactoryDirectly.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 7,
            code: DisallowHasFactorySniff::class,
        );
    }

    public function testErrorsWhenUsingMixed(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithHasFactoryMixed.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            phpcsFile: $report,
            line: 10,
            code: DisallowHasFactorySniff::class,
        );
    }

    protected static function getSniffClassName(): string
    {
        return DisallowHasFactorySniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.Laravel.DisallowHasFactory';
    }

}
