<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;
use Worksome\WorksomeSniff\Sniffs\Classes\DisallowPHPUnitTestsSniff;
use Worksome\WorksomeSniff\Sniffs\Classes\ExceptionSuffixSniff;

beforeEach(function () {
    $this->sniff = DisallowPHPUnitTestsSniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path, [
        'testDirectories' => [__DIR__ . '/../../Resources/Sniffs/Classes/DisallowPHPUnitTestsSniff/tests']
    ]);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'File outside of test directories' => __DIR__ . '/../../Resources/Sniffs/Classes/DisallowPHPUnitTestsSniff/TestOutsideOfTestDirectoryTest.php',
    'Trait ending with "Test" suffix' => __DIR__ . '/../../Resources/Sniffs/Classes/DisallowPHPUnitTestsSniff/tests/TraitTest.php',
    'Test that does not end with "Test" suffix' => __DIR__ . '/../../Resources/Sniffs/Classes/DisallowPHPUnitTestsSniff/tests/TestCase.php',
    'Random class that ends with "Test" suffix' => __DIR__ . '/../../Resources/Sniffs/Classes/DisallowPHPUnitTestsSniff/tests/SomeRandomClassThatDoesNotExtendTestCaseButEndsInTest.php',
]);

it('has errors', function (string $path, int $line) {
    $report = checkFile($path);

    expect($report)
        ->toHaveSniffErrors(1)
        ->toHaveSniffError(line: $line);
})->with([
    'class ending with "Test" suffix' => [
        __DIR__ . '/../../Resources/Sniffs/Classes/DisallowPHPUnitTestsSniff/tests/SomePhpUnitTest.php',
        5
    ]
]);
