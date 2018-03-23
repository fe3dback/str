<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function Str\Lib\libstr_ascii_afterFirst;
use function Str\Lib\libstr_ascii_afterLast;
use function Str\Lib\libstr_ascii_appendUniqueIdentifier;
use function Str\Lib\libstr_ascii_beforeFirst;
use function Str\Lib\libstr_ascii_beforeLast;
use function Str\Lib\libstr_ascii_chop;
use function Str\Lib\libstr_ascii_isEmail;
use function Str\Lib\libstr_ascii_join;
use function Str\Lib\libstr_ascii_matchesPattern;
use function Str\Lib\libstr_ascii_ensureLeft;
use function Str\Lib\libstr_ascii_ensureRight;
use function Str\Lib\libstr_ascii_hasPrefix;
use function Str\Lib\libstr_ascii_hasSuffix;
use function Str\Lib\libstr_ascii_contains;
use function Str\Lib\libstr_ascii_move;
use function Str\Lib\libstr_ascii_overwrite;
use function Str\Lib\libstr_ascii_pop;
use function Str\Lib\libstr_ascii_popReversed;
use function Str\Lib\libstr_ascii_quote;
use function Str\Lib\libstr_ascii_random;
use function Str\Lib\libstr_ascii_replace;
use function Str\Lib\libstr_ascii_shift;
use function Str\Lib\libstr_ascii_shiftReversed;
use function Str\Lib\libstr_ascii_snakeize;
use function Str\Lib\libstr_ascii_toLowerCase;
use function Str\Lib\libstr_ascii_toUpperCase;
use function Str\Lib\libstr_ascii_trim;
use function Str\Lib\libstr_ascii_trimLeft;
use function Str\Lib\libstr_ascii_trimRight;
use function Str\Lib\libstr_ascii_append;
use function Str\Lib\libstr_ascii_prepend;
use function Str\Lib\libstr_ascii_at;
use function Str\Lib\libstr_ascii_substr;
use function Str\Lib\libstr_ascii_chars;
use function Str\Lib\libstr_ascii_first;
use function Str\Lib\libstr_ascii_last;
use function Str\Lib\libstr_ascii_length;
use function Str\Lib\libstr_ascii_indexOf;
use function Str\Lib\libstr_ascii_indexOfLast;
use function Str\Lib\libstr_ascii_countSubstr;
use function Str\Lib\libstr_ascii_containsAll;
use function Str\Lib\libstr_ascii_containsAny;
use function Str\Lib\libstr_ascii_startsWith;
use function Str\Lib\libstr_ascii_startsWithAny;
use function Str\Lib\libstr_ascii_endsWith;
use function Str\Lib\libstr_ascii_endsWithAny;
use function Str\Lib\libstr_ascii_padBoth;
use function Str\Lib\libstr_ascii_padLeft;
use function Str\Lib\libstr_ascii_padRight;
use function Str\Lib\libstr_ascii_insert;
use function Str\Lib\libstr_ascii_removeLeft;
use function Str\Lib\libstr_ascii_removeRight;
use function Str\Lib\libstr_ascii_repeat;
use function Str\Lib\libstr_ascii_reverse;
use function Str\Lib\libstr_ascii_shuffle;
use function Str\Lib\libstr_ascii_between;
use function Str\Lib\libstr_ascii_camelize;
use function Str\Lib\libstr_ascii_collapseWhitespace;
use function Str\Lib\libstr_ascii_dasherize;
use function Str\Lib\libstr_ascii_delimit;
use function Str\Lib\libstr_ascii_lowerCaseFirst;
use function Str\Lib\libstr_ascii_regexReplace;
use function Str\Lib\libstr_ascii_unquote;
use function Str\Lib\libstr_ascii_upperCaseFirst;
use function Str\Lib\libstr_ascii_hasLowerCase;
use function Str\Lib\libstr_ascii_hasUpperCase;
use function Str\Lib\libstr_ascii_htmlDecode;
use function Str\Lib\libstr_ascii_htmlEncode;
use function Str\Lib\libstr_ascii_humanize;
use function Str\Lib\libstr_ascii_isAlpha;
use function Str\Lib\libstr_ascii_isAlphanumeric;
use function Str\Lib\libstr_ascii_isBase64;
use function Str\Lib\libstr_ascii_isBlank;
use function Str\Lib\libstr_ascii_isHexadecimal;
use function Str\Lib\libstr_ascii_isJson;
use function Str\Lib\libstr_ascii_isLowerCase;
use function Str\Lib\libstr_ascii_isSerialized;
use function Str\Lib\libstr_ascii_isUpperCase;
use function Str\Lib\libstr_ascii_lines;
use function Str\Lib\libstr_ascii_split;
use function Str\Lib\libstr_ascii_longestCommonPrefix;
use function Str\Lib\libstr_ascii_longestCommonSuffix;
use function Str\Lib\libstr_ascii_longestCommonSubstring;
use function Str\Lib\libstr_ascii_safeTruncate;
use function Str\Lib\libstr_ascii_slugify;
use function Str\Lib\libstr_ascii_slice;
use function Str\Lib\libstr_ascii_stripWhitespace;
use function Str\Lib\libstr_ascii_truncate;
use function Str\Lib\libstr_ascii_upperCamelize;
use function Str\Lib\libstr_ascii_surround;
use function Str\Lib\libstr_ascii_swapCase;
use function Str\Lib\libstr_ascii_tidy;
use function Str\Lib\libstr_ascii_titleize;
use function Str\Lib\libstr_ascii_toBoolean;
use function Str\Lib\libstr_ascii_toSpaces;
use function Str\Lib\libstr_ascii_toTabs;
use function Str\Lib\libstr_ascii_underscored;
use function Str\Lib\libstr_ascii_words;

class StrASCIITest extends TestCase
{
    /**
     * @dataProvider HasPrefixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasPrefix(array $inp, bool $result)
    {
        $this->assertEquals($result, libstr_ascii_hasPrefix(
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
        $this->assertEquals($result, libstr_ascii_hasSuffix(
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
     * @param $expected
     * @param $str
     */
    public function testLength($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_length($str));
    }
    public function lengthProvider()
    {
        return [
            [11, '  foo bar  '],
            [1, 'f'],
            [0, ''],
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
            libstr_ascii_contains($haystack, $needle, $caseSensitive),
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
            [false, 'Str contains foo bar', 'Foo bar'],
            [false, 'Str contains foo bar', 'foobar'],
            [false, 'Str contains foo bar', 'foo bar '],
            [false, 'Str contains foo bar', 'foobar', false],
            [false, 'Str contains foo bar', 'foo bar ', false],
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
        $this->assertEquals($expected, libstr_ascii_indexOf($haystack, $needle, $offset));
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
        $this->assertEquals($expected, libstr_ascii_indexOfLast($haystack, $needle, $offset));
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
        $this->assertEquals($expected, libstr_ascii_countSubstr($str, $substring, $caseSensitive));
    }

    public function countSubstrProvider()
    {
        return [
            [0, '', 'foo'],
            [0, 'foo', 'bar'],
            [1, 'foo bar', 'foo'],
            [2, 'foo bar', 'o'],
            [0, 'foo', 'BAR', false],
            [1, 'foo bar', 'FOo', false],
            [2, 'foo bar', 'O', false],
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
        $this->assertEquals($expected, libstr_ascii_containsAll($haystack, $needles, $caseSensitive), $haystack);
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
            [false, 'Str contains foo bar', ['Foo', 'bar']],
            [false, 'Str contains foo bar', ['foobar', 'bar']],
            [false, 'Str contains foo bar', ['foo bar ', 'bar']],
            [false, 'Str contains foo bar', ['foobar', 'none'], false],
            [false, 'Str contains foo bar', ['foo bar ', ' ba'], false],
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
        $this->assertEquals($expected, libstr_ascii_containsAny($haystack, $needles, $caseSensitive), $haystack);
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
            [false, 'Str contains foo bar', ['Foo', 'Bar']],
            [false, 'Str contains foo bar', ['foobar', 'bar ']],
            [false, 'Str contains foo bar', ['foo bar ', '  foo']],
            [false, 'Str contains foo bar', ['foobar', 'none'], false],
            [false, 'Str contains foo bar', ['foo bar ', ' ba '], false],
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
        $this->assertEquals($expected, libstr_ascii_startsWith($str, $substring, $caseSensitive), $str);
    }
    public function startsWithProvider()
    {
        return [
            [true, 'foo bars', 'foo bar'],
            [true, 'FOO bars', 'foo bar', false],
            [true, 'FOO bars', 'foo BAR', false],
            [false, 'foo bar', 'bar'],
            [false, 'foo bar', 'foo bars'],
            [false, 'FOO bar', 'foo bars'],
            [false, 'FOO bars', 'foo BAR'],
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
        $this->assertEquals($expected, libstr_ascii_startsWithAny($str, $substrings, $caseSensitive), $str);
    }
    public function startsWithProviderAny()
    {
        return [
            [true, 'foo bars', ['foo bar']],
            [true, 'FOO bars', ['foo bar'], false],
            [true, 'FOO bars', ['foo bar', 'foo BAR'], false],
            [false, 'foo bar', ['bar']],
            [false, 'foo bar', ['foo bars']],
            [false, 'FOO bar', ['foo bars']],
            [false, 'FOO bars', ['foo BAR']],
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
        $this->assertEquals($expected, libstr_ascii_endsWith($str, $substring, $caseSensitive), $str);
    }
    public function endsWithProvider()
    {
        return [
            [true, 'foo bars', 'o bars'],
            [true, 'FOO bars', 'o bars', false],
            [true, 'FOO bars', 'o BARs', false],
            [false, 'foo bar', 'foo'],
            [false, 'foo bar', 'foo bars'],
            [false, 'FOO bar', 'foo bars'],
            [false, 'FOO bars', 'foo BARS'],
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
        $this->assertEquals($expected, libstr_ascii_endsWithAny($str, $substrings, $caseSensitive), $str);
    }
    public function endsWithAnyProvider()
    {
        return [
            [true, 'foo bars', ['foo', 'o bars']],
            [true, 'FOO bars', ['foo', 'o bars'], false],
            [true, 'FOO bars', ['foo', 'o BARs'], false],
            [false, 'foo bar', ['foo']],
            [false, 'foo bar', ['foo', 'foo bars']],
            [false, 'FOO bar', ['foo', 'foo bars']],
            [false, 'FOO bars', ['foo', 'foo BARS']],
            [false, 'anything', []]
        ];
    }

    /**
     * @dataProvider hasLowerCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testHasLowerCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_hasLowerCase($str), $str);
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
        ];
    }

    /**
     * @dataProvider hasUpperCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testHasUpperCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_hasUpperCase($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_matchesPattern($str, $pattern), $str);
    }
    public function matchesPatternProvider()
    {
        return [
            [true, 'FOOBAR', '/.*FOO/'],
            [false, 'foo bar', '/.*  bar/'],
            [true, 'Foo bar', '/.* ba/'],
            [true, 'FOo bar', '/.*Oo/'],
            [true, 'foo baR', '/.*aR/'],
            [true, 'fOOBAR', '/.*OBA/'],
        ];
    }

    /**
     * @dataProvider isAlphaProvider()
     * @param $expected
     * @param $str
     */
    public function testIsAlpha($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isAlpha($str), $str);
    }
    public function isAlphaProvider()
    {
        return [
            [true, ''],
            [true, 'foobar'],
            [false, 'foo bar'],
            [false, 'foobar2'],
        ];
    }

    /**
     * @dataProvider isAlphanumericProvider()
     * @param $expected
     * @param $str
     */
    public function testIsAlphanumeric($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isAlphanumeric($str), $str);
    }
    public function isAlphanumericProvider()
    {
        return [
            [true, ''],
            [true, 'foobar1'],
            [false, 'foo bar'],
            [false, 'foobar2"'],
            [false, "\nfoobar\n"],
        ];
    }

    /**
     * @dataProvider isBase64Provider()
     * @param $expected
     * @param $str
     */
    public function testIsBase64($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isBase64($str), $str);
    }
    public function isBase64Provider()
    {
        return [
            [false, ' '],
            [true, ''],
            [true, base64_encode('FooBar') ],
            [true, base64_encode(' ') ],
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
        $this->assertEquals($expected, libstr_ascii_isBlank($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_isHexadecimal($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_isJson($str), $str);
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
        ];
    }

    /**
     * @dataProvider isLowerCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testIsLowerCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isLowerCase($str), $str);
    }
    public function isLowerCaseProvider()
    {
        return [
            [true, ''],
            [true, 'foobar'],
            [false, 'foo bar'],
            [false, 'Foobar'],
        ];
    }

    /**
     * @dataProvider isSerializedProvider()
     * @param $expected
     * @param $str
     */
    public function testIsSerialized($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isSerialized($str), $str);
    }
    public function isSerializedProvider()
    {
        return [
            [false, ''],
            [true, 'a:1:{s:3:"foo";s:3:"bar";}'],
            [false, 'a:1:{s:3:"foo";s:3:"bar"}'],
            [true, serialize(['foo' => 'bar'])],
        ];
    }

    /**
     * @dataProvider isUpperCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testIsUpperCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isUpperCase($str), $str);
    }
    public function isUpperCaseProvider()
    {
        return [
            [true, ''],
            [true, 'FOOBAR'],
            [false, 'FOO BAR'],
            [false, 'fOOBAR'],
        ];
    }

    /**
     * @dataProvider toBooleanProvider()
     * @param $expected
     * @param $str
     */
    public function testToBoolean($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_toBoolean($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_substr($str, $start, $length));
    }

    public function SubstrProvider()
    {
        return [
            ['Hel', 'Hello world', 0, 3],
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
        $this->assertEquals($out, libstr_ascii_ensureRight(
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
            ];
    }

    /**
     * @dataProvider EnsureLeftProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureLeft(array $inp, string $out)
    {
        $this->assertEquals($out, libstr_ascii_ensureLeft(
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
        $this->assertEquals($expected, libstr_ascii_at($str, $pos));
    }

    public function AtProvider()
    {
        return [
            ['H', 'Hello world', 0],
            ['e', 'Hello world', 1],
            ['d', 'Hello world', -1],
            ['', '', 0],
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
        $this->assertEquals($expected, libstr_ascii_chars($str));
    }

    public function charsProvider()
    {
        return [
            [[], ''],
            [['T', 'e', 's', 't'], 'Test'],
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
        $this->assertEquals($expected, libstr_ascii_first($str, $n));
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
        $this->assertEquals($expected, libstr_ascii_last($str, $n));
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
        ];
    }

    /**
     * @dataProvider toLowerCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testToLowerCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_toLowerCase($str));
    }
    public function toLowerCaseProvider()
    {
        return [
            ['foo bar', 'FOO BAR'],
            [' foo_bar ', ' FOO_bar '],
        ];
    }

    /**
     * @dataProvider toUpperCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testToUpperCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_toUpperCase($str));
    }
    public function toUpperCaseProvider()
    {
        return [
            ['FOO BAR', 'foo bar'],
            [' FOO_BAR ', ' FOO_bar '],
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
        $this->assertEquals($expected, libstr_ascii_append($str, $string));
    }
    public function appendProvider()
    {
        return [
            ['foobar', 'foo', 'bar'],
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
        $this->assertEquals($expected, libstr_ascii_prepend($str, $string));
    }
    public function prependProvider()
    {
        return [
            ['foobar', 'bar', 'foo'],
        ];
    }

    /**
     * @dataProvider ReplaceProvider
     * @param $params
     * @param $expected
     */
    public function testReplace($params, $expected)
    {
        $this->assertEquals($expected, libstr_ascii_replace(
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
                    ['banana', 'a', 'e', 4],
                    'benene'
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
        $this->assertEquals($expected, libstr_ascii_trim($str, $chars));
    }
    public function trimProvider()
    {
        return [
            ['foo   bar', '  foo   bar  '],
            ['foo bar', ' foo bar'],
            ['foo bar', 'foo bar '],
            ['foo bar', "\n\t foo bar \n\t"],
            [' foo bar ', "\n\t foo bar \n\t", "\n\t"],
            ['foo boo', "\n\t foo boo \n\t", ''],
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
        $this->assertEquals($expected, libstr_ascii_trimLeft($str, $chars));
    }
    public function trimLeftProvider()
    {
        return [
            ['foo   bar  ', '  foo   bar  '],
            ['foo bar', ' foo bar'],
            ['foo bar ', 'foo bar '],
            ["foo bar \n\t", "\n\t foo bar \n\t"],
            ['foo bar', '--foo bar', '-'],
            ["foo boo \n\t", "\n\t foo boo \n\t", ''],
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
        $this->assertEquals($expected, libstr_ascii_trimRight($str, $chars));
    }
    public function trimRightProvider()
    {
        return [
            ['  foo   bar', '  foo   bar  '],
            ['foo bar', 'foo bar '],
            [' foo bar', ' foo bar'],
            ["\n\t foo bar", "\n\t foo bar \n\t"],
            ['foo bar', 'foo bar--', '-'],
            ['foo b', 'foo boooo', 'o'],
            ["\n\t foo boo", "\n\t foo boo \n\t", ''],
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
        $this->assertEquals($expected, libstr_ascii_padLeft($str, $length, $padStr));
    }
    public function padLeftProvider()
    {
        return [
            ['  foo bar', 'foo bar', 9],
            ['_*foo bar', 'foo bar', 9, '_*'],
            ['_*_foo bar', 'foo bar', 10, '_*'],
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
        $this->assertEquals($expected, libstr_ascii_padRight($str, $length, $padStr));
    }
    public function padRightProvider()
    {
        return [
            ['foo bar  ', 'foo bar', 9],
            ['foo bar_*', 'foo bar', 9, '_*'],
            ['foo bar_*_', 'foo bar', 10, '_*'],
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
        $this->assertEquals($expected, libstr_ascii_padBoth($str, $length, $padStr));
    }
    public function padBothProvider()
    {
        return [
            ['foo bar ', 'foo bar', 8],
            [' foo bar ', 'foo bar', 9, ' '],
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
        $this->assertEquals($expected, libstr_ascii_insert($str, $substring, $index));
    }
    public function insertProvider()
    {
        return [
            ['foo bar', 'oo bar', 'f', 0],
            ['foo bar', 'f bar', 'oo', 1],
            ['f baroo', 'f bar', 'oo', 20],
            ['foo bar', 'foo ba', 'r', 6],
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
        $this->assertEquals($expected, libstr_ascii_removeLeft($str, $substring));
    }
    public function removeLeftProvider()
    {
        $s = 'foo bar';
        return [
            ['foo bar', 'foo bar', ''],
            ['oo bar', 'foo bar', 'f'],
            ['bar', 'foo bar', 'foo '],
            ['foo bar', 'foo bar', 'oo'],
            ['foo bar', 'foo bar', 'oo bar'],
            ['oo bar', 'foo bar', libstr_ascii_first($s)],
            ['oo bar', 'foo bar', libstr_ascii_at($s,0)],
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
        $this->assertEquals($expected, libstr_ascii_removeRight($str, $substring));
    }
    public function removeRightProvider()
    {
        $s = 'foo bar';
        return [
            ['foo bar', 'foo bar', ''],
            ['foo ba', 'foo bar', 'r'],
            ['foo', 'foo bar', ' bar'],
            ['foo bar', 'foo bar', 'ba'],
            ['foo bar', 'foo bar', 'foo ba'],
            ['foo ba', 'foo bar', libstr_ascii_last($s)],
            ['foo ba', 'foo bar', libstr_ascii_at($s,6)],
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
        $this->assertEquals($expected, libstr_ascii_repeat($str, $multiplier));
    }
    public function repeatProvider()
    {
        return [
            ['', 'foo', 0],
            ['foo', 'foo', 1],
            ['foofoo', 'foo', 2],
            ['foofoofoo', 'foo', 3],
        ];
    }

    /**
     * @dataProvider reverseProvider()
     * @param $expected
     * @param $str
     */
    public function testReverse($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_reverse($str));
    }
    public function reverseProvider()
    {
        return [
            ['', ''],
            ['raboof', 'foobar'],
        ];
    }

    /**
     * @dataProvider shuffleProvider()
     * @param $str
     */
    public function testShuffle($str)
    {
        $result = libstr_ascii_shuffle($str);

        $oldValues = libstr_ascii_chars($str);
        $newValues = libstr_ascii_chars($result);

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
        $this->assertEquals($expected, libstr_ascii_between($str, $start, $end, $offset), $str);
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
        ];
    }

    /**
     * @dataProvider camelizeProvider()
     * @param $expected
     * @param $str
     */
    public function testCamelize($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_camelize($str), $str);
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
        ];
    }

    /**
     * @dataProvider upperCaseFirstProvider()
     * @param $expected
     * @param $str
     */
    public function testUpperCaseFirst($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_upperCaseFirst($str), $str);
    }
    public function upperCaseFirstProvider()
    {
        return [
            ['Test', 'Test'],
            ['Test', 'test'],
            ['1a', '1a'],
        ];
    }

    /**
     * @dataProvider lowerCaseFirstProvider()
     * @param $expected
     * @param $str
     */
    public function testLowerCaseFirst($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_lowerCaseFirst($str), $str);
    }
    public function lowerCaseFirstProvider()
    {
        return [
            ['test', 'Test'],
            ['test', 'test'],
            ['1a', '1a'],
        ];
    }

    /**
     * @dataProvider collapseWhitespaceProvider()
     * @param $expected
     * @param $str
     */
    public function testCollapseWhitespace($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_collapseWhitespace($str), $str);
    }
    public function collapseWhitespaceProvider()
    {
        return [
            ['foo bar', '  foo   bar  '],
            ['test string', 'test string'],
            ['123', ' 123 '],
            ['1 2 3', '  1  2  3   '],
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
    public function testRegexReplace($expected, $str, $pattern, $replacement, $options = 'ms')
    {
        $this->assertEquals($expected, libstr_ascii_regexReplace($str, $pattern, $replacement, $options), $str);
    }
    public function regexReplaceProvider()
    {
        return [
            ['', '', '', ''],
            ['bar', 'foo', 'f[o]+', 'bar'],
            ['o bar', 'foo bar', 'f(o)o', '\1'],
            ['bar', 'foo bar', 'f[O]+\s', '', 'i'],
            ['foo', 'bar', '[[:alpha:]]{3}', 'foo'],
            ['', '', '', '', 'ms'],
        ];
    }

    /**
     * @dataProvider dasherizeProvider()
     * @param $expected
     * @param $str
     */
    public function testDasherize($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_dasherize($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_delimit($str, $delimiter), $str);
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
        $this->assertEquals($expected, libstr_ascii_htmlEncode($str, $flags), $str);
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
        $this->assertEquals($expected, libstr_ascii_htmlDecode($str, $flags), $str);
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
        $this->assertEquals($expected, libstr_ascii_humanize($str), $str);
    }
    public function humanizeProvider()
    {
        return [
            ['Author', 'author_id'],
            ['Test user', ' _test_user_'],
        ];
    }

    /**
     * @dataProvider linesProvider()
     * @param $expected
     * @param $str
     */
    public function testLines($expected, $str)
    {
        $result = libstr_ascii_lines($str);
        $expectedCount = count($expected);

        if ($expectedCount === 0) { $this->assertEmpty($result); }
        if ($expectedCount === 1) { $this->assertEquals($expected[0], $result[0]); }

        for ($i = 0; $i < $expectedCount - 1; $i++) {
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
        $result = libstr_ascii_split($str, $pattern, $limit);
        $expectedLen = count($expected);

        if ($expectedLen === 0) { $this->assertEmpty($result); }
        if ($expectedLen === 1) { $this->assertEquals($expected, $result); }

        for ($i = 0; $i < $expectedLen - 1; $i++) {
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
        $this->assertEquals($expected, libstr_ascii_longestCommonPrefix($str, $otherStr), $str);
    }
    public function longestCommonPrefixProvider()
    {
        return [
            ['foo', 'foobar', 'foo bar'],
            ['foo bar', 'foo bar', 'foo bar'],
            ['f', 'foo bar', 'far boo'],
            ['', 'toy car', 'foo bar'],
            ['', 'foo bar', ''],
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
        $this->assertEquals($expected, libstr_ascii_longestCommonSuffix($str, $otherStr), $str);
    }
    public function longestCommonSuffixProvider()
    {
        return [
            ['bar', 'foobar', 'foo bar'],
            ['foo bar', 'foo bar', 'foo bar'],
            ['ar', 'foo bar', 'boo far'],
            ['', 'foo bad', 'foo bar'],
            ['', 'foo bar', ''],
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
        $this->assertEquals($expected, libstr_ascii_longestCommonSubstring($str, $otherStr), $str);
    }
    public function longestCommonSubstringProvider()
    {
        return [
            ['foo', 'foobar', 'foo bar'],
            ['foo bar', 'foo bar', 'foo bar'],
            ['oo ', 'foo bar', 'boo far'],
            ['foo ba', 'foo bad', 'foo bar'],
            ['', 'foo bar', ''],
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
        $this->assertEquals($expected, libstr_ascii_safeTruncate($str, $length, $substring), $str);
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
        $this->assertEquals($expected, libstr_ascii_slugify($str, $replacement), $str);
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
            ['numbers-1234', 'numbers 1234'],
            ['foo:bar:baz', 'Foo bar baz', ':'],
            ['a_string_with_underscores', 'A_string with_underscores', '_'],
            ['a_string_with_dashes', 'A string-with-dashes', '_'],
            ['a\string\with\dashes', 'A string-with-dashes', '\\'],
            ['an_odd_string', '--   An odd__   string-_', '_']
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
        $this->assertEquals($expected, libstr_ascii_slice($str, $start, $end), $str);
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
        ];
    }

    /**
     * @dataProvider stripWhitespaceProvider()
     * @param $expected
     * @param $str
     */
    public function testStripWhitespace($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_stripWhitespace($str), $str);
    }
    public function stripWhitespaceProvider()
    {
        return [
            ['foobar', '  foo   bar  '],
            ['teststring', 'test string'],
            ['123', ' 123 '],
            ['123', '  1  2  3    '],
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
        $this->assertEquals($expected, libstr_ascii_truncate($str, $length, $substring), $str);
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
        $this->assertEquals($expected, libstr_ascii_upperCamelize($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_surround($str, $substring), $str);
    }
    public function surroundProvider()
    {
        return [
            ['__foobar__', 'foobar', '__'],
            ['test', 'test', ''],
            ['**', '', '*'],
        ];
    }

    /**
     * @dataProvider swapCaseProvider()
     * @param $expected
     * @param $str
     */
    public function testSwapCase($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_swapCase($str), $str);
    }
    public function swapCaseProvider()
    {
        return [
            ['TESTcASE', 'testCase'],
            ['tEST-cASE', 'Test-Case'],
        ];
    }

    /**
     * @dataProvider tidyProvider()
     * @param $expected
     * @param $str
     */
    public function testTidy($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_tidy($str), $str);
    }
    public function tidyProvider()
    {
        /** @noinspection UnNecessaryDoubleQuotesInspection */
        return [
            ['"I see..."', '“I see…”'],
            ["'This too'", "‘This too’"],
            ['test-dash', 'test—dash'],
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
        $this->assertEquals($expected, libstr_ascii_titleize($str, $ignore), $str);
    }
    public function titleizeProvider()
    {
        $ignore = ['at', 'by', 'for', 'in', 'of', 'on', 'out', 'to', 'the'];
        return [
            ['Title Case', 'TITLE CASE'],
            ['Testing The Method', 'testing the method'],
            ['Testing the Method', 'testing the method', $ignore],
            ['I Like to Watch Dvds at Home', 'i like to watch DVDs at home',
                $ignore],
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
        $this->assertEquals($expected, libstr_ascii_toSpaces($str, $tabLength), $str);
    }
    public function toSpacesProvider()
    {
        return [
            ['    foo    bar    ', '	foo	bar	'],
            ['     foo     bar     ', '	foo	bar	', 5],
            ['    foo  bar  ', '		foo	bar	', 2],
            ['foobar', '	foo	bar	', 0],
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
        $this->assertEquals($expected, libstr_ascii_toTabs($str, $tabLength), $str);
    }
    public function toTabsProvider()
    {
        return [
            ['	foo	bar	', '    foo    bar    '],
            ['	foo	bar	', '     foo     bar     ', 5],
            ['		foo	bar	', '    foo  bar  ', 2],
        ];
    }

    /**
     * @dataProvider underscoredProvider()
     * @param $expected
     * @param $str
     */
    public function testUnderscored($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_underscored($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_move($str, $start, $length, $destination), $str);
    }
    public function moveProvider()
    {
        return [
            ['stte_case', 'test_case', 0, 2, 4],
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
        $this->assertEquals($expected, libstr_ascii_overwrite($str, $start, $length, $substr), $str);
    }
    public function overwriteProvider()
    {
        return [
            ['overwrittenst_case', 'test_case', 0, 2, 'overwritten'],
        ];
    }

    /**
     * @dataProvider snakeizeProvider()
     * @param $expected
     * @param $str
     */
    public function testSnakeize($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_snakeize($str), $str);
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
        $this->assertEquals($expected, libstr_ascii_afterFirst($str, $needle, $substr, $times), $str);
    }
    public function afterFirstProvider()
    {
        return [
            ['CameHERE!HERE!lCase', 'CamelCase', 'me', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
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
        $this->assertEquals($expected, libstr_ascii_beforeFirst($str, $needle, $substr, $times), $str);
    }
    public function beforeFirstProvider()
    {
        return [
            ['CaHERE!HERE!melCase', 'CamelCase', 'me', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
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
        $this->assertEquals($expected, libstr_ascii_afterLast($str, $needle, $substr, $times), $str);
    }
    public function afterLastProvider()
    {
        return [
            ['CamelCaHERE!HERE!se', 'CamelCase', 'a', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
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
        $this->assertEquals($expected, libstr_ascii_beforeLast($str, $needle, $substr, $times), $str);
    }
    public function beforeLastProvider()
    {
        return [
            ['CamelCHERE!HERE!ase', 'CamelCase', 'a', 'HERE!', 2],
            ['Camel-Case', 'Camel-Case', 'e', 'not gonna happen', 0],
        ];
    }

    /**
     * @dataProvider isEmailProvider()
     * @param $expected
     * @param $str
     */
    public function testIsEmail($expected, $str)
    {
        $this->assertEquals($expected, libstr_ascii_isEmail($str), $str);
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
     * @dataProvider randomProvider()
     * @param $expected
     * @param $size
     * @param $sizeMax
     * @param $possibleChars
     */
    public function testRandom($expected, $size, $sizeMax = -1, $possibleChars = '')
    {
        $this->assertEquals($expected, \strlen(libstr_ascii_random($size, $sizeMax, $possibleChars)));
    }
    public function randomProvider()
    {
        return [
            [5, 5],
            [8, 8, -1, 'a;sdfskdhfwjqlkjweksrhesrtwerfsdfew']
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
    public function testAppendUniqueIdentifier($expected, $str, $size = 4, $sizeMax = -1, $possibleChars = '')
    {
        $this->assertEquals($expected, \strlen(libstr_ascii_appendUniqueIdentifier($str, $size, $sizeMax, $possibleChars)));
    }
    public function appendUniqueIdentifierProvider()
    {
        return [
            [5, 'a'],
            [8, 'afd', 5, -1, 'sdfskdhfwjqlkjweksrhesrtwerfsdfew']
        ];
    }

    /**
     * @dataProvider wordsProvider()
     * @param $expected
     * @param $str
     */
    public function testWords($expected, $str)
    {
        $result = libstr_ascii_words($str);
        $expectedCount = count($expected);

        if ($expectedCount === 0) { $this->assertEmpty($result); }

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
        $this->assertEquals($expected, libstr_ascii_quote($str, $quote));
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
        $this->assertEquals($expected, libstr_ascii_unquote($str, $quote));
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
        $this->assertEquals($expected, libstr_ascii_chop($str, $step), $str);
    }
    public function chopProvider()
    {
        return [
            [[], ''],
            [[], '  ', -9],
            [['foo', 'bar'], 'foobar', 3],
            [['foob', 'ar'], 'foobar', 4],
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
        $this->assertEquals($expected, libstr_ascii_join($str, $separator, $otherStrings), $str);
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
        $this->assertEquals($expected, libstr_ascii_shift($str, $delimiter), $str);
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
        $this->assertEquals($expected, libstr_ascii_shiftReversed($str, $delimiter), $str);
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
        $this->assertEquals($expected, libstr_ascii_pop($str, $delimiter), $str);
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
        $this->assertEquals($expected, libstr_ascii_popReversed($str, $delimiter), $str);
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
