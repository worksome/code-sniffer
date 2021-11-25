<?php

namespace Worksome\WorksomeSniff\Tests\Resources\Sniffs\PhpDoc\PropertyDollarSignSniff;

/**
 * @property array<string, string> $foo
 * @property array<string,string> $bam
 * @property array{foo: string, bar: int} $foobar
 * @property string $bar
 * @property int $baz
 */
class ValidProperties
{

}
