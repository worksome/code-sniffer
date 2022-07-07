<?php

namespace Worksome\WorksomeSniff\Tests\Sniffs\Comments;

use Worksome\WorksomeSniff\Sniffs\Comments\DisallowTodoCommentsSniff;

beforeEach(function () {
    $this->sniff = DisallowTodoCommentsSniff::class;
});

it('has no errors', function (string $path) {
    $report = checkFile($path);

    expect($report)->toHaveNoSniffErrors();
})->with([
    'comment without todo' => __DIR__ . '/../../Resources/Sniffs/Comments/DisallowTodoCommentsSniff/CommentWithoutTodo.php',
]);

it('has errors', function (string $path, int $line) {
    $report = checkFile($path);

    expect($report)
        ->toHaveSniffErrors(1)
        ->toHaveSniffError(line: $line);
})->with([
    'comment with todo upper' => [__DIR__ . '/../../Resources/Sniffs/Comments/DisallowTodoCommentsSniff/CommentWithTodoUpper.php', 9],
    'comment with todo lower' => [__DIR__ . '/../../Resources/Sniffs/Comments/DisallowTodoCommentsSniff/CommentWithTodoLower.php', 9],
    'comment with todo mixed' => [__DIR__ . '/../../Resources/Sniffs/Comments/DisallowTodoCommentsSniff/CommentWithTodoMixed.php', 9],
    'phpdoc with todo tag' => [__DIR__ . '/../../Resources/Sniffs/Comments/DisallowTodoCommentsSniff/PhpdocWithTodoTag.php', 8],
    'phpdoc with todo' => [__DIR__ . '/../../Resources/Sniffs/Comments/DisallowTodoCommentsSniff/PhpdocWithTodo.php', 8],
]);
