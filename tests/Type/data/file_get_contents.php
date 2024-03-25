<?php

use function PHPStan\Testing\assertType;

function f(string $s): void
{
	assertType('string|false', \file_get_contents($s));
	assertType('string', \Safe\file_get_contents($s));
}
