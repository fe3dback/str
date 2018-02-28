<?php

declare(strict_types=1);

use Str\Str;
use Str\Lib\StrModifiersMB;
use PHPUnit\Framework\TestCase;

class StrModifiersTest extends TestCase
{
    /**
     * @dataProvider SubstrProvider
     * @param $expected
     * @param $str
     * @param int $start
     * @param int $length
     */
    public function testSubstr($expected, $str, $start = 0, $length = 1)
    {
        $this->assertEquals($expected, StrModifiersMB::substr($str, $start, $length));
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
     * @dataProvider charsProvider()
     * @param $expected
     * @param $str
     */
    public function testChars($expected, $str)
    {
        $this->assertInternalType('array', $expected);
        $this->assertEquals($expected, StrModifiersMB::chars($str));
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

    /**
     * @dataProvider toLowerCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testToLowerCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toLowerCase());
    }
    public function toLowerCaseProvider()
    {
        return [
            ['foo bar', 'FOO BAR'],
            [' foo_bar ', ' FOO_bar '],
            ['fòô bàř', 'FÒÔ BÀŘ'],
            [' fòô_bàř ', ' FÒÔ_bàř '],
            ['αυτοκίνητο', 'ΑΥΤΟΚΊΝΗΤΟ'],
        ];
    }

    /**
     * @dataProvider toUpperCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testToUpperCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toUpperCase());
    }
    public function toUpperCaseProvider()
    {
        return [
            ['FOO BAR', 'foo bar'],
            [' FOO_BAR ', ' FOO_bar '],
            ['FÒÔ BÀŘ', 'fòô bàř'],
            [' FÒÔ_BÀŘ ', ' FÒÔ_bàř '],
            ['ΑΥΤΟΚΊΝΗΤΟ', 'αυτοκίνητο'],
        ];
    }

    /**
     * @dataProvider appendProvider()
     * @param $expected
     * @param $str
     * @param $string
     */
    public function testAppend($expected, $str, $string)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->append($string));
    }
    public function appendProvider()
    {
        return [
            ['foobar', 'foo', 'bar'],
            ['fòôbàř', 'fòô', 'bàř']
        ];
    }

    /**
     * @dataProvider prependProvider()
     * @param $expected
     * @param $str
     * @param $string
     */
    public function testPrepend($expected, $str, $string)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->prepend($string));
    }
    public function prependProvider()
    {
        return [
            ['foobar', 'bar', 'foo'],
            ['fòôbàř', 'bàř', 'fòô']
        ];
    }

    /**
     * @dataProvider ReplaceProvider
     * @param array $params
     * @param string $expected
     */
    public function testReplace(array $params, string $expected)
    {
        $this->assertEquals($expected, StrModifiersMB::replace(
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
            ['fòô bàř', 'òòfòô bàř', 'ò'],
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
            ['fòô bàř', 'fòô bàřòò', 'ò'],
            ["\n\t fòô bàř", "\n\t fòô bàř \n\t", ''],
            [' fòô', ' fòô ', ''], // narrow no-break space (U+202F)
            ['  fòô', '  fòô  ', ''], // medium mathematical space (U+205F)
            ['fòô', 'fòô           ', ''] // spaces U+2000 to U+200A
        ];
    }

    /**
     * @dataProvider padProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param string $padStr
     * @param string $padType
     */
    public function testPad($expected, $str, $length, $padStr = ' ', $padType = 'right')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->pad($length, $padStr, $padType));
    }
    public function padProvider()
    {
        return [
            // length <= str
            ['foo bar', 'foo bar', -1],
            ['foo bar', 'foo bar', 7],
            ['fòô bàř', 'fòô bàř', 7, ' ', 'right'],
            // right
            ['foo bar  ', 'foo bar', 9],
            ['foo bar_*', 'foo bar', 9, '_*', 'right'],
            ['fòô bàř¬ø¬', 'fòô bàř', 10, '¬ø', 'right'],
            // left
            ['  foo bar', 'foo bar', 9, ' ', 'left'],
            ['_*foo bar', 'foo bar', 9, '_*', 'left'],
            ['¬ø¬fòô bàř', 'fòô bàř', 10, '¬ø', 'left'],
            // both
            ['foo bar ', 'foo bar', 8, ' ', 'both'],
            ['¬fòô bàř¬ø', 'fòô bàř', 10, '¬ø', 'both'],
            ['¬øfòô bàř¬øÿ', 'fòô bàř', 12, '¬øÿ', 'both'],
            // wrong pad type
            ['foo bar', 'foo bar', 8, ' ', 'wrong']
        ];
    }

    /**
     * @dataProvider padLeftProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param string $padStr
     */
    public function testPadLeft($expected, $str, $length, $padStr = ' ')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->padLeft($length, $padStr));
    }
    public function padLeftProvider()
    {
        return [
            ['  foo bar', 'foo bar', 9],
            ['_*foo bar', 'foo bar', 9, '_*'],
            ['_*_foo bar', 'foo bar', 10, '_*'],
            ['  fòô bàř', 'fòô bàř', 9, ' '],
            ['¬øfòô bàř', 'fòô bàř', 9, '¬ø'],
            ['¬ø¬fòô bàř', 'fòô bàř', 10, '¬ø'],
            ['¬ø¬øfòô bàř', 'fòô bàř', 11, '¬ø'],
        ];
    }

    /**
     * @dataProvider padRightProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param string $padStr
     */
    public function testPadRight($expected, $str, $length, $padStr = ' ')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->padRight($length, $padStr));
    }
    public function padRightProvider()
    {
        return [
            ['foo bar  ', 'foo bar', 9],
            ['foo bar_*', 'foo bar', 9, '_*'],
            ['foo bar_*_', 'foo bar', 10, '_*'],
            ['fòô bàř  ', 'fòô bàř', 9, ' '],
            ['fòô bàř¬ø', 'fòô bàř', 9, '¬ø'],
            ['fòô bàř¬ø¬', 'fòô bàř', 10, '¬ø'],
            ['fòô bàř¬ø¬ø', 'fòô bàř', 11, '¬ø'],
        ];
    }

    /**
     * @dataProvider padBothProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param string $padStr
     */
    public function testPadBoth($expected, $str, $length, $padStr = ' ')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->padBoth($length, $padStr));
    }
    public function padBothProvider()
    {
        return [
            ['foo bar ', 'foo bar', 8],
            [' foo bar ', 'foo bar', 9, ' '],
            ['fòô bàř ', 'fòô bàř', 8, ' '],
            [' fòô bàř ', 'fòô bàř', 9, ' '],
            ['fòô bàř¬', 'fòô bàř', 8, '¬ø'],
            ['¬fòô bàř¬', 'fòô bàř', 9, '¬ø'],
            ['¬fòô bàř¬ø', 'fòô bàř', 10, '¬ø'],
            ['¬øfòô bàř¬ø', 'fòô bàř', 11, '¬ø'],
            ['¬fòô bàř¬ø', 'fòô bàř', 10, '¬øÿ'],
            ['¬øfòô bàř¬ø', 'fòô bàř', 11, '¬øÿ'],
            ['¬øfòô bàř¬øÿ', 'fòô bàř', 12, '¬øÿ']
        ];
    }

    /**
     * @dataProvider insertProvider()
     * @param $expected
     * @param $str
     * @param $substring
     * @param $index
     */
    public function testInsert($expected, $str, $substring, $index)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->insert($substring, $index));
    }
    public function insertProvider()
    {
        return [
            ['foo bar', 'oo bar', 'f', 0],
            ['foo bar', 'f bar', 'oo', 1],
            ['f bar', 'f bar', 'oo', 20],
            ['foo bar', 'foo ba', 'r', 6],
            ['fòôbàř', 'fòôbř', 'à', 4],
            ['fòô bàř', 'òô bàř', 'f', 0],
            ['fòô bàř', 'f bàř', 'òô', 1],
            ['fòô bàř', 'fòô bà', 'ř', 6]
        ];
    }

    /**
     * @dataProvider removeLeftProvider()
     * @param $expected
     * @param $str
     * @param $substring
     */
    public function testRemoveLeft($expected, $str, $substring)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->removeLeft($substring));
    }
    public function removeLeftProvider()
    {
        $s = new Str('foo bar');
        return [
            ['foo bar', 'foo bar', ''],
            ['oo bar', 'foo bar', 'f'],
            ['bar', 'foo bar', 'foo '],
            ['foo bar', 'foo bar', 'oo'],
            ['foo bar', 'foo bar', 'oo bar'],
            ['oo bar', 'foo bar', $s->first()],
            ['oo bar', 'foo bar', $s->at(0)],
            ['fòô bàř', 'fòô bàř', ''],
            ['òô bàř', 'fòô bàř', 'f'],
            ['bàř', 'fòô bàř', 'fòô '],
            ['fòô bàř', 'fòô bàř', 'òô'],
            ['fòô bàř', 'fòô bàř', 'òô bàř']
        ];
    }

    /**
     * @dataProvider removeRightProvider()
     * @param $expected
     * @param $str
     * @param $substring
     */
    public function testRemoveRight($expected, $str, $substring)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->removeRight($substring));
    }
    public function removeRightProvider()
    {
        $s = new Str('foo bar');
        return [
            ['foo bar', 'foo bar', ''],
            ['foo ba', 'foo bar', 'r'],
            ['foo', 'foo bar', ' bar'],
            ['foo bar', 'foo bar', 'ba'],
            ['foo bar', 'foo bar', 'foo ba'],
            ['foo ba', 'foo bar', $s->last()],
            ['foo ba', 'foo bar', $s->at(6)],
            ['fòô bàř', 'fòô bàř', ''],
            ['fòô bà', 'fòô bàř', 'ř'],
            ['fòô', 'fòô bàř', ' bàř'],
            ['fòô bàř', 'fòô bàř', 'bà'],
            ['fòô bàř', 'fòô bàř', 'fòô bà']
        ];
    }

    /**
     * @dataProvider repeatProvider()
     */
    public function testRepeat($expected, $str, $multiplier)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->repeat($multiplier));
    }
    public function repeatProvider()
    {
        return [
            ['', 'foo', 0],
            ['foo', 'foo', 1],
            ['foofoo', 'foo', 2],
            ['foofoofoo', 'foo', 3],
            ['fòô', 'fòô', 1],
            ['fòôfòô', 'fòô', 2],
            ['fòôfòôfòô', 'fòô', 3]
        ];
    }

    /**
     * @dataProvider reverseProvider()
     * @param $expected
     * @param $str
     */
    public function testReverse($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->reverse());
    }
    public function reverseProvider()
    {
        return [
            ['', ''],
            ['raboof', 'foobar'],
            ['řàbôòf', 'fòôbàř'],
            ['řàb ôòf', 'fòô bàř'],
            ['∂∆ ˚åß', 'ßå˚ ∆∂']
        ];
    }

    /**
     * @dataProvider shuffleProvider()
     * @param $str
     */
    public function testShuffle($str)
    {
        $s = new Str($str);
        $result = $s->shuffle();

        $oldValues = StrModifiersMB::chars((string)$s);
        $newValues = StrModifiersMB::chars((string)$result);

        $countOld = array_count_values($oldValues);
        $countNew = array_count_values($newValues);

        // We'll make sure that the chars are present after shuffle
        $this->assertEquals($countOld, $countNew);
        $this->assertEquals(true, empty(array_diff($countOld, $countNew)));
    }
    public function shuffleProvider()
    {
        return [
            ['foo bar'],
            ['∂∆ ˚åß'],
            ['å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬']
        ];
    }

    /**
     * @dataProvider betweenProvider()
     * @param $expected
     * @param $str
     * @param $start
     * @param $end
     * @param int $offset
     */
    public function testBetween($expected, $str, $start, $end, $offset = 0)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->between($start, $end, $offset), $str);
    }
    public function betweenProvider()
    {
        return [
            ['', 'foo', '{', '}'],
            ['', '{foo', '{', '}'],
            ['foo', '{foo}', '{', '}'],
            ['{foo', '{{foo}', '{', '}'],
            ['', '{}foo}', '{', '}'],
            ['foo', '}{foo}', '{', '}'],
            ['foo', 'A description of {foo} goes here', '{', '}'],
            ['bar', '{foo} and {bar}', '{', '}', 1],
            ['', 'fòô', '{', '}', 0],
            ['', '{fòô', '{', '}', 0],
            ['fòô', '{fòô}', '{', '}', 0],
            ['{fòô', '{{fòô}', '{', '}', 0],
            ['', '{}fòô}', '{', '}', 0],
            ['fòô', '}{fòô}', '{', '}', 0],
            ['fòô', 'A description of {fòô} goes here', '{', '}', 0],
            ['bàř', '{fòô} and {bàř}', '{', '}', 1]
        ];
    }

    /**
     * @dataProvider camelizeProvider()
     */
    public function testCamelize($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->camelize(), $str);
    }
    public function camelizeProvider()
    {
        return [
            ['camelCase', 'CamelCase'],
            ['camelCase', 'Camel-Case'],
            ['camelCase', 'camel case'],
            ['camelCase', 'camel -case'],
            ['camelCase', 'camel - case'],
            ['camelCase', 'camel_case'],
            ['camelCTest', 'camel c test'],
            ['stringWith1Number', 'string_with1number'],
            ['stringWith22Numbers', 'string-with-2-2 numbers'],
            ['dataRate', 'data_rate'],
            ['backgroundColor', 'background-color'],
            ['yesWeCan', 'yes_we_can'],
            ['mozSomething', '-moz-something'],
            ['carSpeed', '_car_speed_'],
            ['serveHTTP', 'ServeHTTP'],
            ['1Camel2Case', '1camel2case'],
            ['camelΣase', 'camel σase'],
            ['στανιλCase', 'Στανιλ case'],
            ['σamelCase', 'σamel  Case']
        ];
    }

    /**
     * @dataProvider upperCaseFirstProvider()
     * @param $expected
     * @param $str
     */
    public function testUpperCaseFirst($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->upperCaseFirst(), $str);
    }
    public function upperCaseFirstProvider()
    {
        return [
            ['Test', 'Test'],
            ['Test', 'test'],
            ['1a', '1a'],
            ['Σ test', 'σ test'],
            [' σ test', ' σ test']
        ];
    }

    /**
     * @dataProvider lowerCaseFirstProvider()
     * @param $expected
     * @param $str
     */
    public function testLowerCaseFirst($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->lowerCaseFirst(), $str);
    }
    public function lowerCaseFirstProvider()
    {
        return [
            ['test', 'Test'],
            ['test', 'test'],
            ['1a', '1a'],
            ['σ test', 'Σ test'],
            [' Σ test', ' Σ test']
        ];
    }

    /**
     * @dataProvider collapseWhitespaceProvider()
     * @param $expected
     * @param $str
     */
    public function testCollapseWhitespace($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->collapseWhitespace(), $str);
    }
    public function collapseWhitespaceProvider()
    {
        return [
            ['foo bar', '  foo   bar  '],
            ['test string', 'test string'],
            ['Ο συγγραφέας', '   Ο     συγγραφέας  '],
            ['123', ' 123 '],
            ['', ' '], // no-break space (U+00A0)
            ['', '           '], // spaces U+2000 to U+200A
            ['', ' '], // narrow no-break space (U+202F)
            ['', ' '], // medium mathematical space (U+205F)
            ['', '　'], // ideographic space (U+3000)
            ['1 2 3', '  1  2  3　　'],
            ['', ' '],
            ['', ''],
        ];
    }

    /**
     * @dataProvider regexReplaceProvider()
     * @param $expected
     * @param $str
     * @param $pattern
     * @param $replacement
     * @param string $options
     */
    public function testRegexReplace($expected, $str, $pattern, $replacement, $options = 'msr')
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->regexReplace($pattern, $replacement, $options), $str);
    }
    public function regexReplaceProvider()
    {
        return [
            ['', '', '', ''],
            ['bar', 'foo', 'f[o]+', 'bar'],
            ['o bar', 'foo bar', 'f(o)o', '\1'],
            ['bar', 'foo bar', 'f[O]+\s', '', 'i'],
            ['foo', 'bar', '[[:alpha:]]{3}', 'foo'],
            ['', '', '', '', 'msr'],
            ['bàř', 'fòô ', 'f[òô]+\s', 'bàř', 'msr'],
            ['fòô', 'fò', '(ò)', '\\1ô', 'msr'],
            ['fòô', 'bàř', '[[:alpha:]]{3}', 'fòô', 'msr']
        ];
    }

    /**
     * @dataProvider dasherizeProvider()
     * @param $expected
     * @param $str
     */
    public function testDasherize($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->dasherize(), $str);
    }
    public function dasherizeProvider()
    {
        return [
            ['test-case', 'testCase'],
            ['test-case', 'Test-Case'],
            ['test-case', 'test case'],
            ['-test-case', '-test -case'],
            ['test-case', 'test - case'],
            ['test-case', 'test_case'],
            ['test-c-test', 'test c test'],
            ['test-d-case', 'TestDCase'],
            ['test-c-c-test', 'TestCCTest'],
            ['string-with1number', 'string_with1number'],
            ['string-with-2-2-numbers', 'String-with_2_2 numbers'],
            ['1test2case', '1test2case'],
            ['data-rate', 'dataRate'],
            ['car-speed', 'CarSpeed'],
            ['yes-we-can', 'yesWeCan'],
            ['background-color', 'backgroundColor'],
            ['dash-σase', 'dash Σase'],
            ['στανιλ-case', 'Στανιλ case'],
            ['σash-case', 'Σash  Case']
        ];
    }

    /**
     * @dataProvider delimitProvider()
     * @param $expected
     * @param $str
     * @param $delimiter
     */
    public function testDelimit($expected, $str, $delimiter)
    {
        $s = new Str($str);
        $this->assertEquals($expected, (string)$s->delimit($delimiter), $str);
    }
    public function delimitProvider()
    {
        return [
            ['test*case', 'testCase', '*'],
            ['test&case', 'Test-Case', '&'],
            ['test#case', 'test case', '#'],
            ['test**case', 'test -case', '**'],
            ['~!~test~!~case', '-test - case', '~!~'],
            ['test*case', 'test_case', '*'],
            ['test%c%test', '  test c test', '%'],
            ['test+u+case', 'TestUCase', '+'],
            ['test=c=c=test', 'TestCCTest', '='],
            ['string#>with1number', 'string_with1number', '#>'],
            ['1test2case', '1test2case', '*'],
            ['test ύα σase', 'test Σase', ' ύα ',],
            ['στανιλαcase', 'Στανιλ case', 'α',],
            ['σashΘcase', 'Σash  Case', 'Θ']
        ];
    }
}
