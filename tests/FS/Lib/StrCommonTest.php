<?php

declare(strict_types=1);

namespace FS;

use FS\Lib\StrCommon;
use FS\Lib\StrModifiers;
use PHPUnit\Framework\TestCase;

class StrCommonTest extends TestCase
{
    /**
     * @dataProvider EnsureLeftProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureLeft(array $inp, string $out)
    {
        $this->assertEquals($out, StrModifiers::ensureLeft(
            array_shift($inp),
            array_shift($inp)
        ));
    }
    public function EnsureLeftProvider() {
        return
            [
                [
                    ['Hello world', '_left>>'],
                    '_left>>Hello world',
                ],

                [
                    ['_left>>Hello world', '_left>>'],
                    '_left>>Hello world',
                ],

                [
                    ['q', 'q'],
                    'q',
                ],

                [
                    ['qq', 'q'],
                    'qq',
                ],

                [
                    ['Hello, 世界', '界'],
                    '界Hello, 世界',
                ],

                [
                    ['界Hello, 世界', '界'],
                    '界Hello, 世界',
                ],

                [
                    ['世', '世'],
                    '世',
                ],
            ];
    }

    /**
     * @dataProvider EnsureRightProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureRight(array $inp, string $out)
    {
        $this->assertEquals($out, StrModifiers::ensureRight(
            array_shift($inp),
            array_shift($inp)
        ));
    }
    public function EnsureRightProvider() {
        return
            [
                [
                    ['Hello world', '<<_right'],
                    'Hello world<<_right',
                ],

                [
                    ['Hello world<<_right', '<<_right'],
                    'Hello world<<_right',
                ],

                [
                    ['q', 'q'],
                    'q',
                ],

                [
                    ['qq', 'q'],
                    'qq',
                ],

                [
                    ['Hello, 世界', '世'],
                    'Hello, 世界世',
                ],

                [
                    ['Hello, 世界界', '界'],
                    'Hello, 世界界',
                ],

                [
                    ['世', '世'],
                    '世',
                ],
            ];
    }

    /**
     * @dataProvider HasPrefixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasPrefix(array $inp, bool $result)
    {
        $this->assertEquals($result, Lib\StrCommon::hasPrefix(
            array_shift($inp),
            array_shift($inp)
        ));
    }
    public function HasPrefixProvider() {
        return
            [
                [
                    ['Hello world', 'Hel'],
                    true
                ],

                [
                    ['Hello world', 'ell'],
                    false
                ],

                [
                    ['世Hello world', '世'],
                    true
                ],

                [
                    ['世H世ello world世', '世H世'],
                    true
                ],

                [
                    ['世h世ello world世', '世H'],
                    false
                ],

                [
                    ['h', 'h'],
                    true
                ],

                [
                    ['hh', 'hh'],
                    true
                ],

                [
                    ['hhh', 'h'],
                    true
                ],

                [
                    ['h', ''],
                    false
                ],

                [
                    ['', 'h'],
                    false
                ],
            ];
    }

    /**
     * @dataProvider HasSuffixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasSuffix(array $inp, bool $result)
    {
        $this->assertEquals($result, Lib\StrCommon::hasSuffix(
            array_shift($inp),
            array_shift($inp)
        ));
    }
    public function HasSuffixProvider() {
        return
            [
                [
                    ['Hello world', 'rld'],
                    true
                ],

                [
                    ['Hello world', 'orl'],
                    false
                ],

                [
                    ['Hello world世', '世'],
                    true
                ],

                [
                    ['世H世ello worl世d世', '世d世'],
                    true
                ],

                [
                    ['世h世ello world世', 'D世'],
                    false
                ],

                [
                    ['h', 'h'],
                    true
                ],

                [
                    ['hh', 'hh'],
                    true
                ],

                [
                    ['hhh', 'h'],
                    true
                ],

                [
                    ['h', ''],
                    false
                ],

                [
                    ['', 'h'],
                    false
                ],
            ];
    }

    /**
     * @dataProvider ContainsProvider
     * @param array $inp
     * @param bool $result
     */
    public function testContains(array $inp, bool $result)
    {
        $this->assertEquals($result, Lib\StrCommon::contains(
            array_shift($inp),
            array_shift($inp)
        ));
    }
    public function ContainsProvider()
    {
        return
            [
                [
                    ['Hello world', 'o wor'],
                    true
                ],

                [
                    ['Hello world', 'rld'],
                    true
                ],

                [
                    ['世Hello', '世'],
                    true
                ],

                [
                    ['世', '世'],
                    true
                ],

                [
                    ['', ''],
                    true
                ],

                [
                    ['世', ''],
                    true
                ],

                [
                    ['q', 'q'],
                    true
                ],

                [
                    ['qq', 'q!'],
                    false
                ],

                [
                    [' test ', ' test '],
                    true
                ],

                [
                    ['Hello spaces world', ' '],
                    true
                ],
            ];
    }

    /**
     * @dataProvider SubstrProvider
     * @param $expected
     * @param $str
     * @param int $start
     * @param int $length
     */
    public function testSubstr($expected, $str, $start = 0, $length = 1)
    {
        $this->assertEquals($expected, StrCommon::substr($str, $start, $length));
    }
    public function SubstrProvider()
    {
        return [
            ['Hel', 'Hello world', 0, 3],
            ['H世', 'H世ello world', 0, 2],
            [' H世', '  H世', 1, 4],
            ['123', '000123000', 3, 3],
        ];
    }

    /**
     * @dataProvider AtProvider
     * @param $expected
     * @param $str
     * @param $pos
     */
    public function testAt($expected, $str, $pos)
    {
        $this->assertEquals($expected, StrCommon::at($str, $pos));
    }
    public function AtProvider() {
        return [
            ['H', 'Hello world', 0],
            ['e', 'Hello world', 1],
            ['d', 'Hello world', -1],
            ['世', '世', -1],
            ['世', '世', 0],
            ['', '', 0],
            ['', '', -1],
            ['', '', 1],
        ];
    }

    /**
     * @dataProvider charsProvider()
     * @param $expected
     * @param $str
     */
    public function testChars($expected, $str)
    {
        $this->assertInternalType('array', $expected);
        $this->assertEquals($expected, StrCommon::chars($str));
    }
    public function charsProvider()
    {
        return [
            [[], ''],
            [['T', 'e', 's', 't'], 'Test'],
            [['F', 'ò', 'ô', ' ', 'B', 'à', 'ř'], 'Fòô Bàř']
        ];
    }

    /**
     * @dataProvider firstProvider()
     * @param $expected
     * @param $str
     * @param $n
     */
    public function testFirst($expected, $str, $n)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->first($n));
    }
    public function firstProvider()
    {
        return [
            ['', 'foo bar', -5],
            ['', 'foo bar', 0],
            ['f', 'foo bar', 1],
            ['foo', 'foo bar', 3],
            ['foo bar', 'foo bar', 7],
            ['foo bar', 'foo bar', 8],
            ['', 'fòô bàř', -5],
            ['', 'fòô bàř', 0],
            ['f', 'fòô bàř', 1],
            ['fòô', 'fòô bàř', 3],
            ['fòô bàř', 'fòô bàř', 7],
            ['fòô bàř', 'fòô bàř', 8],
        ];
    }

    /**
     * @dataProvider lastProvider()
     * @param $expected
     * @param $str
     * @param $n
     */
    public function testLast($expected, $str, $n)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->last($n));
    }
    public function lastProvider()
    {
        return [
            ['', 'foo bar', -5],
            ['', 'foo bar', 0],
            ['r', 'foo bar', 1],
            ['bar', 'foo bar', 3],
            ['foo bar', 'foo bar', 7],
            ['foo bar', 'foo bar', 8],
            ['', 'fòô bàř', -5],
            ['', 'fòô bàř', 0],
            ['ř', 'fòô bàř', 1],
            ['bàř', 'fòô bàř', 3],
            ['fòô bàř', 'fòô bàř', 7],
            ['fòô bàř', 'fòô bàř', 8],
        ];
    }
}
