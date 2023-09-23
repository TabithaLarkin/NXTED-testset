<?php

declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use Nxted\InputHelper;
use PHPUnit\Framework\TestCase;

final class InputHelperTest extends TestCase
{
    public function testNumericValues(): void
    {
        InputHelper::checkNumericInput([1, 2]);

        $this->expectNotToPerformAssertions();
    }

    public function testStringNumericValues(): void
    {
        InputHelper::checkNumericInput(["1", "2"]);

        $this->expectNotToPerformAssertions();
    }

    public function testStringNonNumericValues(): void
    {
        $this->expectException(InvalidArgumentException::class);

        InputHelper::checkNumericInput(["1", "2a"]);
    }

    public function testNullValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        InputHelper::checkNumericInput([null, "2"]);
    }
}
