<?php

namespace Worksome\WorksomeSniff\Sniffs\Classes;

use Illuminate\Support\Str;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ExceptionSuffixSniff implements Sniff
{
    public string $suffix = "Exception";

    public function register(): array
    {
        return [
            T_CLASS,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $path = $phpcsFile->getFilename();

        $baseClassName = $phpcsFile->getTokensAsString($stackPtr + 6, 1);

        if($baseClassName === '\\') {
            $baseClassName = $phpcsFile->getTokensAsString($stackPtr + 6, 2);
        }

        if (!Str::endsWith($baseClassName, $this->suffix)) {
            return;
        }

        $classNamePointer = $stackPtr + 2;

        $className = $phpcsFile->getTokensAsString($classNamePointer, 1);

        // Check if class is named with Exceptions suffix.
        if (Str::endsWith($className, $this->suffix)) {
            return;
        }

        $phpcsFile->addError(
            "Exceptions should have `Exception` suffix.",
            $classNamePointer,
            self::class,
        );
    }
}
