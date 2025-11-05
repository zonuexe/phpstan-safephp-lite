<?php

declare(strict_types=1);

use function PHPStan\Testing\assertType;

function f(string $s): void
{
	assertType('mixed', \Safe\json_decode($s));
	assertType('mixed', \json_decode($s));
	assertType('mixed~object', \Safe\json_decode($s, true));
	assertType('mixed~object', \json_decode($s, true));
}

function g(): void
{
	$s = 'false';
	assertType('false', \Safe\json_decode($s));
	assertType('false', \json_decode($s));
	assertType('false', \Safe\json_decode($s, true));
	assertType('false', \json_decode($s, true));
}

function h(): void
{
	$s = '{"foo":1}';
	// assertType('stdClass', \Safe\json_decode($s));
	// assertType('stdClass', \json_decode($s));
	assertType('array{foo: 1}', \Safe\json_decode($s, true));
	assertType('array{foo: 1}', \json_decode($s, true));
}
