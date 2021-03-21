<?php

declare(strict_types=1);

namespace Str;

use PHPUnit\Framework\TestCase;

class StrFullTest extends TestCase
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
                    ['世界', 'Hello, '],
                    'Hello, 世界',
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
        $this->assertIsArray($expected);
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
            [false, 'ПриветМир.xlsx', 'xlsx2', false],
            [true, 'ПриветМир.xlsx', 'xlsx', false],
            [false, 'ПриветМир.xls', 'xlsx', false],
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
            ['Authorid', 'authorid'],
            ['Author id', 'author_id'],
            ['Test user', ' _test_user_'],
            ['Συγγραφέας id', ' συγγραφέας_id ']
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

        if ($expectedCount === 0) {
            $this->assertEmpty($result);
        }

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
        $this->assertEquals($expected, $result, (string)print_r($expected, true) . (string)print_r($result, true));
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

    /**
     * @dataProvider safeTruncateProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param string $substring
     */
    public function testSafeTruncate($expected, $str, $length, $substring = '')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->safeTruncate($length, $substring), $str);
    }
    public function safeTruncateProvider()
    {
        return [
            ['Test foo bar', 'Test foo bar', 12],
            ['Test foo', 'Test foo bar', 11],
            ['Test foo', 'Test foo bar', 8],
            ['Test', 'Test foo bar', 7],
            ['Test', 'Test foo bar', 4],
            ['Test foo bar', 'Test foo bar', 12, '...'],
            ['Test foo...', 'Test foo bar', 11, '...'],
            ['Test...', 'Test foo bar', 8, '...'],
            ['Test...', 'Test foo bar', 7, '...'],
            ['T...', 'Test foo bar', 4, '...'],
            ['Test....', 'Test foo bar', 11, '....'],
            ['Tëst fòô bàř', 'Tëst fòô bàř', 12, ''],
            ['Tëst fòô', 'Tëst fòô bàř', 11, ''],
            ['Tëst fòô', 'Tëst fòô bàř', 8, ''],
            ['Tëst', 'Tëst fòô bàř', 7, ''],
            ['Tëst', 'Tëst fòô bàř', 4, ''],
            ['Tëst fòô bàř', 'Tëst fòô bàř', 12, 'ϰϰ'],
            ['Tëst fòôϰϰ', 'Tëst fòô bàř', 11, 'ϰϰ'],
            ['Tëstϰϰ', 'Tëst fòô bàř', 8, 'ϰϰ'],
            ['Tëstϰϰ', 'Tëst fòô bàř', 7, 'ϰϰ'],
            ['Tëϰϰ', 'Tëst fòô bàř', 4, 'ϰϰ'],
            ['What are your plans...', 'What are your plans today?', 22, '...']
        ];
    }

    /**
     * @dataProvider slugifyProvider()
     * @param $expected
     * @param $str
     * @param string $replacement
     */
    public function testSlugify($expected, $str, $replacement = '-')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->slugify($replacement), $str);
    }
    public function slugifyProvider()
    {
        return [
            ['foo-bar', ' foo  bar '],
            ['foo-bar', 'foo -.-"-...bar'],
            ['another-foo-bar', 'another..& foo -.-"-...bar'],
            ['foo-dbar', " Foo d'Bar "],
            ['a-string-with-dashes', 'A string-with-dashes'],
            ['user-host', 'user@host'],
            ['using-strings-like-foo-bar', 'Using strings like fòô bàř'],
            ['numbers-1234', 'numbers 1234'],
            ['perevirka-ryadka', 'перевірка рядка'],
            ['bukvar-s-bukvoy-y', 'букварь с буквой ы'],
            ['podekhal-k-podezdu-moego-doma', 'подъехал к подъезду моего дома'],
            ['foo:bar:baz', 'Foo bar baz', ':'],
            ['a_string_with_underscores', 'A_string with_underscores', '_'],
            ['a_string_with_dashes', 'A string-with-dashes', '_'],
            ['a\string\with\dashes', 'A string-with-dashes', '\\'],
            ['an_odd_string', '--   An odd__   string-_', '_']
        ];
    }

    /**
     * @dataProvider toAsciiProvider()
     * @param $expected
     * @param $str
     * @param string $language
     * @param bool $removeUnsupported
     */
    public function testToAscii($expected, $str, $language = 'en', $removeUnsupported = true)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toAscii($language, $removeUnsupported), $str);
    }
    public function toAsciiProvider()
    {
        return [
            ['foo bar', 'fòô bàř'],
            [' TEST ', ' ŤÉŚŢ '],
            ['f = z = 3', 'φ = ź = 3'],
            ['perevirka', 'перевірка'],
            ['lysaya gora', 'лысая гора'],
            ['user@host', 'user@host'],
            ['shchuka', 'щука'],
            ['', '漢字'],
            ['xin chao the gioi', 'xin chào thế giới'],
            ['XIN CHAO THE GIOI', 'XIN CHÀO THẾ GIỚI'],
            ['dam phat chet luon', 'đấm phát chết luôn'],
            [' ', ' '], // no-break space (U+00A0)
            ['           ', '           '], // spaces U+2000 to U+200A
            [' ', ' '], // narrow no-break space (U+202F)
            [' ', ' '], // medium mathematical space (U+205F)
            [' ', '　'], // ideographic space (U+3000)
            ['', '𐍉'], // some uncommon, unsupported character (U+10349)
            ['𐍉', '𐍉', 'en', false],
            ['aouAOU', 'äöüÄÖÜ'],
            ['aeoeueAEOEUE', 'äöüÄÖÜ', 'de'],
            ['aeoeueAEOEUE', 'äöüÄÖÜ', 'de_DE']
        ];
    }

    /**
     * @dataProvider sliceProvider()
     * @param $expected
     * @param $str
     * @param $start
     * @param null $end
     */
    public function testSlice($expected, $str, $start, $end = null)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->slice($start, $end), $str);
    }
    public function sliceProvider()
    {
        return [
            ['foobar', 'foobar', 0],
            ['foobar', 'foobar', 0, null],
            ['foobar', 'foobar', 0, 6],
            ['fooba', 'foobar', 0, 5],
            ['', 'foobar', 3, 0],
            ['', 'foobar', 3, 2],
            ['ba', 'foobar', 3, 5],
            ['ba', 'foobar', 3, -1],
            ['fòôbàř', 'fòôbàř', 0, null],
            ['fòôbàř', 'fòôbàř', 0, null],
            ['fòôbàř', 'fòôbàř', 0, 6],
            ['fòôbà', 'fòôbàř', 0, 5],
            ['', 'fòôbàř', 3, 0],
            ['', 'fòôbàř', 3, 2],
            ['bà', 'fòôbàř', 3, 5],
            ['bà', 'fòôbàř', 3, -1]
        ];
    }

    /**
     * @dataProvider stripWhitespaceProvider()
     * @param $expected
     * @param $str
     */
    public function testStripWhitespace($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->stripWhitespace(), $str);
    }
    public function stripWhitespaceProvider()
    {
        return [
            ['foobar', '  foo   bar  '],
            ['teststring', 'test string'],
            ['Οσυγγραφέας', '   Ο     συγγραφέας  '],
            ['123', ' 123 '],
            ['', ' '], // no-break space (U+00A0)
            ['', '           '], // spaces U+2000 to U+200A
            ['', ' '], // narrow no-break space (U+202F)
            ['', ' '], // medium mathematical space (U+205F)
            ['', '　'], // ideographic space (U+3000)
            ['123', '  1  2  3　　'],
            ['', ' '],
            ['', ''],
        ];
    }

    /**
     * @dataProvider truncateProvider()
     * @param $expected
     * @param $str
     * @param $length
     * @param string $substring
     */
    public function testTruncate($expected, $str, $length, $substring = '')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->truncate($length, $substring), $str);
    }
    public function truncateProvider()
    {
        return [
            ['Test foo bar', 'Test foo bar', 12],
            ['Test foo ba', 'Test foo bar', 11],
            ['Test foo', 'Test foo bar', 8],
            ['Test fo', 'Test foo bar', 7],
            ['Test', 'Test foo bar', 4],
            ['Test foo bar', 'Test foo bar', 12, '...'],
            ['Test foo...', 'Test foo bar', 11, '...'],
            ['Test ...', 'Test foo bar', 8, '...'],
            ['Test...', 'Test foo bar', 7, '...'],
            ['T...', 'Test foo bar', 4, '...'],
            ['Test fo....', 'Test foo bar', 11, '....'],
            ['Test fòô bàř', 'Test fòô bàř', 12, ''],
            ['Test fòô bà', 'Test fòô bàř', 11, ''],
            ['Test fòô', 'Test fòô bàř', 8, ''],
            ['Test fò', 'Test fòô bàř', 7, ''],
            ['Test', 'Test fòô bàř', 4, ''],
            ['Test fòô bàř', 'Test fòô bàř', 12, 'ϰϰ'],
            ['Test fòô ϰϰ', 'Test fòô bàř', 11, 'ϰϰ'],
            ['Test fϰϰ', 'Test fòô bàř', 8, 'ϰϰ'],
            ['Test ϰϰ', 'Test fòô bàř', 7, 'ϰϰ'],
            ['Teϰϰ', 'Test fòô bàř', 4, 'ϰϰ'],
            ['What are your pl...', 'What are your plans today?', 19, '...']
        ];
    }

    /**
     * @dataProvider upperCamelizeProvider()
     * @param $expected
     * @param $str
     */
    public function testUpperCamelize($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->upperCamelize(), $str);
    }
    public function upperCamelizeProvider()
    {
        return [
            ['CamelCase', 'camelCase'],
            ['CamelCase', 'Camel-Case'],
            ['CamelCase', 'camel case'],
            ['CamelCase', 'camel -case'],
            ['CamelCase', 'camel - case'],
            ['CamelCase', 'camel_case'],
            ['CamelCTest', 'camel c test'],
            ['StringWith1Number', 'string_with1number'],
            ['StringWith22Numbers', 'string-with-2-2 numbers'],
            ['1Camel2Case', '1camel2case'],
            ['CamelΣase', 'camel σase'],
            ['ΣτανιλCase', 'στανιλ case'],
            ['ΣamelCase', 'Σamel  Case']
        ];
    }

    /**
     * @dataProvider surroundProvider()
     * @param $expected
     * @param $str
     * @param $substring
     */
    public function testSurround($expected, $str, $substring)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->surround($substring), $str);
    }
    public function surroundProvider()
    {
        return [
            ['__foobar__', 'foobar', '__'],
            ['test', 'test', ''],
            ['**', '', '*'],
            ['¬fòô bàř¬', 'fòô bàř', '¬'],
            ['ßå∆˚ test ßå∆˚', ' test ', 'ßå∆˚']
        ];
    }

    /**
     * @dataProvider swapCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testSwapCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->swapCase(), $str);
    }
    public function swapCaseProvider()
    {
        return [
            ['TESTcASE', 'testCase'],
            ['tEST-cASE', 'Test-Case'],
            [' - σASH  cASE', ' - Σash  Case'],
            ['νΤΑΝΙΛ', 'Ντανιλ']
        ];
    }

    /**
     * @dataProvider tidyProvider()
     * @param $expected
     * @param $str
     */
    public function testTidy($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->tidy(), $str);
    }
    public function tidyProvider()
    {
        /** @noinspection UnNecessaryDoubleQuotesInspection */
        return [
            ['"I see..."', '“I see…”'],
            ["'This too'", "‘This too’"],
            ['test-dash', 'test—dash'],
            ['Ο συγγραφέας είπε...', 'Ο συγγραφέας είπε…']
        ];
    }

    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */
    /**
     * @dataProvider titleizeProvider()
     * @param $expected
     * @param $str
     * @param $ignore
     */
    public function testTitleize($expected, $str, $ignore = [])
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->titleize($ignore), $str);
    }
    public function titleizeProvider()
    {
        $ignore = ['at', 'by', 'for', 'in', 'of', 'on', 'out', 'to', 'the'];
        return [
            ['Title Case', 'TITLE CASE'],
            ['Testing The Method', 'testing the method'],
            ['Testing The Method', '  testing the method  '],
            ['Testing The Method', 'testing the method  '],
            ['2 Testing The Method', '     2 testing the method'],
            ['Testing the Method', 'testing the method', $ignore],
            ['I Like to Watch Dvds at Home', 'i like to watch DVDs at home', $ignore],
            ['Θα Ήθελα Να Φύγει', '  Θα ήθελα να φύγει  ', []]
        ];
    }

    /**
     * @dataProvider toBooleanProvider()
     * @param $expected
     * @param $str
     */
    public function testToBoolean($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toBoolean(), $str);
    }
    public function toBooleanProvider()
    {
        return [
            [true, 'true'],
            [true, '1'],
            [true, 'on'],
            [true, 'ON'],
            [true, 'yes'],
            [true, '999'],
            [false, 'false'],
            [false, '0'],
            [false, 'off'],
            [false, 'OFF'],
            [false, 'no'],
            [false, '-999'],
            [false, ''],
            [false, ' '],
            [false, '  '] // narrow no-break space (U+202F)
        ];
    }

    /**
     * @dataProvider toSpacesProvider()
     * @param $expected
     * @param $str
     * @param int $tabLength
     */
    public function testToSpaces($expected, $str, $tabLength = 4)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toSpaces($tabLength), $str);
    }
    public function toSpacesProvider()
    {
        return [
            ['    foo    bar    ', '	foo	bar	'],
            ['     foo     bar     ', '	foo	bar	', 5],
            ['    foo  bar  ', '		foo	bar	', 2],
            ['foobar', '	foo	bar	', 0],
            ["    foo\n    bar", "	foo\n	bar"],
            ["    fòô\n    bàř", "	fòô\n	bàř"]
        ];
    }

    /**
     * @dataProvider toTabsProvider()
     * @param $expected
     * @param $str
     * @param int $tabLength
     */
    public function testToTabs($expected, $str, $tabLength = 4)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toTabs($tabLength), $str);
    }
    public function toTabsProvider()
    {
        return [
            ['	foo	bar	', '    foo    bar    '],
            ['	foo	bar	', '     foo     bar     ', 5],
            ['		foo	bar	', '    foo  bar  ', 2],
            ["	foo\n	bar", "    foo\n    bar"],
            ["	fòô\n	bàř", "    fòô\n    bàř"]
        ];
    }

    /**
     * @dataProvider toTitleCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testToTitleCase($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->toTitleCase(), $str);
    }
    public function toTitleCaseProvider()
    {
        return [
            ['Foo Bar', 'foo bar'],
            [' Foo_Bar ', ' foo_bar '],
            ['Fòô Bàř', 'fòô bàř'],
            [' Fòô_Bàř ', ' fòô_bàř '],
            ['Αυτοκίνητο Αυτοκίνητο', 'αυτοκίνητο αυτοκίνητο'],
        ];
    }

    /**
     * @dataProvider underscoredProvider()
     * @param $expected
     * @param $str
     */
    public function testUnderscored($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->underscored(), $str);
    }
    public function underscoredProvider()
    {
        return [
            ['test_case', 'testCase'],
            ['test_case', 'Test-Case'],
            ['test_case', 'test case'],
            ['test_case', 'test -case'],
            ['_test_case', '-test - case'],
            ['test_case', 'test_case'],
            ['test_c_test', '  test c test'],
            ['test_u_case', 'TestUCase'],
            ['test_c_c_test', 'TestCCTest'],
            ['string_with1number', 'string_with1number'],
            ['string_with_2_2_numbers', 'String-with_2_2 numbers'],
            ['1test2case', '1test2case'],
            ['yes_we_can', 'yesWeCan'],
            ['test_σase', 'test Σase'],
            ['στανιλ_case', 'Στανιλ case'],
            ['σash_case', 'Σash  Case']
        ];
    }

    /**
     * @dataProvider moveProvider()
     * @param $expected
     * @param $str
     * @param $start
     * @param $length
     * @param $destination
     */
    public function testMove($expected, $str, $start, $length, $destination)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->move($start, $length, $destination), $str);
    }
    public function moveProvider()
    {
        return [
            ['stte_case', 'test_case', 0, 2, 4],
            ['cm/Ae/', '/Acme/', 0, 2, 4],
            ['Στανιλ case', 'Στανιλ case', 0, 4, 1],
            ['ιλΣταν case', 'Στανιλ case', 0, 4, 6],
        ];
    }

    /**
     * @dataProvider overwriteProvider()
     * @param $expected
     * @param $str
     * @param $start
     * @param $length
     * @param $substr
     */
    public function testOverwrite($expected, $str, $start, $length, $substr)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->overwrite($start, $length, $substr), $str);
    }
    public function overwriteProvider()
    {
        return [
            ['overwrittenst_case', 'test_case', 0, 2, 'overwritten'],
            ['oh ιλ case', 'Στανιλ case', 0, 4, 'oh '],
            ['Στανλ case', 'Στανιλ case', 4, 1, ''],
        ];
    }

    /**
     * @dataProvider snakeizeProvider()
     * @param $expected
     * @param $str
     */
    public function testSnakeize($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->snakeize(), $str);
    }
    public function snakeizeProvider()
    {
        return [
            ['camel_case', 'CamelCase'],
            ['camel_case', 'Camel-Case'],
            ['camel_case', 'camel case'],
            ['camel_case', 'camel -case'],
            ['camel_case', 'camel - case'],
            ['camel_case', 'camel_case'],
            ['camel_c_test', 'camel c test'],
            ['string_with_1_number', 'string_with1number'],
            ['string_with_2_2_numbers', 'string-with-2-2 numbers'],
            ['data_rate', 'data_rate'],
            ['background_color', 'background-color'],
            ['yes_we_can', 'yes_we_can'],
            ['moz_something', '-moz-something'],
            ['car_speed', '_car_speed_'],
            ['1_camel_2_case', '1camel2case'],
            ['camel_σase', 'camel σase'],
            ['στανιλ_case', 'Στανιλ case'],
            ['σamel_case', 'σamel  Case'],
            ['serve_http_or_another_abbreviation', 'Serve HTTP or another ABBREVIATION']
        ];
    }

    /**
     * @dataProvider afterFirstProvider()
     * @param $expected
     * @param $str
     * @param $needle
     * @param $substr
     * @param int $times
     */
    public function testAfterFirst($expected, $str, $needle, $substr, $times = 1)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->afterFirst($needle, $substr, $times), $str);
    }
    public function afterFirstProvider()
    {
        return [
            ['CameHERE!HERE!lCase', 'CamelCase', 'me', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
            ['Στανν_νιλ case', 'Στανιλ case', 'ν', 'ν_ν']
        ];
    }

    /**
     * @dataProvider beforeFirstProvider()
     * @param $expected
     * @param $str
     * @param $needle
     * @param $substr
     * @param int $times
     */
    public function testBeforeFirst($expected, $str, $needle, $substr, $times = 1)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->beforeFirst($needle, $substr, $times), $str);
    }
    public function beforeFirstProvider()
    {
        return [
            ['CaHERE!HERE!melCase', 'CamelCase', 'me', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
            ['Σταν_ννιλ case', 'Στανιλ case', 'ν', 'ν_ν']
        ];
    }

    /**
     * @dataProvider afterLastProvider()
     * @param $expected
     * @param $str
     * @param $needle
     * @param $substr
     * @param int $times
     */
    public function testAfterLast($expected, $str, $needle, $substr, $times = 1)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->afterLast($needle, $substr, $times), $str);
    }
    public function afterLastProvider()
    {
        return [
            ['CamelCaHERE!HERE!se', 'CamelCase', 'a', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
            ['Στανιλν_ν case', 'Στανιλ case', 'λ', 'ν_ν']
        ];
    }

    /**
     * @dataProvider beforeLastProvider()
     * @param $expected
     * @param $str
     * @param $needle
     * @param $substr
     * @param int $times
     */
    public function testBeforeLastFirst($expected, $str, $needle, $substr, $times = 1)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->beforeLast($needle, $substr, $times), $str);
    }
    public function beforeLastProvider()
    {
        return [
            ['CamelCHERE!HERE!ase', 'CamelCase', 'a', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
            ['Στανιν_νλ case', 'Στανιλ case', 'λ', 'ν_ν']
        ];
    }

    /**
     * @dataProvider isIpV4Provider()
     * @param $expected
     * @param $str
     */
    public function testIsIpV4($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isIpV4(), $str);
    }
    public function isIpV4Provider()
    {
        return [
            [true, '192.168.1.1'],
            [false, '1234.53..1'],
            [true, '249.212.23.124']
        ];
    }

    /**
     * @dataProvider isIpV6Provider()
     * @param $expected
     * @param $str
     */
    public function testIsIpV6($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isIpV6(), $str);
    }
    public function isIpV6Provider()
    {
        return [
            [true, '2001:470:9b36:1::2'],
            [false, '1200::AB00:1234::2552:7777:1313'],
            [true, '2001:cdba:0000:0000:0000:0000:3257:9652']
        ];
    }

    /**
     * @dataProvider randomProvider()
     * @param $expected
     * @param $size
     * @param $sizeMax
     * @param $possibleChars
     */
    public function testRandom($expected, $size, $sizeMax = -1, $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
    {
        $s = new Str('');
        $this->assertEquals($expected, \mb_strlen((string)$s->random($size, $sizeMax, $possibleChars)));
    }
    public function randomProvider()
    {
        return [
            [5, 5],
            [8, 8, -1, 'ФОРЫВДалыдлорафдлуОГР123']
        ];
    }

    /**
     * @dataProvider appendUniqueIdentifierProvider()
     * @param $expected
     * @param $str
     * @param $size
     * @param int $sizeMax
     * @param string $possibleChars
     */
    public function testAppendUniqueIdentifier($expected, $str, $size = 4, $sizeMax = -1, $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
    {
        $s = new Str($str);
        $this->assertEquals($expected, \mb_strlen((string)$s->appendUniqueIdentifier($size, $sizeMax, $possibleChars)));
    }
    public function appendUniqueIdentifierProvider()
    {
        return [
            [5, 'a'],
            [8, 'afd', 5, -1, 'ФОРЫВДалыдлорафдлуОГР123']
        ];
    }

    /**
     * @dataProvider wordsProvider()
     * @param $expected
     * @param $str
     */
    public function testWords($expected, $str)
    {
        $s = new Str($str);
        $result = $s->words();
        $expectedCount = count($expected);

        if ($expectedCount === 0) {
            $this->assertEmpty($result);
        }

        for ($i = 0; $i < $expectedCount; $i++) {
            $this->assertEquals($expected[$i], $result[$i]);
        }
    }
    public function wordsProvider()
    {
        return [
            [[], ''],
            [[''], '  '],
            [['foo', 'bar'], "foo\nbar"],
            [['foo', 'bar'], 'foo  bar'],
            [['foo', 'bar'], 'foo   bar'],
            [['fòô', 'bàř'], 'fòô bàř']
        ];
    }

    /**
     * @dataProvider quoteProvider()
     * @param $expected
     * @param $str
     * @param string $quote
     */
    public function testQuote($expected, $str, $quote = '"')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->quote($quote));
    }
    public function quoteProvider()
    {
        return [
            ['"Hey," "there" "are" "your" "quoted" "words."', 'Hey,  there are your     quoted words.'],
            ['%$Hey,%$ %$there%$ %$are%$ %$your%$ %$quoted%$ %$words.%$', 'Hey,  there are your     quoted words.', '%$']
        ];
    }

    /**
     * @dataProvider unquoteProvider()
     * @param $expected
     * @param $str
     * @param string $quote
     */
    public function testUnquote($expected, $str, $quote = '"')
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->unquote($quote));
    }
    public function unquoteProvider()
    {
        return [
            ['Hey, there are your quoted words.', '"Hey," "there" "are" "your" "quoted" "words."'],
            ['Hey, there are your quoted words.', '%$Hey,%$ %$there%$ %$are%$ %$your%$ %$quoted%$ %$words.%$', '%$']
        ];
    }

    /**
     * @dataProvider chopProvider()
     * @param $expected
     * @param $str
     * @param $step
     */
    public function testChop($expected, $str, $step = 1)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->chop($step), $str);
    }
    public function chopProvider()
    {
        return [
            [[], ''],
            [[], '  ', -9],
            [['foo', 'bar'], 'foobar', 3],
            [['foob', 'ar'], 'foobar', 4],
            [['fòô', ' bà', 'ř'], 'fòô bàř', 3]
        ];
    }

    /**
     * @dataProvider isEmailProvider()
     * @param $expected
     * @param $str
     */
    public function testIsEmail($expected, $str)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->isEmail(), $str);
    }
    public function isEmailProvider()
    {
        return [
            [true, 'this.is.a.valid@email.com'],
            [false, 'this@is/not@a.valid@email.com'],
            [true, 'validemail22_@localhost']
        ];
    }

    /**
     * @dataProvider joinProvider()
     * @param $expected
     * @param $str
     * @param $separator
     * @param array $otherStrings
     */
    public function testJoin($expected, $str, $separator, $otherStrings = [])
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->join($separator, $otherStrings), $str);
    }
    public function joinProvider()
    {
        return [
            ['', '', '$$', ['']],
            ['  %sdlkfj%sdlfkjas', '  ', '%', ['sdlkfj', 'sdlfkjas']],
            ['foobar', 'foobar', '$$']
        ];
    }

    /**
     * @dataProvider shiftProvider()
     *
     * @param $expected
     * @param $str
     * @param $delimiter
     */
    public function testShift($expected, $str, $delimiter)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->shift($delimiter), $str);
    }
    public function shiftProvider()
    {
        return [
            ['https:', 'https://repl.it/repls/TediousHarmlessGenre', '/'],
            ['', 'string', ''],
            ['foobar', 'foobar', '$$']
        ];
    }

    /**
     * @dataProvider shiftReversedProvider()
     *
     * @param $expected
     * @param $str
     * @param $delimiter
     */
    public function testShiftReversed($expected, $str, $delimiter)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->shiftReversed($delimiter), $str);
    }
    public function shiftReversedProvider()
    {
        return [
            ['/repl.it/repls/TediousHarmlessGenre', 'https://repl.it/repls/TediousHarmlessGenre', '/'],
            ['', 'string', ''],
            ['foobar', 'foobar', '$$']
        ];
    }

    /**
     * @dataProvider popProvider()
     *
     * @param $expected
     * @param $str
     * @param $delimiter
     */
    public function testPop($expected, $str, $delimiter)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->pop($delimiter), $str);
    }
    public function popProvider()
    {
        return [
            ['TediousHarmlessGenre', 'https://repl.it/repls/TediousHarmlessGenre', '/'],
            ['', 'string', ''],
            ['foobar', 'foobar', '$$']
        ];
    }

    /**
     * @dataProvider popReversedProvider()
     *
     * @param $expected
     * @param $str
     * @param $delimiter
     */
    public function testPopReversed($expected, $str, $delimiter)
    {
        $s = new Str($str);
        $this->assertEquals($expected, $s->popReversed($delimiter), $str);
    }
    public function popReversedProvider()
    {
        return [
            ['https://repl.it/repls', 'https://repl.it/repls/TediousHarmlessGenre', '/'],
            ['', 'string', ''],
            ['foobar', 'foobar', '$$']
        ];
    }
}
