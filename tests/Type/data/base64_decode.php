<?php

use function PHPStan\Testing\assertType;

function f(string $s): void
{
	assertType('string', \Safe\base64_decode($s));
	assertType('string', \base64_decode($s));
	assertType('string', \Safe\base64_decode($s, true));
	assertType('string|false', \base64_decode($s, true));
}
