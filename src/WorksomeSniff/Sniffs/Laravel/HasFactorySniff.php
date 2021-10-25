<?php

namespace Worksome\WorksomeSniff\Sniffs\Laravel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class HasFactorySniff implements Sniff
{

    public function register(): array
    {
        return [
            T_USE,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $traitNamePointer = $stackPtr + 2;
        $string = $phpcsFile->getTokensAsString($traitNamePointer, 10);

        if (Str::beforeLast($string, ';') !== HasFactory::class) {
            return;
        }

        $phpcsFile->addError(
            "Models should not use the `HasFactory` trait.",
            $traitNamePointer,
            self::class,
        );
    }
}
