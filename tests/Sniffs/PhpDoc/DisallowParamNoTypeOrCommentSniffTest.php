<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\PhpDoc;

use Worksome\WorksomeSniff\Sniffs\PhpDoc\DisallowParamNoTypeOrCommentSniff;

beforeEach(function () {
    $this->sniff = DisallowParamNoTypeOrCommentSniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'valid parameter' => __DIR__ . '/../../Resources/Sniffs/PhpDoc/DisallowParamNoTypeOrCommentSniff/ValidParamTags.php',
]);

it('has errors', function (string $path, int $line) {
    $report = checkFile($path);

    expect($report)
        ->toHaveSniffErrors(1)
        ->toHaveSniffError(line: $line);
})->with([
    'missing type' => [
        __DIR__ . '/../../Resources/Sniffs/PhpDoc/DisallowParamNoTypeOrCommentSniff/ParamNoTypeOrComment.php',
        11
    ],
]);
