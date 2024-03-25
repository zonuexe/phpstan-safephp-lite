<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
    ])
	->withSpacing(indentation: 'tab')
    ->withRules([
        NoUnusedImportsFixer::class,
    ])
	->withPreparedSets(
		psr12: true,
        arrays: true,
        namespaces: true,
        docblocks: true,
        comments: true,
	);
