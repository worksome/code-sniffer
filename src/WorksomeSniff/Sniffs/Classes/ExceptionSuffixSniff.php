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
            T_EXTENDS
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $baseClassName = $phpcsFile->getTokensAsString($stackPtr + 2, 1);

        foreach ($phpcsFile->getTokens() as $index => $token) {
            if($token['type'] === 'T_EXTENDS') {
                $extendTokens = array_slice($phpcsFile->getTokens(), $index + 2, null, false);
                foreach ($extendTokens as $extendIndex => $extendToken) {
                    if($extendToken['type'] === 'T_WHITESPACE') {
                        $r = array_slice($extendTokens, $extendIndex - 1, null, false);
                        if(Str::contains($r[0]['content'], $this->suffix)) {
                            $baseClassName = $r[0]['content'];
                        }
                    }
                }
            }
        }

        if($baseClassName === '\\') {
            $baseClassName = $phpcsFile->getTokensAsString($stackPtr + 2, 2);
        }

        if (!Str::endsWith($baseClassName, $this->suffix) || !Str::contains($baseClassName, 'Exception')) {
            return;
        }

        $classNamePointer = $stackPtr - 2;

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
