<?php

declare(strict_types=1);

use Str\Ascii;
use PHPUnit\Framework\TestCase;

class AsciiTest extends TestCase
{
    /**
     * @dataProvider CheckWithRegexProvider
     * @param $expected
     * @param $str
     */
    public function testCheckWithRegex($expected, $str)
    {
        $this->assertEquals($expected, Ascii::checkWithRegex($str));
    }

    public function CheckWithRegexProvider()
    {
        return [
            [true, 'Hello world'],
            [true, 'H&ello $%world'],
            [false, '  H世'],
            [false, 'fòô bàř'],
        ];
    }

    /**
     * @dataProvider CheckWithMbProvider
     * @param $expected
     * @param $str
     */
    public function testCheckWithMb($expected, $str)
    {
        $this->assertEquals($expected, Ascii::checkWithMb($str));
    }

    public function CheckWithMbProvider()
    {
        return [
            [true, 'Hello world'],
            [true, 'H&ello $%world'],
            [false, '  H世'],
            [false, 'ᾲčc 45'],
        ];
    }

    /**
     * @dataProvider CheckWithCTypeProvider
     * @param $expected
     * @param $str
     */
    public function testCheckWithCType($expected, $str)
    {
        $this->assertEquals($expected, Ascii::checkWithCType($str));
    }

    public function CheckWithCTypeProvider()
    {
        return [
            [true, 'Hello world'],
            [true, 'H&ello $%world'],
            [false, '  H世'],
            [false, 'ᾲčc 45'],
        ];
    }
}