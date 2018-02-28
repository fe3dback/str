<?php

declare(strict_types=1);

namespace Str;

use \Str\Lib\StrCommonMB;
use \Str\Lib\StrModifiersMB;

class Str
{
    /** @var string */
    private $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * get result string
     *
     * @return string
     */
    public function getString(): string
    {
        return $this->str;
    }

    /**
     * alias for getString method
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->str;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->str;
    }

    /**
     * Returns the substring beginning at $start with the specified $length.
     * It differs from the mb_substr() function in that providing a $length of
     * null will return the rest of the string, rather than an empty string.
     *
     * @param  int $start Position of the first character to use
     * @param  int $length Maximum number of characters used
     * @return Str
     */
    public function substr(int $start = 0, int $length = 0): Str
    {
        $this->str = StrModifiersMB::substr($this->str, $start, $length);
        return $this;
    }

    /**
     * check if string has prefix at the start?
     *
     * @param string $prefix
     * @return bool
     */
    public function hasPrefix(string $prefix): bool
    {
        return StrCommonMB::hasPrefix($this->str, $prefix);
    }

    /**
     * check if string has suffix at the end?
     *
     * @param string $suffix
     * @return bool
     */
    public function hasSuffix(string $suffix): bool
    {
        return StrCommonMB::hasSuffix($this->str, $suffix);
    }

    /**
     * Check if prefix exist in string, and
     * prepend prefix to str - if not
     *
     * @param string $check
     * @return $this
     */
    public function ensureLeft(string $check): Str
    {
        $this->str = StrModifiersMB::ensureLeft($this->str, $check);
        return $this;
    }

    /**
     * Check if suffix exist in string, and
     * append suffix to str - if not.
     *
     * @param string $check
     * @return $this
     */
    public function ensureRight(string $check): Str
    {
        $this->str = StrModifiersMB::ensureRight($this->str, $check);
        return $this;
    }

    /**
     * Check if $haystack contain $needle substring
     *
     * @param string $sub
     * @return bool
     */
    public function contains(string $sub): bool
    {
        return StrCommonMB::contains($this->str, $sub);
    }

    /**
     * Replace returns a copy of the string s with the first
     * n non-overlapping instances of old replaced by new.
     * If old is empty, it matches at the beginning of the string and
     * after each UTF-8 sequence, yielding up to k+1 replacements
     * for a k-rune string. If n < 0,
     * there is no limit on the number of replacements.
     *
     * @param $old
     * @param $new
     * @param int $times
     * @return $this
     */
    public function replace(string $old, string $new, int $times = -1): Str
    {
        $this->str = StrModifiersMB::replace($this->str, $old, $new, $times);
        return $this;
    }

    /**
     * Make a string lowercase
     * @return Str
     */
    public function toLowerCase(): Str
    {
        $this->str = StrModifiersMB::toLowerCase($this->str);
        return $this;
    }

    /**
     * Make a string uppercase
     * @return Str
     */
    public function toUpperCase(): Str
    {
        $this->str = StrModifiersMB::toUpperCase($this->str);
        return $this;
    }

    /**s
     * Returns a string with whitespace removed from the start and end of the
     * string. Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param string $chars
     * @return Str
     */
    public function trim(string $chars = ''): Str
    {
        $this->str = StrModifiersMB::trim($this->str, $chars);
        return $this;
    }

    /**
     * Returns a string with whitespace removed from the start of the string.
     * Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param  string $chars Optional string of characters to strip
     * @return Str
     */
    public function trimLeft(string $chars = ''): Str
    {
        $this->str = StrModifiersMB::trimLeft($this->str, $chars);
        return $this;
    }

    /**
     * Returns a string with whitespace removed from the end of the string.
     * Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param  string $chars Optional string of characters to strip
     * @return Str
     */
    public function trimRight(string $chars = ''): Str
    {
        $this->str = StrModifiersMB::trimRight($this->str, $chars);
        return $this;
    }

    /**
     * Append $sub to str
     *
     * @param string $sub
     * @return Str
     */
    public function append(string $sub): Str
    {
        $this->str = StrModifiersMB::append($this->str, $sub);
        return $this;
    }

    /**
     * Prepend $sub to str
     *
     * @param string $sub
     * @return Str
     */
    public function prepend(string $sub): Str
    {
        $this->str = StrModifiersMB::prepend($this->str, $sub);
        return $this;
    }

    /**
     * Returns the character at $pos, with indexes starting at 0.
     *
     * @param int $pos
     * @return string
     */
    public function at(int $pos): string
    {
        return StrCommonMB::at($this->str, $pos);
    }

    /**
     * Returns an array consisting of the characters in the string.
     *
     * @return array An array of string chars
     */
    public function chars(): array
    {
        return StrModifiersMB::chars($this->str);
    }

    /**
     * Return string length
     *
     * @return int
     */
    public function length(): int
    {
        return StrCommonMB::length($this->str);
    }

    /**
     * Returns the first $length characters of the string.
     *
     * @param int $length Number of characters to retrieve from the start
     * @return string
     */
    public function first(int $length = 1): string
    {
        return StrModifiersMB::first($this->str, $length);
    }

    /**
     * Returns the last $length characters of the string.
     *
     * @param  int    $length Number of characters to retrieve from the end
     * @return string
     */
    public function last(int $length = 1): string
    {
        return StrModifiersMB::last($this->str, $length);
    }

    /**
     * Returns the index of the first occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search.
     *
     * @param  string $needle Substring to look for
     * @param  int $offset Offset from which to search
     * @return int The occurrence's index if found, otherwise -1
     */
    public function indexOf(string $needle, int $offset = 0): int
    {
        return StrCommonMB::indexOf($this->str, $needle, $offset);
    }

    /**
     * Returns the index of the last occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search. Offsets may be negative to count from the last character
     * in the string.
     *
     * @param  string $needle Substring to look for
     * @param  int $offset Offset from which to search
     * @return int The last occurrence's index if found, otherwise -1
     */
    public function indexOfLast(string $needle, int $offset = 0): int
    {
        return StrCommonMB::indexOfLast($this->str, $needle, $offset);
    }

    /**
     * Returns the number of occurrences of $substring in the given string.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $needle The substring to search for
     * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
     * @return int The number of $substring occurrences
     */
    public function countSubstr(string $needle, bool $caseSensitive = true): int
    {
        return StrCommonMB::countSubstr($this->str, $needle, $caseSensitive);
    }

    /**
     * Returns true if the string contains all $needles, false otherwise. By
     * default the comparison is case-sensitive, but can be made insensitive by
     * setting $caseSensitive to false.
     *
     * @param  string[] $needles Substrings to look for
     * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool     Whether or not $str contains $needle
     */
    public function containsAll(array $needles, bool $caseSensitive = true): bool
    {
        return StrCommonMB::containsAll($this->str, $needles, $caseSensitive);
    }

    /**
     * Returns true if the string contains any $needles, false otherwise. By
     * default the comparison is case-sensitive, but can be made insensitive by
     * setting $caseSensitive to false.
     *
     * @param  string[] $needles       Substrings to look for
     * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool     Whether or not $str contains $needle
     */
    public function containsAny(array $needles, bool $caseSensitive = true): bool
    {
        return StrCommonMB::containsAny($this->str, $needles, $caseSensitive);
    }

    /**
     * Returns true if the string begins with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $substring     The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce
     *                               case-sensitivity
     * @return bool   Whether or not $str starts with $substring
     */
    public function startsWith(string $substring, bool $caseSensitive = true): bool
    {
        return StrCommonMB::startsWith($this->str, $substring, $caseSensitive);
    }

    /**
     * Returns true if the string begins with any of $substrings, false
     * otherwise. By default the comparison is case-sensitive, but can be made
     * insensitive by setting $caseSensitive to false.
     *
     * @param  string[] $substrings    Substrings to look for
     * @param  bool     $caseSensitive Whether or not to enforce
     *                                 case-sensitivity
     * @return bool     Whether or not $str starts with $substring
     */
    public function startsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        return StrCommonMB::startsWithAny($this->str, $substrings, $caseSensitive);
    }

    /**
     * Returns true if the string ends with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $substring     The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool   Whether or not $str ends with $substring
     */
    public function endsWith(string $substring, bool $caseSensitive = true): bool
    {
        return StrCommonMB::endsWith($this->str, $substring, $caseSensitive);
    }

    /**
     * Returns true if the string ends with any of $substrings, false otherwise.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string[] $substrings    Substrings to look for
     * @param  bool     $caseSensitive Whether or not to enforce
     *                                 case-sensitivity
     * @return bool     Whether or not $str ends with $substring
     */
    public function endsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        return StrCommonMB::endsWithAny($this->str, $substrings, $caseSensitive);
    }

    /**
     * Pads the string to a given length with $padStr. If length is less than
     * or equal to the length of the string, no padding takes places. The
     * default string used for padding is a space, and the default type (one of
     * 'left', 'right', 'both') is 'right'.
     *
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @param  string $padType One of 'left', 'right', 'both'
     * @return Str
     */
    public function pad(int $length, string $padStr = ' ', string $padType = 'right'): Str
    {
        $this->str = StrModifiersMB::pad($this->str, $length, $padStr, $padType);
        return $this;
    }

    /**
     * Returns a new string of a given length such that both sides of the
     * string are padded. Alias for pad() with a $padType of 'both'.
     *
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return static Str with padding applied
     */
    public function padBoth(int $length, string $padStr = ' '): Str
    {
        $padding = $length - \mb_strlen($this->str);

        $this->str = StrModifiersMB::applyPadding($this->str, (int)floor($padding / 2), (int)ceil($padding / 2),
            $padStr);

        return $this;
    }

    /**
     * Returns a new string of a given length such that the beginning of the
     * string is padded. Alias for pad() with a $padType of 'left'.
     *
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return static Str with left padding
     */
    public function padLeft(int $length, string $padStr = ' '): Str
    {
        $this->str = StrModifiersMB::applyPadding($this->str, $length - \mb_strlen($this->str), 0, $padStr);
        return $this;
    }

    /**
     * Returns a new string of a given length such that the end of the string
     * is padded. Alias for pad() with a $padType of 'right'.
     *
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return static Str with right padding
     */
    public function padRight(int $length, string $padStr = ' '): Str
    {
        $this->str = StrModifiersMB::applyPadding($this->str, 0, $length - \mb_strlen($this->str), $padStr);
        return $this;
    }

    /**
     * Inserts $substring into the string at the $index provided.
     *
     * @param  string $substring String to be inserted
     * @param  int    $index     The index at which to insert the substring
     * @return static Object with the resulting $str after the insertion
     */
    public function insert(string $substring, int $index): Str
    {
        $this->str = StrModifiersMB::insert($this->str, $substring, $index);
        return $this;
    }

    /**
     * Returns a new string with the prefix $substring removed, if present.
     *
     * @param  string $substring The prefix to remove
     * @return static Object having a $str without the prefix $substring
     */
    public function removeLeft(string $substring): Str
    {
        $this->str = StrModifiersMB::removeLeft($this->str, $substring);
        return $this;
    }

    /**
     * Returns a new string with the suffix $substring removed, if present.
     *
     * @param  string $substring The suffix to remove
     * @return static Object having a $str without the suffix $substring
     */
    public function removeRight(string $substring): Str
    {
        $this->str = StrModifiersMB::removeRight($this->str, $substring);
        return $this;
    }

    /**
     * Returns a repeated string given a multiplier. An alias for str_repeat.
     *
     * @param  int    $multiplier The number of times to repeat the string
     * @return static Object with a repeated str
     */
    public function repeat(int $multiplier): Str
    {
        $this->str = StrModifiersMB::repeat($this->str, $multiplier);
        return $this;
    }

    /**
     * Returns a reversed string. A multibyte version of strrev().
     *
     * @return static Object with a reversed $str
     */
    public function reverse(): Str
    {
        $this->str = StrModifiersMB::reverse($this->str);
        return $this;
    }

    /**
     * A multibyte str_shuffle() function. It returns a string with its
     * characters in random order.
     *
     * @return static Object with a shuffled $str
     */
    public function shuffle(): Str
    {
        $this->str = StrModifiersMB::shuffle($this->str);
        return $this;
    }

    /**
     * Returns the substring between $start and $end, if found, or an empty
     * string. An optional offset may be supplied from which to begin the
     * search for the start string.
     *
     * @param  string $start  Delimiter marking the start of the substring
     * @param  string $end    Delimiter marking the end of the substring
     * @param  int    $offset Index from which to begin the search
     * @return static Object whose $str is a substring between $start and $end
     */
    public function between(string $start, string $end, int $offset = 0): Str
    {
        $this->str = StrModifiersMB::between($this->str, $start, $end, $offset);
        return $this;
    }

    /**
     * Returns a camelCase version of the string. Trims surrounding spaces,
     * capitalizes letters following digits, spaces, dashes and underscores,
     * and removes spaces, dashes, as well as underscores.
     *
     * @return static Object with $str in camelCase
     */
    public function camelize(): Str
    {
        $this->str = StrModifiersMB::camelize($this->str);
        return $this;
    }

    /**
     * Converts the first character of the string to lower case.
     *
     * @return static Object with the first character of $str being lower case
     */
    public function lowerCaseFirst(): Str
    {
        $this->str = StrModifiersMB::lowerCaseFirst($this->str);
        return $this;
    }

    /**
     * Converts the first character of the supplied string to upper case.
     *
     * @return static Object with the first character of $str being upper case
     */
    public function upperCaseFirst(): Str
    {
        $this->str = StrModifiersMB::upperCaseFirst($this->str);
        return $this;
    }

    /**
     * Trims the string and replaces consecutive whitespace characters with a
     * single space. This includes tabs and newline characters, as well as
     * multibyte whitespace such as the thin space and ideographic space.
     *
     * @return static Object with a trimmed $str and condensed whitespace
     */
    public function collapseWhitespace(): Str
    {
        $this->str = StrModifiersMB::collapseWhitespace($this->str);
        return $this;
    }

    /**
     * Replaces all occurrences of $pattern in $str by $replacement. An alias
     * for mb_ereg_replace(). Note that the 'i' option with multibyte patterns
     * in mb_ereg_replace() requires PHP 5.6+ for correct results. This is due
     * to a lack of support in the bundled version of Oniguruma in PHP < 5.6,
     * and current versions of HHVM (3.8 and below).
     *
     * @param  string $pattern The regular expression pattern
     * @param  string $replacement The string to replace with
     * @param  string $options Matching conditions to be used
     * @return static Object with the resulting $str after the replacements
     */
    public function regexReplace(string $pattern, string $replacement, string $options = 'msr'): Str
    {
        $this->str = StrModifiersMB::regexReplace($this->str, $pattern, $replacement, $options);
        return $this;
    }

    /**
     * Returns a lowercase and trimmed string separated by dashes. Dashes are
     * inserted before uppercase characters (with the exception of the first
     * character of the string), and in place of spaces as well as underscores.
     *
     * @return static Object with a dasherized $str
     */
    public function dasherize(): Str
    {
        $this->str = StrModifiersMB::dasherize($this->str);
        return $this;
    }

    /**
     * Returns a lowercase and trimmed string separated by the given delimiter.
     * Delimiters are inserted before uppercase characters (with the exception
     * of the first character of the string), and in place of spaces, dashes,
     * and underscores. Alpha delimiters are not converted to lowercase.
     *
     * @param  string $delimiter Sequence used to separate parts of the string
     * @return static Object with a delimited $str
     */
    public function delimit($delimiter): Str
    {
        $this->str = StrModifiersMB::delimit($this->str, $delimiter);
        return $this;
    }

    /** Checks if the given string is a valid UUID v.4
     * It doesn't matter whether the given UUID has dashes
     *
     * @return bool
     */
    public function isUUIDv4(): bool
    {
        return StrCommonMB::isUUIDv4($this->str);
    }
}
