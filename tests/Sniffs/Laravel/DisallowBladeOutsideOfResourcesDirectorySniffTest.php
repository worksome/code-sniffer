<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Laravel;

use Worksome\WorksomeSniff\Sniffs\Laravel\DisallowBladeOutsideOfResourcesDirectorySniff;

beforeEach(function () {
    $this->sniff = DisallowBladeOutsideOfResourcesDirectorySniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path, [
        'resourcesDirectory' => __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowBladeOutsideOfResourcesDirectorySniff/resources',
    ]);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'at root of resources' => __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowBladeOutsideOfResourcesDirectorySniff/resources/valid.blade.php',
    'nested inside resources' => __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowBladeOutsideOfResourcesDirectorySniff/resources/nested/valid.blade.php',
    'not a blade file' => __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowBladeOutsideOfResourcesDirectorySniff/NotABladeFile.php',
]);

it('has errors', function (string $path, int $line) {
    $report = checkFile($path, [
        'resourcesDirectory' => __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowBladeOutsideOfResourcesDirectorySniff/resources',
    ]);

    expect($report)
        ->toHaveSniffErrors(1)
        ->toHaveSniffError(line: $line);
})->with([
    'is outside resources directory' => [
        __DIR__ . '/../../Resources/Sniffs/Laravel/DisallowBladeOutsideOfResourcesDirectorySniff/invalid.blade.php',
        1
    ],
]);
