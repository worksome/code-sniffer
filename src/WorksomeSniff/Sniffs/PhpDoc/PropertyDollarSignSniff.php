<?php

namespace Worksome\WorksomeSniff\Sniffs\PhpDoc;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class PropertyDollarSignSniff implements Sniff
{
    public function register(): array
    {
        return [
            T_DOC_COMMENT_TAG,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        // Check if @property
        if (!str_contains($phpcsFile->getTokensAsString($stackPtr, 1), '@property')) {
            return;
        }

        $value = $phpcsFile->getTokensAsString($stackPtr+2, 1);
        $regex = '/^((\S)+[[:blank:]]+)(\$?\w+)/m';

        if (!\Safe\preg_match($regex, $value, $matches)) {
            $phpcsFile->addError(
                "@property has invalid format.",
                $stackPtr,
                self::class
            );
            return;
        }

        $variableName = $matches[3];

        // Variable has a dollar sign, so let's exist.
        if (str_starts_with($variableName, '$')) {
            return;
        }

        $phpcsFile->addFixableError(
            "All @property comment should have dollar sign.",
            $stackPtr,
            self::class
        );

        $replacement = \Safe\preg_replace(
            $regex,
            '$1\$$3',
            $value
        );

        $phpcsFile->fixer->replaceToken(
            $stackPtr+2,
            $replacement
        );
    }
}
