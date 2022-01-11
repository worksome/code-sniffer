<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Laravel;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Functions\DisallowCompactUsageSniff;
use Worksome\WorksomeSniff\Sniffs\Laravel\DisallowHasFactorySniff;

beforeEach(function () {
    $this->sniff = DisallowHasFactorySniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'no hasFactory trait' => __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithoutHasFactory.php',
]);

it('has errors', function (string $path, array $lines) {
    $report = checkFile($path);

    expect($report)
        ->toHaveSniffErrors(count($lines));

    foreach ($lines as $line) {
        expect($report)->toHaveSniffError(line: $line);
    }

})->with([
    'has HasFactory trait' => [
        __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithHasFactory.php',
        [5, 9],
    ],
    'via FQCN' => [
        __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithHasFactoryDirectly.php',
        [7],
    ],
    'via mixed import' => [
        __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowHasFactorySniff/app/Models/WithHasFactoryMixed.php',
        [10],
    ]
]);
