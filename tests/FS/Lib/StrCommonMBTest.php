<?php

declare(strict_types=1);

use \Str\Str;
use \Str\Lib\StrCommonMB;
use \Str\Lib\StrModifiersMB;
use PHPUnit\Framework\TestCase;

class StrCommonMBTest extends TestCase
{
    /**
     * @dataProvider EnsureLeftProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureLeft(array $inp, string $out)
    {
        $this->assertEquals($out, StrModifiersMB::ensureLeft(
            array_shift($inp),
            array_shift($inp)
        ));
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
     * @dataProvider EnsureRightProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureRight(array $inp, string $out)
    {
        $this->assertEquals($out, StrModifiersMB::ensureRight(
            array_shift($inp),
            array_shift($inp)
        ));
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
     * @dataProvider HasPrefixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasPrefix(array $inp, bool $result)
    {
        $this->assertEquals($result, StrCommonMB::hasPrefix(
            array_shift($inp),
            array_shift($inp)
        ));
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
        $this->assertEquals($result, StrCommonMB::hasSuffix(
            array_shift($inp),
            array_shift($inp)
        ));
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
     * @dataProvider lengthProvider()
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
     * @dataProvider ContainsProvider
     * @param $expected
     * @param $haystack
     * @param $needle
     * @param bool $caseSensitive
     */
    public function testContains($expected, $haystack, $needle, $caseSensitive = true)
    {
        $this->assertEquals(
            $expected,
            StrCommonMB::contains($haystack, $needle, $caseSensitive),
            sprintf('%s - %s', $haystack, $needle)
        );
    }

    public function ContainsProvider()
    {
        return [
            [true, '', ''],
            [true, 'Str contains foo bar', 'foo bar'],
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
     * @dataProvider AtProvider
     * @param $expected
     * @param $str
     * @param $pos
     */
    public function testAt($expected, $str, $pos)
    {
        $this->assertEquals($expected, StrCommonMB::at($str, $pos));
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
     * @dataProvider indexOfProvider()
     * @param $expected
     * @param $haystack
     * @param $needle
     * @param int $offset
     */
    public function testIndexOf($expected, $haystack, $needle, $offset = 0)
    {
        $this->assertEquals($expected, StrCommonMB::indexOf($haystack, $needle, $offset));
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
            [-1, 'q', 'q', -5],
            [-1, '', '', 0],
            [-1, 'q', '', 0],
            [-1, '', 'q', 0],
            [-1, 'q', 'q', 5],
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
        $this->assertEquals($expected, StrCommonMB::indexOfLast($haystack, $needle, $offset));
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
        $this->assertEquals($expected, StrCommonMB::countSubstr($str, $substring, $caseSensitive));
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
            [2, 'συγγραφέας', 'Σ', false]
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
        $this->assertEquals($expected, StrCommonMB::containsAll($haystack, $needles, $caseSensitive), $haystack);
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
        $this->assertEquals($expected, StrCommonMB::containsAny($haystack, $needles, $caseSensitive), $haystack);
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
        $this->assertEquals($expected, StrCommonMB::startsWith($str, $substring, $caseSensitive), $str);
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
        $this->assertEquals($expected, StrCommonMB::startsWithAny($str, $substrings, $caseSensitive), $str);
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
        $this->assertEquals($expected, StrCommonMB::endsWith($str, $substring, $caseSensitive), $str);
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
        $this->assertEquals($expected, StrCommonMB::endsWithAny($str, $substrings, $caseSensitive), $str);
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
     * @dataProvider isUUIDv4Provider()
     * @param $expected
     * @param $str
     */
    public function testIsUUIDv4($expected, $str)
    {
        $this->assertEquals($expected, StrCommonMB::isUUIDv4($str), $str);
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
}
