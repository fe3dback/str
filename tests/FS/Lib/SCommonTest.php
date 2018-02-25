<?php

declare(strict_types=1);

namespace FS;

use PHPUnit\Framework\TestCase;

class SCommonTest extends TestCase
{
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
     * @dataProvider EnsureLeftProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureLeft(array $inp, string $out)
    {
        $this->assertEquals($out, Lib\StrCommon::ensureLeft(
            array_shift($inp),
            array_shift($inp)
        ));
    }

    /**
     * @dataProvider EnsureRightProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureRight(array $inp, string $out)
    {
        $this->assertEquals($out, Lib\StrCommon::ensureRight(
            array_shift($inp),
            array_shift($inp)
        ));
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

    /**
     * @dataProvider ReplaceProvider
     * @param array $params
     * @param bool $expected
     */
    public function testReplace(array $params, string $expected)
    {
        $this->assertEquals($expected, Lib\StrCommon::replace(
            array_shift($params), // s
            array_shift($params), // old
            array_shift($params), // new
            array_shift($params)  // limit
        ));
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
