<?php

declare(strict_types=1);

use Str\Str;
use Str\Lib\StrModifiers;
use PHPUnit\Framework\TestCase;

class StrModifiersTest extends TestCase
{
    /**
     * @dataProvider ReplaceProvider
     * @param array $params
     * @param string $expected
     */
    public function testReplace(array $params, string $expected)
    {
        $this->assertEquals($expected, StrModifiers::replace(
            array_shift($params), // s
            array_shift($params), // old
            array_shift($params), // new
            array_shift($params)  // limit
        ));
    }
    public function ReplaceProvider()
    {
        return
            [
                [
                    ['oink oink oinkk', 'k', 'ky', 2],
                    'oinky oinky oinkk'
                ],

                [
                    ['oink oink oink', 'k', 'ky', 4],
                    'oinky oinky oinky'
                ],

                [
                    ['oink oink oink', 'oink', 'moo', -1],
                    'moo moo moo'
                ],

                [
                    ['hello world, hello universe', 'hello', 'привет', 1],
                    'привет world, hello universe'
                ],

                [
                    ['banana', 'a', 'e', 4],
                    'benene'
                ],

                [
                    ['ban 世 a!', ' 世', ' foo', -1],
                    'ban foo a!'
                ],

                [
                    ['世世世世世', '世', '界', 2],
                    '界界世世世'
                ],

                [
                    ['世世世世世', '世', '界', 0],
                    '世世世世世'
                ],

                [
                    ['世q世q世', 'q', 'q', 5],
                    '世q世q世'
                ],

                [
                    ['世q世q世', 'z', 'zz', 2],
                    '世q世q世'
                ],

                [
                    ['', 'a', 'b', -1],
                    ''
                ],
            ];
    }

    /**
     * @dataProvider trimProvider()
     * @param $expected
     * @param $str
     * @param string $chars
     */
    public function testTrim($expected, $str, $chars = '')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->trim($chars));
    }
    public function trimProvider()
    {
        return [
            ['foo   bar', '  foo   bar  '],
            ['foo bar', ' foo bar'],
            ['foo bar', 'foo bar '],
            ['foo bar', "\n\t foo bar \n\t"],
            ['fòô   bàř', '  fòô   bàř  '],
            ['fòô bàř', ' fòô bàř'],
            ['fòô bàř', 'fòô bàř '],
            [' foo bar ', "\n\t foo bar \n\t", "\n\t"],
            ['fòô bàř', "\n\t fòô bàř \n\t", ''],
            ['fòô', ' fòô ', ''], // narrow no-break space (U+202F)
            ['fòô', '  fòô  ', ''], // medium mathematical space (U+205F)
            ['fòô', '           fòô', ''] // spaces U+2000 to U+200A
        ];
    }

    /**
     * @dataProvider trimLeftProvider()
     * @param $expected
     * @param $str
     * @param string $chars
     */
    public function testTrimLeft($expected, $str, $chars = '')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->trimLeft($chars));
    }
    public function trimLeftProvider()
    {
        return [
            ['foo   bar  ', '  foo   bar  '],
            ['foo bar', ' foo bar'],
            ['foo bar ', 'foo bar '],
            ["foo bar \n\t", "\n\t foo bar \n\t"],
            ['fòô   bàř  ', '  fòô   bàř  '],
            ['fòô bàř', ' fòô bàř'],
            ['fòô bàř ', 'fòô bàř '],
            ['foo bar', '--foo bar', '-'],
            ['fòô bàř', 'òòfòô bàř', 'ò', 'UTF-8'],
            ["fòô bàř \n\t", "\n\t fòô bàř \n\t", ''],
            ['fòô ', ' fòô ', ''], // narrow no-break space (U+202F)
            ['fòô  ', '  fòô  ', ''], // medium mathematical space (U+205F)
            ['fòô', '           fòô', ''] // spaces U+2000 to U+200A
        ];
    }

    /**
     * @dataProvider trimRightProvider()
     * @param $expected
     * @param $str
     * @param string $chars
     */
    public function testTrimRight($expected, $str, $chars = '')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->trimRight($chars));
    }
    public function trimRightProvider()
    {
        return [
            ['  foo   bar', '  foo   bar  '],
            ['foo bar', 'foo bar '],
            [' foo bar', ' foo bar'],
            ["\n\t foo bar", "\n\t foo bar \n\t"],
            ['  fòô   bàř', '  fòô   bàř  '],
            ['fòô bàř', 'fòô bàř '],
            [' fòô bàř', ' fòô bàř'],
            ['foo bar', 'foo bar--', '-'],
            ['fòô bàř', 'fòô bàřòò', 'ò', 'UTF-8'],
            ["\n\t fòô bàř", "\n\t fòô bàř \n\t", ''],
            [' fòô', ' fòô ', ''], // narrow no-break space (U+202F)
            ['  fòô', '  fòô  ', ''], // medium mathematical space (U+205F)
            ['fòô', 'fòô           ', ''] // spaces U+2000 to U+200A
        ];
    }
}
