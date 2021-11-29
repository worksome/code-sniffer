<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\PhpDoc;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\PhpDoc\DisallowParamNoTypeOrCommentSniff;
use Worksome\WorksomeSniff\Sniffs\PhpDoc\PropertyDollarSignSniff;

class PropertyDollarSignSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/PhpDoc/PropertyDollarSignSniff/ValidProperties.php');
        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/PhpDoc/PropertyDollarSignSniff/InvalidProperties.php');

        self::assertSame(3, $report->getErrorCount());

        self::assertSniffError(
            $report,
            $line = 6,
            PropertyDollarSignSniff::class,
            message: 'All @property comment should have dollar sign.'
        );

        self::assertSniffError(
            $report,
            $line = 7,
            PropertyDollarSignSniff::class,
            message: 'All @property comment should have dollar sign.'
        );

        self::assertSniffError(
            $report,
            $line = 8,
            PropertyDollarSignSniff::class,
            message: 'All @property comment should have dollar sign.'
        );
    }

    protected static function getSniffClassName(): string
    {
        return PropertyDollarSignSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.PhpDoc.PropertyDollarSign';
    }


}
