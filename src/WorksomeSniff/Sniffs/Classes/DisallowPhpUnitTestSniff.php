<?php

namespace Worksome\WorksomeSniff\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class DisallowPhpUnitTestSniff implements Sniff
{
    public function register(): array
    {
        return [
            T_DOC_COMMENT_TAG,
            T_FUNCTION,
        ];
    }

    public function process(File $phpcsFile, $stackPtr): void
    {
        // Make sure the file is in the `tests` directory.
        if (! str_contains($phpcsFile->getFilename(), DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR)) {
            return;
        }

        match($phpcsFile->getTokens()[$stackPtr]['code']) {
            T_DOC_COMMENT_TAG => $this->checkDocCommentTag($phpcsFile, $stackPtr),
            T_FUNCTION => $this->checkMethod($phpcsFile, $stackPtr),
        };
    }

    private function checkDocCommentTag(File $phpcsFile, $stackPtr): void
    {
        $annotation = $phpcsFile->getTokensAsString($stackPtr, 1);

        if ($annotation === '@test') {
            $this->addError($phpcsFile, $stackPtr);
        }
    }

    private function checkMethod(File $phpcsFile, $stackPtr): void
    {
        $methodName = $phpcsFile->getTokensAsString($stackPtr + 2, 1);

        if (str_starts_with(strtolower($methodName), 'test')) {
            $this->addError($phpcsFile, $stackPtr);
        }
    }

    private function addError(File $phpcsFile, $stackPtr): void
    {
        $phpcsFile->addError(
            'PHPUnit tests are not allowed. Please convert to Pest PHP tests.',
            $stackPtr,
            self::class
        );
    }
}
