<?php

declare(strict_types=1);

namespace Worksome\WorksomeSniff\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractScopeSniff;
use PHP_CodeSniffer\Sniffs\Sniff;

final class DisallowPHPUnitTestsSniff implements Sniff
{
    public string $testSuffix = 'Test';

    /**
     * @var array<int, string>
     */
    public array $testDirectories = [
        'tests'
    ];

    public function register(): array
    {
        return [T_CLASS];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        if (! str_ends_with($phpcsFile->getFilename(), $this->testSuffix . '.php')) {
            return;
        }

        if (! $this->fileIsInTestDirectories($phpcsFile)) {
            return;
        }

        $classNamePointer = $stackPtr + 2;
        $className = $phpcsFile->getTokensAsString($classNamePointer, 1);

        if (! str_ends_with($className, $this->testSuffix)) {
            return;
        }

        if ($phpcsFile->findExtendedClassName($stackPtr) === false) {
            return;
        }

        $phpcsFile->addError(
            'PHPUnit tests are not allowed. Please use Pest PHP instead.',
            $classNamePointer,
            self::class,
        );
    }

    private function fileIsInTestDirectories(File $phpcsFile): bool
    {
        foreach ($this->testDirectories as $testDirectory) {
            if (str_contains($phpcsFile->getFilename(), $testDirectory)) {
                return true;
            }
        }

        return false;
    }

}
