<?php

declare(strict_types=1);

namespace zonuexe\PHPStan\SafePHP\Type;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(SafeFunctionsDynamicReturnTypeExtension::class)]
class SafeFunctionsDynamicReturnTypeExtensionTest extends TypeInferenceTestCase
{
    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__ . '/../../extension.neon',
        ];
    }

    #[DataProvider('dataFileAsserts')]
    public function testFileAsserts(string $assertType, string $file, mixed ...$args): void
    {
        $this->assertFileAsserts($assertType, $file, ...$args);
    }

    /**
     * @return iterable<mixed>
     */
    public static function dataFileAsserts(): iterable
    {
        yield from self::gatherAssertTypes(__DIR__ . '/data/base64_decode.php');
        yield from self::gatherAssertTypes(__DIR__ . '/data/file_get_contents.php');
        yield from self::gatherAssertTypes(__DIR__ . '/data/json_decode.php');
    }
}
