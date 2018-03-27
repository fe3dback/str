<?php

declare(strict_types=1);

namespace Str;

use PHPUnit\Framework\TestCase;

class StrNewTest extends TestCase
{
    /**
     * @dataProvider HasPrefixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasPrefix(array $inp, bool $result)
    {
        $s = new Str($inp[0]);
        $prefix = $inp[1];
        $this->assertEquals($result, $s->hasPrefix($prefix));
    }

    public function HasPrefixProvider()
    {
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
        $s = new Str($inp[0]);
        $prefix = $inp[1];
        $this->assertEquals($result, $s->hasSuffix($prefix));
    }

    public function HasSuffixProvider()
    {
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
     * @dataProvider SubstrProvider
     * @param $expected
     * @param $str
     * @param int $start
     * @param int $length
     */
    public function testSubstr($expected, $str, $start = 0, $length = 1)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->substr($start, $length));
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
     * @dataProvider EnsureRightProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureRight(array $inp, string $out)
    {
        $s = new Str($inp[0]);
        $affix = $inp[1];
        $this->assertEquals($out, $s->ensureRight($affix));
    }

    public function EnsureRightProvider()
    {
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
     * @dataProvider EnsureLeftProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureLeft(array $inp, string $out)
    {
        $s = new Str($inp[0]);
        $affix = $inp[1];
        $this->assertEquals($out, $s->ensureLeft($affix));
    }

    public function EnsureLeftProvider()
    {
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
     * @dataProvider ContainsProvider
     * @param $expected
     * @param $haystack
     * @param $needle
     * @param bool $caseSensitive
     */
    public function testContains($expected, $haystack, $needle, $caseSensitive = true)
    {
        $s = new Str($haystack);
        $this->assertEquals(
            $expected,
            $s->contains($needle, $caseSensitive),
            sprintf('%s - %s', $haystack, $needle)
        );
    }

    /**
     * @return array
     */
    public function ContainsProvider(): array
    {
        return [
            [false, '', ''],
            [false, 'ewew', ''],
            [false, '', 'ewew'],
            [true, 'Str contains foo bar 6', 'foo bar'],
            [true, '12398!@(*%!@# @!%#*&^%',  ' @!%#*&^%'],
            [true, 'Ο συγγραφέας είπε', 'συγγραφέας'],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', 'å´¥©', true],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', 'å˚ ∆', true],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', 'øœ¬', true],
            [false, 'Str contains foo bar', 'Foo bar'],
            [false, 'Str contains foo bar', 'foobar'],
            [false, 'Str contains foo bar', 'foo bar '],
            [false, 'Ο συγγραφέας είπε', '  συγγραφέας ', true],
            [false, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ' ßå˚', true],
            [true, 'Str contains foo bar', 'Foo bar', false],
            [true, '12398!@(*%!@# @!%#*&^%',  ' @!%#*&^%', false],
            [true, 'Ο συγγραφέας είπε', 'ΣΥΓΓΡΑΦΈΑΣ', false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', 'Å´¥©', false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', 'Å˚ ∆', false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', 'ØŒ¬', false],
            [false, 'Str contains foo bar', 'foobar', false],
            [false, 'Str contains foo bar', 'foo bar ', false],
            [false, 'Ο συγγραφέας είπε', '  συγγραφέας ', false],
            [false, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ' ßÅ˚', false]
        ];
    }

    /**
     * @dataProvider ReplaceWithLimitProvider
     * @param $params
     * @param $expected
     */
    public function testReplaceWithLimit($params, $expected)
    {
        $s = new Str($params[0]);
        $old = $params[1];
        $new = $params[2];
        $limit = $params[3];
        $this->assertEquals($expected, $s->replaceWithLimit($old, $new, $limit));
    }
    public function ReplaceWithLimitProvider()
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
     * @dataProvider ReplaceProvider
     *
     * @param $expected
     * @param $str
     * @param $search
     * @param $replacement
     */
    public function testReplace($expected, $str, $search, $replacement)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->replace($search, $replacement));
    }
    public function ReplaceProvider()
    {
        return
            [
                ['', '', '', ''],
                ['foo', '', '', 'foo'],
                ['foo', '\s', '\s', 'foo'],
                ['foo bar', 'foo bar', '', ''],
                ['foo bar', 'foo bar', 'f(o)o', '\1'],
                ['\1 bar', 'foo bar', 'foo', '\1'],
                ['bar', 'foo bar', 'foo ', ''],
                ['far bar', 'foo bar', 'foo', 'far'],
                ['bar bar', 'foo bar foo bar', 'foo ', ''],
                ['', '', '', ''],
                ['fòô', '', '', 'fòô'],
                ['fòô', '\s', '\s', 'fòô'],
                ['fòô bàř', 'fòô bàř', '', ''],
                ['bàř', 'fòô bàř', 'fòô ', ''],
                ['far bàř', 'fòô bàř', 'fòô', 'far'],
                ['bàř bàř', 'fòô bàř fòô bàř', 'fòô ', ''],
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
     * @param $chars
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
     * @dataProvider AtProvider
     * @param $expected
     * @param $str
     * @param $pos
     */
    public function testAt($expected, $str, $pos)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->at($pos));
    }

    public function AtProvider()
    {
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
        $s = new Str($str);
        $this->assertInternalType('array', $expected);
        $this->assertEquals($expected, $s->chars());
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
     * @dataProvider lengthProvider()
     * @param $expected
     * @param $str
     */
    public function testLength($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->length());
    }
    public function lengthProvider()
    {
        return [
            [11, '  foo bar  '],
            [1, 'f'],
            [0, ''],
            [7, 'fòô bàř']
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
     * @dataProvider indexOfProvider()
     * @param $expected
     * @param $haystack
     * @param $needle
     * @param int $offset
     */
    public function testIndexOf($expected, $haystack, $needle, $offset = 0)
    {
        $s = new Str($haystack);
        $this->assertEquals($expected, $s->indexOf($needle, $offset));
    }

    public function indexOfProvider()
    {
        return [
            [6, 'foo & bar', 'bar'],
            [6, 'foo & bar', 'bar', 0],
            [-1, 'foo & bar', 'baz'],
            [-1, 'foo & bar', 'baz', 0],
            [0, 'foo & bar & foo', 'foo', 0],
            [12, 'foo & bar & foo', 'foo', 5],
            [12, 'foo & bar & foo', 'foo', -5],
            [6, 'fòô & bàř', 'bàř', 0],
            [-1, 'fòô & bàř', 'baz', 0],
            [0, 'fòô & bàř & fòô', 'fòô', 0],
            [12, 'fòô & bàř & fòô', 'fòô', 5],
            [12, 'fòô & bàř & fòô', 'fòô', -5],
        ];
    }

    /**
     * @dataProvider indexOfLastProvider()
     * @param $expected
     * @param $haystack
     * @param $needle
     * @param int $offset
     */
    public function testIndexOfLast($expected, $haystack, $needle, $offset = 0)
    {
        $s = new Str($haystack);
        $this->assertEquals($expected, $s->indexOfLast($needle, $offset));
    }

    public function indexOfLastProvider()
    {
        return [
            [6, 'foo & bar', 'bar'],
            [6, 'foo & bar', 'bar', 0],
            [-1, 'foo & bar', 'baz'],
            [-1, 'foo & bar', 'baz', 0],
            [12, 'foo & bar & foo', 'foo', 0],
            [12, 'foo & bar & foo', 'foo', -5],
            [6, 'fòô & bàř', 'bàř', 0],
            [-1, 'fòô & bàř', 'baz', 0],
            [12, 'fòô & bàř & fòô', 'fòô', 0],
            [12, 'fòô & bàř & fòô', 'fòô', -5],
            [-1, 'q', 'q', -5],
            [-1, '', '', 0],
            [-1, 'q', '', 0],
            [-1, '', 'q', 0],
            [-1, 'q', 'q', 5],
        ];
    }

    /**
     * @dataProvider countSubstrProvider()
     * @param $expected
     * @param $str
     * @param $substring
     * @param bool $caseSensitive
     */
    public function testCountSubstr($expected, $str, $substring, $caseSensitive = true)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->countSubstr($substring, $caseSensitive));
    }

    public function countSubstrProvider()
    {
        return [
            [0, '', 'foo'],
            [0, 'foo', 'bar'],
            [1, 'foo bar', 'foo'],
            [2, 'foo bar', 'o'],
            [0, '', 'fòô'],
            [0, 'fòô', 'bàř'],
            [1, 'fòô bàř', 'fòô'],
            [2, 'fôòô bàř', 'ô'],
            [0, 'fÔÒÔ bàř', 'ô'],
            [0, 'foo', 'BAR', false],
            [1, 'foo bar', 'FOo', false],
            [2, 'foo bar', 'O', false],
            [1, 'fòô bàř', 'fÒÔ', false],
            [2, 'fôòô bàř', 'Ô', false],
            [1, 'συγγραφέας', 'Σ', false]
        ];
    }

    /**
     * @dataProvider containsAllProvider()
     * @param $expected
     * @param $haystack
     * @param $needles
     * @param bool $caseSensitive
     */
    public function testContainsAll($expected, $haystack, $needles, $caseSensitive = true)
    {
        $s = new Str($haystack);
        $this->assertEquals($expected, $s->containsAll($needles, $caseSensitive), $haystack);
    }

    public function containsAllProvider()
    {
        // One needle
        $singleNeedle = array_map(function ($array) {
            $array[2] = [$array[2]];
            return $array;
        }, $this->ContainsProvider());
        $provider = [
            // One needle
            [false, 'Str contains foo bar', []],
            // Multiple needles
            [true, 'Str contains foo bar', ['foo', 'bar']],
            [true, '12398!@(*%!@# @!%#*&^%', [' @!%#*', '&^%']],
            [true, 'Ο συγγραφέας είπε', ['συγγρ', 'αφέας']],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['å´¥', '©'], true],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['å˚ ', '∆'], true],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['øœ', '¬'], true],
            [false, 'Str contains foo bar', ['Foo', 'bar']],
            [false, 'Str contains foo bar', ['foobar', 'bar']],
            [false, 'Str contains foo bar', ['foo bar ', 'bar']],
            [false, 'Ο συγγραφέας είπε', ['  συγγραφέας ', '  συγγραφ '], true],
            [false, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', [' ßå˚', ' ß '], true],
            [true, 'Str contains foo bar', ['Foo bar', 'bar'], false],
            [true, '12398!@(*%!@# @!%#*&^%', [' @!%#*&^%', '*&^%'], false],
            [true, 'Ο συγγραφέας είπε', ['ΣΥΓΓΡΑΦΈΑΣ', 'ΑΦΈΑ'], false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['Å´¥©', '¥©'], false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['Å˚ ∆', ' ∆'], false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['ØŒ¬', 'Œ'], false],
            [false, 'Str contains foo bar', ['foobar', 'none'], false],
            [false, 'Str contains foo bar', ['foo bar ', ' ba'], false],
            [false, 'Ο συγγραφέας είπε', ['  συγγραφέας ', ' ραφέ '], false],
            [false, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', [' ßÅ˚', ' Å˚ '], false],
        ];
        return array_merge($singleNeedle, $provider);
    }

    /**
     * @dataProvider containsAnyProvider()
     * @param $expected
     * @param $haystack
     * @param $needles
     * @param bool $caseSensitive
     */
    public function testContainsAny($expected, $haystack, $needles, $caseSensitive = true)
    {
        $s = new Str($haystack);
        $this->assertEquals($expected, $s->containsAny($needles, $caseSensitive), $haystack);
    }
    public function containsAnyProvider()
    {
        // One needle
        $singleNeedle = array_map(function ($array) {
            $array[2] = [$array[2]];
            return $array;
        }, $this->ContainsProvider());
        $provider = [
            // No needles
            [false, 'Str contains foo bar', []],
            // Multiple needles
            [true, 'Str contains foo bar', ['foo', 'bar']],
            [true, '12398!@(*%!@# @!%#*&^%', [' @!%#*', '&^%']],
            [true, 'Ο συγγραφέας είπε', ['συγγρ', 'αφέας']],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['å´¥', '©'], true],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['å˚ ', '∆'], true],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['øœ', '¬'], true],
            [false, 'Str contains foo bar', ['Foo', 'Bar']],
            [false, 'Str contains foo bar', ['foobar', 'bar ']],
            [false, 'Str contains foo bar', ['foo bar ', '  foo']],
            [false, 'Ο συγγραφέας είπε', ['  συγγραφέας ', '  συγγραφ '], true],
            [false, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', [' ßå˚', ' ß '], true],
            [true, 'Str contains foo bar', ['Foo bar', 'bar'], false],
            [true, '12398!@(*%!@# @!%#*&^%', [' @!%#*&^%', '*&^%'], false],
            [true, 'Ο συγγραφέας είπε', ['ΣΥΓΓΡΑΦΈΑΣ', 'ΑΦΈΑ'], false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['Å´¥©', '¥©'], false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['Å˚ ∆', ' ∆'], false],
            [true, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', ['ØŒ¬', 'Œ'], false],
            [false, 'Str contains foo bar', ['foobar', 'none'], false],
            [false, 'Str contains foo bar', ['foo bar ', ' ba '], false],
            [false, 'Ο συγγραφέας είπε', ['  συγγραφέας ', ' ραφέ '], false],
            [false, 'å´¥©¨ˆßå˚ ∆∂˙©å∑¥øœ¬', [' ßÅ˚', ' Å˚ '], false],
        ];
        return array_merge($singleNeedle, $provider);
    }

    /**
     * @dataProvider startsWithProvider()
     * @param $expected
     * @param $str
     * @param $substring
     * @param bool $caseSensitive
     */
    public function testStartsWith($expected, $str, $substring, $caseSensitive = true)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->startsWith($substring, $caseSensitive), $str);
    }
    public function startsWithProvider()
    {
        return [
            [true, 'foo bars', 'foo bar'],
            [true, 'FOO bars', 'foo bar', false],
            [true, 'FOO bars', 'foo BAR', false],
            [true, 'FÒÔ bàřs', 'fòô bàř', false],
            [true, 'fòô bàřs', 'fòô BÀŘ', false],
            [false, 'foo bar', 'bar'],
            [false, 'foo bar', 'foo bars'],
            [false, 'FOO bar', 'foo bars'],
            [false, 'FOO bars', 'foo BAR'],
            [false, 'FÒÔ bàřs', 'fòô bàř', true],
            [false, 'fòô bàřs', 'fòô BÀŘ', true],
        ];
    }

    /**
     * @dataProvider startsWithProviderAny()
     * @param $expected
     * @param $str
     * @param $substrings
     * @param bool $caseSensitive
     */
    public function testStartsWithAny($expected, $str, $substrings, $caseSensitive = true)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->startsWithAny($substrings, $caseSensitive), $str);
    }
    public function startsWithProviderAny()
    {
        return [
            [true, 'foo bars', ['foo bar']],
            [true, 'FOO bars', ['foo bar'], false],
            [true, 'FOO bars', ['foo bar', 'foo BAR'], false],
            [true, 'FÒÔ bàřs', ['foo bar', 'fòô bàř'], false],
            [true, 'fòô bàřs', ['foo bar', 'fòô BÀŘ'], false],
            [false, 'foo bar', ['bar']],
            [false, 'foo bar', ['foo bars']],
            [false, 'FOO bar', ['foo bars']],
            [false, 'FOO bars', ['foo BAR']],
            [false, 'FÒÔ bàřs', ['fòô bàř'], true],
            [false, 'fòô bàřs', ['fòô BÀŘ'], true],
            [false, 'anything', []]
        ];
    }

    /**
     * @dataProvider endsWithProvider()
     * @param $expected
     * @param $str
     * @param $substring
     * @param bool $caseSensitive
     */
    public function testEndsWith($expected, $str, $substring, $caseSensitive = true)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->endsWith($substring, $caseSensitive), $str);
    }
    public function endsWithProvider()
    {
        return [
            [true, 'foo bars', 'o bars'],
            [true, 'FOO bars', 'o bars', false],
            [true, 'FOO bars', 'o BARs', false],
            [true, 'FÒÔ bàřs', 'ô bàřs', false],
            [true, 'fòô bàřs', 'ô BÀŘs', false],
            [false, 'foo bar', 'foo'],
            [false, 'foo bar', 'foo bars'],
            [false, 'FOO bar', 'foo bars'],
            [false, 'FOO bars', 'foo BARS'],
            [false, 'FÒÔ bàřs', 'fòô bàřs', true],
            [false, 'fòô bàřs', 'fòô BÀŘS', true],
        ];
    }

    /**
     * @dataProvider endsWithAnyProvider()
     * @param $expected
     * @param $str
     * @param $substrings
     * @param bool $caseSensitive
     */
    public function testEndsWithAny($expected, $str, $substrings, $caseSensitive = true)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->endsWithAny($substrings, $caseSensitive), $str);
    }
    public function endsWithAnyProvider()
    {
        return [
            [true, 'foo bars', ['foo', 'o bars']],
            [true, 'FOO bars', ['foo', 'o bars'], false],
            [true, 'FOO bars', ['foo', 'o BARs'], false],
            [true, 'FÒÔ bàřs', ['foo', 'ô bàřs'], false],
            [true, 'fòô bàřs', ['foo', 'ô BÀŘs'], false],
            [false, 'foo bar', ['foo']],
            [false, 'foo bar', ['foo', 'foo bars']],
            [false, 'FOO bar', ['foo', 'foo bars']],
            [false, 'FOO bars', ['foo', 'foo BARS']],
            [false, 'FÒÔ bàřs', ['fòô', 'fòô bàřs'], true],
            [false, 'fòô bàřs', ['fòô', 'fòô BÀŘS'], true],
            [false, 'anything', []]
        ];
    }

    /**
     * @dataProvider padLeftProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param $padStr
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
     * @param $padStr
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
     * @param $padStr
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
            ['f baroo', 'f bar', 'oo', 20],
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
            ['oo bar', 'foo bar', (string)$s->at(0)],
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
            ['foo ba', 'foo bar', (string)$s->last()],
            ['fòô bàř', 'fòô bàř', ''],
            ['fòô bà', 'fòô bàř', 'ř'],
            ['fòô', 'fòô bàř', ' bàř'],
            ['fòô bàř', 'fòô bàř', 'bà'],
            ['fòô bàř', 'fòô bàř', 'fòô bà']
        ];
    }

    /**
     * @dataProvider repeatProvider()
     * @param $expected
     * @param $str
     * @param $multiplier
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
        $oldValues = $s->chars();


        $result = $s->shuffle();
        $newValues = $s->chars();

        $countOld = array_count_values($oldValues);
        $countNew = array_count_values($newValues);

        // We'll make sure that the chars are present after shuffle
        $this->assertEquals($countOld, $countNew);
        $this->assertEmpty(array_diff($countOld, $countNew));
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
        $this->assertEquals($expected, $s->between($start, $end, $offset), $str);
    }
    public function betweenProvider()
    {
        return [
            ['Acme', '/Acme/', '/', '/'],
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
            ['bàř', '{fòô} and {bàř}', '{', '}', 1],
            ['\w\N ^$%#', '\b\w\N ^$%#{fòô} . and {bàř}', 'b', '{', 1],
        ];
    }

    /**
     * @dataProvider camelizeProvider()
     * @param $expected
     * @param $str
     */
    public function testCamelize($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->camelize(), $str);
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
        $this->assertEquals($expected, $s->upperCaseFirst(), $str);
    }
    public function upperCaseFirstProvider()
    {
        return [
            ['Test', 'Test'],
            ['', ''],
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
        $this->assertEquals($expected, $s->lowerCaseFirst(), $str);
    }
    public function lowerCaseFirstProvider()
    {
        return [
            ['test', 'Test'],
            ['', ''],
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
        $this->assertEquals($expected, $s->collapseWhitespace(), $str);
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
        $this->assertEquals($expected, $s->regexReplace($pattern, $replacement, $options), $str);
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
        $this->assertEquals($expected, $s->dasherize(), $str);
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
        $this->assertEquals($expected, $s->delimit($delimiter), $str);
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

    /**
     * real uuid4 generator test
     */
    public function testIsUUIDv4_Real()
    {
        for ($i=0;$i<=255;$i++) {
            $uuid = (string)\Ramsey\Uuid\Uuid::uuid4();
            $s = new Str($uuid);
            $this->assertTrue($s->isUUIDv4(), $uuid);
        }
    }
    /**
     * @dataProvider isUUIDv4Provider()
     * @param $expected
     * @param $str
     */
    public function testIsUUIDv4($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isUUIDv4(), $str);
    }
    public function isUUIDv4Provider()
    {
        return [
            [true, 'ae815123-537f-4eb3-a9b8-35881c29e1ac'],
            [true, '4724393e-b496-4d94-bdae-96004abbc5e4'],
            [true, '9c360134-770d-4284-abab-6e1257dee973'],
            [false, '76d7cac8-1bd7-11e8-accf-0ed5f89f718b'],
            [false, 'f89cdf3a-1bd7-11e8-accf-0ed5f89f718b'],
            [false, 'b3467be4-1bd7-11e8-accf-0ed5f89f718b'],
        ];
    }

    /**
     * @dataProvider hasLowerCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testHasLowerCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->hasLowerCase(), $str);
    }
    public function hasLowerCaseProvider()
    {
        return [
            [false, ''],
            [true, 'foobar'],
            [false, 'FOO BAR'],
            [true, 'fOO BAR'],
            [true, 'foO BAR'],
            [true, 'FOO BAr'],
            [true, 'Foobar'],
            [false, 'FÒÔBÀŘ'],
            [true, 'fòôbàř'],
            [true, 'fòôbàř2'],
            [true, 'Fòô bàř'],
            [true, 'fòôbÀŘ'],
        ];
    }

    /**
     * @dataProvider hasUpperCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testHasUpperCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->hasUpperCase(), $str);
    }
    public function hasUpperCaseProvider()
    {
        return [
            [false, ''],
            [true, 'FOOBAR'],
            [false, 'foo bar'],
            [true, 'Foo bar'],
            [true, 'FOo bar'],
            [true, 'foo baR'],
            [true, 'fOOBAR'],
            [false, 'fòôbàř'],
            [true, 'FÒÔBÀŘ'],
            [true, 'FÒÔBÀŘ2'],
            [true, 'fÒÔ BÀŘ'],
            [true, 'FÒÔBàř'],
        ];
    }

    /**
     * @dataProvider matchesPatternProvider()
     * @param $expected
     * @param $str
     * @param $pattern
     */
    public function testMatchesPattern($expected, $str, $pattern)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->matchesPattern($pattern), $str);
    }
    public function matchesPatternProvider()
    {
        return [
            [true, 'FOOBAR', '.*FOO'],
            [false, 'foo bar', '.*  bar'],
            [true, 'Foo bar', '.* ba'],
            [true, 'FOo bar', '.*Oo'],
            [true, 'foo baR', '.*aR'],
            [true, 'fOOBAR', '.*OBA'],
            [false, 'fòôbàř', '.*foo'],
        ];
    }

    /**
     * @dataProvider htmlEncodeProvider()
     * @param $expected
     * @param $str
     * @param int $flags
     */
    public function testHtmlEncode($expected, $str, $flags = ENT_COMPAT)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->htmlEncode($flags), $str);
    }
    public function htmlEncodeProvider()
    {
        return [
            ['&amp;', '&'],
            ['&quot;', '"'],
            ['&#039;', "'", ENT_QUOTES],
            ['&lt;', '<'],
            ['&gt;', '>'],
        ];
    }

    /**
     * @dataProvider htmlDecodeProvider()
     * @param $expected
     * @param $str
     * @param int $flags
     */
    public function testHtmlDecode($expected, $str, $flags = ENT_COMPAT)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->htmlDecode($flags), $str);
    }
    public function htmlDecodeProvider()
    {
        return [
            ['&', '&amp;'],
            ['"', '&quot;'],
            ["'", '&#039;', ENT_QUOTES],
            ['<', '&lt;'],
            ['>', '&gt;'],
        ];
    }

    /**
     * @dataProvider humanizeProvider()
     * @param $expected
     * @param $str
     */
    public function testHumanize($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->humanize(), $str);
    }
    public function humanizeProvider()
    {
        return [
            ['Author', 'author_id'],
            ['Test user', ' _test_user_'],
            ['Συγγραφέας', ' συγγραφέας_id ']
        ];
    }

    /**
     * @dataProvider isAlphaProvider()
     * @param $expected
     * @param $str
     */
    public function testIsAlpha($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isAlpha(), $str);
    }
    public function isAlphaProvider()
    {
        return [
            [true, ''],
            [true, 'foobar'],
            [false, 'foo bar'],
            [false, 'foobar2'],
            [true, 'fòôbàř'],
            [false, 'fòô bàř'],
            [false, 'fòôbàř2'],
            [true, 'ҠѨњфгШ'],
            [false, 'ҠѨњ¨ˆфгШ'],
            [true, '丹尼爾']
        ];
    }

    /**
     * @dataProvider isAlphanumericProvider()
     * @param $expected
     * @param $str
     */
    public function testIsAlphanumeric($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isAlphanumeric(), $str);
    }
    public function isAlphanumericProvider()
    {
        return [
            [true, ''],
            [true, 'foobar1'],
            [false, 'foo bar'],
            [false, 'foobar2"'],
            [false, "\nfoobar\n"],
            [true, 'fòôbàř1'],
            [false, 'fòô bàř'],
            [false, 'fòôbàř2"'],
            [true, 'ҠѨњфгШ'],
            [false, 'ҠѨњ¨ˆфгШ'],
            [true, '丹尼爾111'],
            [true, 'دانيال1'],
            [false, 'دانيال1 ']
        ];
    }

    /**
     * @dataProvider isBase64Provider()
     * @param $expected
     * @param $str
     */
    public function testIsBase64($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isBase64(), $str);
    }
    public function isBase64Provider()
    {
        return [
            [false, ' '],
            [true, ''],
            [true, base64_encode('FooBar') ],
            [true, base64_encode(' ') ],
            [true, base64_encode('FÒÔBÀŘ') ],
            [true, base64_encode('συγγραφέας') ],
            [false, 'Foobar'],
        ];
    }

    /**
     * @dataProvider isBlankProvider()
     * @param $expected
     * @param $str
     */
    public function testIsBlank($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isBlank(), $str);
    }
    public function isBlankProvider()
    {
        return [
            [true, ''],
            [true, ' '],
            [true, "\n\t "],
            [true, "\n\t  \v\f"],
            [false, "\n\t a \v\f"],
            [false, "\n\t ' \v\f"],
            [false, "\n\t 2 \v\f"],
            [true, ''],
            [true, ' '], // no-break space (U+00A0)
            [true, '           '], // spaces U+2000 to U+200A
            [true, ' '], // narrow no-break space (U+202F)
            [true, ' '], // medium mathematical space (U+205F)
            [true, '　'], // ideographic space (U+3000)
            [false, '　z'],
            [false, '　1'],
        ];
    }

    /**
     * @dataProvider isHexadecimalProvider()
     * @param $expected
     * @param $str
     */
    public function testIsHexadecimal($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isHexadecimal(), $str);
    }
    public function isHexadecimalProvider()
    {
        return [
            [true, ''],
            [true, 'abcdef'],
            [true, 'ABCDEF'],
            [true, '0123456789'],
            [true, '0123456789AbCdEf'],
            [false, '0123456789x'],
            [false, 'ABCDEFx'],
            [true, 'abcdef'],
            [true, 'ABCDEF'],
            [true, '0123456789'],
            [true, '0123456789AbCdEf'],
            [false, '0123456789x'],
            [false, 'ABCDEFx'],
        ];
    }

    /**
     * @dataProvider isJsonProvider()
     * @param $str
     * @param $expected
     */
    public function testIsJson($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isJson(), $str);
    }
    public function isJsonProvider()
    {
        return [
            [false, ''],
            [false, '  '],
            [true, 'null'],
            [true, 'true'],
            [true, 'false'],
            [true, '[]'],
            [true, '{}'],
            [true, '123'],
            [true, '{"foo": "bar"}'],
            [false, '{"foo":"bar",}'],
            [false, '{"foo"}'],
            [true, '["foo"]'],
            [false, '{"foo": "bar"]'],
            [true, '123'],
            [true, '{"fòô": "bàř"}'],
            [false, '{"fòô":"bàř",}'],
            [false, '{"fòô"}'],
            [false, '["fòô": "bàř"]'],
            [true, '["fòô"]'],
            [false, '{"fòô": "bàř"]'],
        ];
    }

    /**
     * @dataProvider isLowerCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testIsLowerCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isLowerCase(), $str);
    }
    public function isLowerCaseProvider()
    {
        return [
            [true, ''],
            [true, 'foobar'],
            [false, 'foo bar'],
            [false, 'Foobar'],
            [true, 'fòôbàř'],
            [false, 'fòôbàř2'],
            [false, 'fòô bàř'],
            [false, 'fòôbÀŘ'],
        ];
    }

    /**
     * @dataProvider isSerializedProvider()
     * @param $expected
     * @param $str
     */
    public function testIsSerialized($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isSerialized(), $str);
    }
    public function isSerializedProvider()
    {
        return [
            [false, ''],
            [false, 'Acme'],
            [true, 'a:1:{s:3:"foo";s:3:"bar";}'],
            [false, 'a:1:{s:3:"foo";s:3:"bar"}'],
            [true, serialize(['foo' => 'bar'])],
            [true, 'a:1:{s:5:"fòô";s:5:"bàř";}'],
            [false, 'a:1:{s:5:"fòô";s:5:"bàř"}'],
            [true, serialize(['fòô' => 'bár'])],
        ];
    }

    /**
     * @dataProvider isUpperCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testIsUpperCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isUpperCase(), $str);
    }
    public function isUpperCaseProvider()
    {
        return [
            [true, ''],
            [true, 'FOOBAR'],
            [false, 'FOO BAR'],
            [false, 'fOOBAR'],
            [true, 'FÒÔBÀŘ'],
            [false, 'FÒÔBÀŘ2'],
            [false, 'FÒÔ BÀŘ'],
            [false, 'FÒÔBàř'],
        ];
    }

    /**
     * @dataProvider linesProvider()
     * @param $expected
     * @param $str
     */
    public function testLines($expected, $str)
    {
        $s = new Str($str);
        $result = $s->lines();
        $expectedCount = count($expected);

        if ($expectedCount === 0) { $this->assertEmpty($result); }

        for ($i = 0; $i < $expectedCount; $i++) {
            $this->assertEquals($expected[$i], $result[$i]);
        }
    }
    public function linesProvider()
    {
        return [
            [[], ''],
            [[''], "\r\n"],
            [['foo', 'bar'], "foo\nbar"],
            [['foo', 'bar'], "foo\rbar"],
            [['foo', 'bar'], "foo\r\nbar"],
            [['foo', '', 'bar'], "foo\r\n\r\nbar"],
            [['foo', 'bar', ''], "foo\r\nbar\r\n"],
            [['', 'foo', 'bar'], "\r\nfoo\r\nbar"],
            [['fòô', 'bàř'], "fòô\nbàř"],
            [['fòô', 'bàř'], "fòô\rbàř"],
            [['fòô', 'bàř'], "fòô\n\rbàř"],
            [['fòô', 'bàř'], "fòô\r\nbàř"],
            [['fòô', '', 'bàř'], "fòô\r\n\r\nbàř"],
            [['fòô', 'bàř', ''], "fòô\r\nbàř\r\n"],
            [['', 'fòô', 'bàř'], "\r\nfòô\r\nbàř"],
        ];
    }

    /**
     * @dataProvider splitProvider()
     * @param $expected
     * @param $str
     * @param $pattern
     * @param int $limit
     */
    public function testSplit($expected, $str, $pattern, $limit = -1)
    {
        $s = new Str($str);
        $result = $s->split($pattern, $limit);
        $expectedLen = \count($expected);

        if ($expectedLen === 0) { $this->assertEmpty($result); }

        for ($i = 0; $i < $expectedLen; $i++) {
            $this->assertEquals($expected[$i], $result[$i]);
        }
    }
    public function splitProvider()
    {
        return [
            [['foo,bar,baz'], 'foo,bar,baz', ''],
            [['foo,bar,baz'], 'foo,bar,baz', '-'],
            [['foo', 'bar', 'baz'], 'foo,bar,baz', ','],
            [['foo', 'bar', 'baz'], 'foo,bar,baz', ',', -1],
            [['foo', 'bar', 'baz'], 'foo,bar,baz', ',', -1],
            [[], 'foo,bar,baz', ',', 0],
            [['foo'], 'foo,bar,baz', ',', 1],
            [['foo', 'bar'], 'foo,bar,baz', ',', 2],
            [['foo', 'bar', 'baz'], 'foo,bar,baz', ',', 3],
            [['foo', 'bar', 'baz'], 'foo,bar,baz', ',', 10],
            [['fòô,bàř,baz'], 'fòô,bàř,baz', '-', -1],
            [['fòô', 'bàř', 'baz'], 'fòô,bàř,baz', ',', -1],
            [['fòô', 'bàř', 'baz'], 'fòô,bàř,baz', ',', -1],
            [['fòô', 'bàř', 'baz'], 'fòô,bàř,baz', ',', -1],
            [[], 'fòô,bàř,baz', ',', 0],
            [['fòô'], 'fòô,bàř,baz', ',', 1],
            [['fòô', 'bàř'], 'fòô,bàř,baz', ',', 2],
            [['fòô', 'bàř', 'baz'], 'fòô,bàř,baz', ',', 3],
            [['fòô', 'bàř', 'baz'], 'fòô,bàř,baz', ',', 10]
        ];
    }

    /**
     * @dataProvider longestCommonPrefixProvider()
     * @param $expected
     * @param $str
     * @param $otherStr
     */
    public function testLongestCommonPrefix($expected, $str, $otherStr)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->longestCommonPrefix($otherStr), $str);
    }
    public function longestCommonPrefixProvider()
    {
        return [
            ['foo', 'foobar', 'foo bar'],
            ['foo bar', 'foo bar', 'foo bar'],
            ['f', 'foo bar', 'far boo'],
            ['', 'toy car', 'foo bar'],
            ['', 'foo bar', ''],
            ['fòô', 'fòôbar', 'fòô bar'],
            ['fòô bar', 'fòô bar', 'fòô bar'],
            ['fò', 'fòô bar', 'fòr bar'],
            ['', 'toy car', 'fòô bar'],
            ['', 'fòô bar', ''],
        ];
    }

    /**
     * @dataProvider longestCommonSuffixProvider()
     * @param $expected
     * @param $str
     * @param $otherStr
     */
    public function testLongestCommonSuffix($expected, $str, $otherStr)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->longestCommonSuffix($otherStr), $str);
    }
    public function longestCommonSuffixProvider()
    {
        return [
            ['bar', 'foobar', 'foo bar'],
            ['foo bar', 'foo bar', 'foo bar'],
            ['ar', 'foo bar', 'boo far'],
            ['', 'foo bad', 'foo bar'],
            ['', 'foo bar', ''],
            ['bàř', 'fòôbàř', 'fòô bàř'],
            ['fòô bàř', 'fòô bàř', 'fòô bàř'],
            [' bàř', 'fòô bàř', 'fòr bàř'],
            ['', 'toy car', 'fòô bàř'],
            ['', 'fòô bàř', ''],
        ];
    }

    /**
     * @dataProvider longestCommonSubstringProvider()
     * @param $expected
     * @param $str
     * @param $otherStr
     */
    public function testLongestCommonSubstring($expected, $str, $otherStr)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->longestCommonSubstring($otherStr), $str);
    }
    public function longestCommonSubstringProvider()
    {
        return [
            ['foo', 'foobar', 'foo bar'],
            ['foo bar', 'foo bar', 'foo bar'],
            ['oo ', 'foo bar', 'boo far'],
            ['foo ba', 'foo bad', 'foo bar'],
            ['', 'foo bar', ''],
            ['fòô', 'fòôbàř', 'fòô bàř'],
            ['fòô bàř', 'fòô bàř', 'fòô bàř'],
            [' bàř', 'fòô bàř', 'fòr bàř'],
            [' ', 'toy car', 'fòô bàř'],
            ['', 'fòô bàř', ''],
            ['', '', 'fòô bàř'],
        ];
    }
}
