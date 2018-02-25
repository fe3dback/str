<?php

declare(strict_types=1);

namespace FS\Lib;

class StrCommon
{
    /**
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
     * @param $str
     * @param $check
     * @return string
     */
    final public static function ensureLeft(string $str, string $check): string
    {
        if (self::hasPrefix($str, $check)) {
            return $str;
        }

        return $check . $str;
    }

    /**
     * @param $str
     * @param $check
     * @return string
     */
    final public static function ensureRight(string $str, string $check): string
    {
        if (self::hasSuffix($str, $check)) {
            return $str;
        }

        return $str . $check;
    }

    /**
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

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
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

}