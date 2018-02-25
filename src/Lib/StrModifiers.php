<?php

declare(strict_types=1);

namespace Str\Lib;

class StrModifiers
{

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * Replace returns a copy of the string s with the first
     * n non-overlapping instances of old replaced by new.
     * If old is empty, it matches at the beginning of the string and
     * after each UTF-8 sequence, yielding up to k+1 replacements
     * for a k-rune string. If n < 0,
     * there is no limit on the number of replacements.
     *
     * @param string $str
     * @param string $old
     * @param string $new
     * @param int $limit
     *
     * @return string
     */
    final public static function replace(string $str, string $old, string $new, int $limit = -1): string
    {
        if ($old === $new || $limit === 0) {
            return $str;
        }

        $oldCount = \mb_substr_count($str, $old);
        if ($oldCount === 0) {
            return $str;
        }

        if ($limit < 0 || $oldCount < $limit) {
            $limit = $oldCount;
        }

        $result = $str;
        $offset = 0;
        while (--$limit >= 0) {
            $pos = \mb_strpos($result, $old, $offset);
            $offset = $pos + \mb_strlen($old);
            $result = \mb_substr($result, 0, $pos) . $new . \mb_substr($result, $offset);
        }

        return $result;
    }

    /**
     * Returns a string with whitespace removed from the start and end of the
     * string. Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param  string $str
     * @param  string $chars - Optional string of characters to strip
     * @return string
     */
    final public static function trim(string $str, string $chars = ''): string
    {
        $chars = $chars ? \preg_quote($chars, '/') : '\s';
        return (string)\mb_ereg_replace("^[$chars]+|[$chars]+\$", '', $str);
    }

    /**
     * Returns a string with whitespace removed from the start of the string.
     * Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param  string $str
     * @param  string $chars Optional string of characters to strip
     * @return string
     */
    final public static function trimLeft(string $str, string $chars = ''): string
    {
        $chars = $chars ? \preg_quote($chars, '/') : '\s';
        return (string)\mb_ereg_replace("^[$chars]+", '', $str);
    }

    /**
     * Returns a string with whitespace removed from the end of the string.
     * Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param  string $str
     * @param  string $chars Optional string of characters to strip
     * @return string
     */
    final public static function trimRight(string $str, string $chars = ''): string
    {
        $chars = $chars ? \preg_quote($chars, '/') : '\s';
        return (string)\mb_ereg_replace("[$chars]+\$", '', $str);
    }

    /**
     * Check if prefix exist in string, and
     * prepend prefix to str - if not
     *
     * @param $str
     * @param $check
     * @return string
     */
    final public static function ensureLeft(string $str, string $check): string
    {
        if (StrCommon::hasPrefix($str, $check)) {
            return $str;
        }

        return $check . $str;
    }

    /**
     * Check if suffix exist in string, and
     * append suffix to str - if not.
     *
     * @param $str
     * @param $check
     * @return string
     */
    final public static function ensureRight(string $str, string $check): string
    {
        if (StrCommon::hasSuffix($str, $check)) {
            return $str;
        }

        return $str . $check;
    }
}