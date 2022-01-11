<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\PhpDoc;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\PhpDoc\DisallowParamNoTypeOrCommentSniff;
use Worksome\WorksomeSniff\Sniffs\PhpDoc\PropertyDollarSignSniff;

beforeEach(function () {
    $this->sniff = PropertyDollarSignSniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'valid properties' => __DIR__ . '/../../Resources/Sniffs/PhpDoc/PropertyDollarSignSniff/ValidProperties.php',
]);

it('has errors', function (string $path, array $lines) {
    $report = checkFile($path);

    expect($report)
        ->toHaveSniffErrors(count($lines));

    foreach ($lines as $line) {
        expect($report)
            ->toHaveSniffError(line: $line);
    }
})->with([
    'invalid properties' => [
        __DIR__ . '/../../Resources/Sniffs/PhpDoc/PropertyDollarSignSniff/InvalidProperties.php',
        [6, 7, 8],
    ],
]);