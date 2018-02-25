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
}