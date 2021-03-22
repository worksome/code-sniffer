<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\PhpDoc;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\PhpDoc\DisallowParamNoTypeOrCommentSniff;

class DisallowParamNoTypeOrCommentSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/PhpDoc/DisallowParamNoTypeOrCommentSniff/ValidParamTags.php');
        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/../../Resources/Sniffs/PhpDoc/DisallowParamNoTypeOrCommentSniff/ParamNoTypeOrComment.php');

        self::assertSame(1, $report->getErrorCount());

        self::assertSniffError(
            $report,
            $line = 11,
            DisallowParamNoTypeOrCommentSniff::class
        );

        self::assertAllFixedInFile($report);
    }

    protected static function getSniffClassName(): string
    {
        return DisallowParamNoTypeOrCommentSniff::class;
    }

    protected static function getSniffName(): string
    {
        return 'WorksomeSniff.PhpDoc.DisallowParamNoTypeOrComment';
    }


}