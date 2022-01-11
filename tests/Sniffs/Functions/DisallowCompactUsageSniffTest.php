<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Functions;

use Worksome\WorksomeSniff\Sniffs\Functions\DisallowCompactUsageSniff;

beforeEach(function () {
    $this->sniff = DisallowCompactUsageSniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'no compact call' => __DIR__ . '/../../Resources/Sniffs/Functions/DisallowCompactUsageSniff/NoCompactCall.php',
]);

it('has errors', function (string $path, int $line) {
    $report = checkFile($path);

    expect($report)
        ->toHaveSniffErrors(1)
        ->toHaveSniffError(line: $line);
})->with([
    'has compact call' => [
        __DIR__ . '/../../Resources/Sniffs/Functions/DisallowCompactUsageSniff/CompactCall.php',
        13
    ],
]);
