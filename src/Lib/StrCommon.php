<?php

declare(strict_types=1);

namespace Str\Lib;

class StrCommon
{
    /**
     * check if string has prefix at the start?
     *
     * @param string $s
     * @param string $prefix
     * @return bool
     */
    final public static function hasPrefix(string $s, string $prefix): bool
    {
        if ($s === '' || $prefix === '') {
            return false;
        }

        return (0 === \mb_strpos($s, $prefix));
    }

    /**
     * check if string has suffix at the end?
     *
     * @param string $s
     * @param string $suffix
     * @return bool
     */
    final public static function hasSuffix(string $s, string $suffix): bool
    {
        if ($s === '' || $suffix === '') {
            return false;
        }

        return \mb_substr($s, -\mb_strlen($suffix)) === $suffix;
    }

    /**
     * Check if $haystack contain $needle substring
     *
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    final public static function contains(string $haystack, string $needle): bool
    {
        if ($haystack === '' || $needle === '') {
            return true;
        }

        return (false !== \mb_strpos($haystack, $needle));
    }

    /**
     * Returns the substring beginning at $start with the specified $length.
     * It differs from the mb_substr() function in that providing a $length of
     * null will return the rest of the string, rather than an empty string.
     *
     * @param  string $s
     * @param  int $start Position of the first character to use
     * @param  int $length Maximum number of characters used
     * @return string
     */
    final public static function substr(string $s, int $start = 0, int $length = 0): string
    {
        $length = !$length ? \mb_strlen($s) : $length;
        return \mb_substr($s, $start, $length);
    }

    /**
     * Returns the character at $pos, with indexes starting at 0.
     *
     * @param string $s
     * @param int $pos
     * @return string
     */
    final public static function at(string $s, int $pos): string
    {
        return self::substr($s, $pos, 1);
    }

    /**
     * Returns an array consisting of the characters in the string.
     *
     * @param string $s
     * @return array An array of string chars
     */
    final public static function chars(string $s): array
    {
        $chars = [];
        for ($i = 0, $iMax = \mb_strlen($s); $i < $iMax; $i++) {
            $chars[] = mb_substr($s, $i, 1);
        }

        return $chars;
    }

    /**
     * Returns the first $length characters of the string.
     *
     * @param string $s String for search
     * @param int $length Number of characters to retrieve from the start
     * @return string
     */
    final public static function first(string $s, int $length): string
    {
        if ($length <= 0) {
            return '';
        }

        return self::substr($s, 0, $length);
    }

    /**
     * Returns the last $length characters of the string.
     *
     * @param string $s String for search
     * @param int $length Number of characters to retrieve from the end
     * @return string
     */
    final public static function last(string $s, int $length): string
    {
        if ($length <= 0) {
            return '';
        }

        return self::substr($s, -$length);
    }

    /**
     * Returns the index of the first occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search.
     *
     * @param  string $haystack
     * @param  string $needle Substring to look for
     * @param  int $offset Offset from which to search
     * @return int The occurrence's index if found, otherwise -1
     */
    final public static function indexOf(string $haystack, string $needle, int $offset = 0): int
    {
        if ($needle === '' || $haystack === '') {
            return -1;
        }

        $maxLen = \mb_strlen($haystack);

        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }

        if ($offset > $maxLen) {
            return -1;
        }

        if ($offset < 0) {
            return -1;
        }

        $pos = \mb_strpos($haystack, $needle, $offset);
        return false === $pos ? -1 : $pos;
    }

    /**
     * Returns the index of the last occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search. Offsets may be negative to count from the last character
     * in the string.
     *
     * @param  string $haystack
     * @param  string $needle Substring to look for
     * @param  int $offset Offset from which to search
     * @return int The last occurrence's index if found, otherwise -1
     */
    final public static function indexOfLast(string $haystack, string $needle, int $offset = 0): int
    {
        if ($needle === '' || $haystack === '') {
            return -1;
        }

        $maxLen = \mb_strlen($haystack);

        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }

        if ($offset > $maxLen) {
            return -1;
        }

        if ($offset < 0) {
            return -1;
        }

        $pos = \mb_strrpos($haystack, $needle, $offset) ?: -1;
        return false === $pos ? -1 : $pos;
    }

    /**
     * Returns the number of occurrences of $substring in the given string.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $haystack
     * @param  string $needle The substring to search for
     * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
     * @return int The number of $substring occurrences
     */
    final public static function countSubstr(string $haystack, string $needle, bool $caseSensitive = true): int
    {
        if ($caseSensitive) {
            return \mb_substr_count($haystack, $needle);
        }

        $haystack = (string)\mb_strtoupper($haystack);
        $needle = (string)\mb_strtoupper($needle);

        return \mb_substr_count($haystack, $needle);
    }
}