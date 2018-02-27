<?php

declare(strict_types=1);

namespace Str\Lib;

use Str\Str;

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
        if ($old === $new || $limit === 0) { return $str; }

        $oldCount = \mb_substr_count($str, $old);

        if ($oldCount === 0) { return $str; }

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
        if (StrCommon::hasPrefix($str, $check)) { return $str; }

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
        if (StrCommon::hasSuffix($str, $check)) { return $str; }

        return $str . $check;
    }

    /**
     * Pads the string to a given length with $padStr. If length is less than
     * or equal to the length of the string, no padding takes places. The
     * default string used for padding is a space, and the default type (one of
     * 'left', 'right', 'both') is 'right'.
     *
     * @param string $str
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @param  string $padType One of 'left', 'right', 'both'
     * @return string
     */
    final public static function pad(string $str, int $length, string $padStr = ' ', string $padType = 'right'): string
    {
        if (!\in_array($padType, ['left', 'right', 'both'], true)) { return $str; }

        switch ($padType) {
            case 'left':
                return self::padLeft($str, $length, $padStr);
            case 'right':
                return self::padRight($str, $length, $padStr);
            default:
                return self::padBoth($str, $length, $padStr);
        }
    }

    /**
     * Returns a new string of a given length such that both sides of the
     * string are padded. Alias for pad() with a $padType of 'both'.
     *
     * @param string $str
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return static String with padding applied
     */
    final public static function padBoth(string $str, int $length, string $padStr = ' '): string
    {
        $padding = $length - \mb_strlen($str);

        return self::applyPadding($str, (int)floor($padding / 2), (int)ceil($padding / 2), $padStr);
    }

    /**
     * Returns a new string of a given length such that the beginning of the
     * string is padded. Alias for pad() with a $padType of 'left'.
     *
     * @param string $str
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return static String with left padding
     */
    final public static function padLeft(string $str, int $length, string $padStr = ' '): string
    {
        return self::applyPadding($str, $length - \mb_strlen($str), 0, $padStr);
    }

    /**
     * Returns a new string of a given length such that the end of the string
     * is padded. Alias for pad() with a $padType of 'right'.
     *
     * @param string $str
     * @param  int $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return static String with right padding
     */
    final public static function padRight(string $str, int $length, string $padStr = ' '): string
    {
        return self::applyPadding($str, 0, $length - \mb_strlen($str), $padStr);
    }

    /**
     * Adds the specified amount of left and right padding to the given string.
     * The default character used is a space.
     *
     * @param string $str
     * @param  int $left Length of left padding
     * @param  int $right Length of right padding
     * @param  string $padStr String used to pad
     * @return static String with padding applied
     */
    final public static function applyPadding(string $str, int $left = 0, int $right = 0, string $padStr = ' '): string
    {
        $result = $str;
        $length = \mb_strlen($padStr);

        $strLength = \mb_strlen($result);
        $paddedLength = $strLength + $left + $right;

        if (!$length || $paddedLength <= $strLength) { return $result; }

        $leftPadding = \mb_substr(str_repeat($padStr, (int)ceil($left / $length)), 0, $left);
        $rightPadding = \mb_substr(str_repeat($padStr, (int)ceil($right / $length)), 0, $right);

        $result = $leftPadding . $result . $rightPadding;

        return $result;
    }

    /**
     * Inserts $substring into the string at the $index provided.
     *
     * @param string $str
     * @param  string $substring String to be inserted
     * @param  int $index The index at which to insert the substring
     * @return static Object with the resulting $str after the insertion
     */
    final public static function insert(string $str, string $substring, int $index): string
    {
        $result = $str;

        if ($index > \mb_strlen($result)) { return $result; }

        $start = \mb_substr($result, 0, $index);
        $end = \mb_substr($result, $index, \mb_strlen($result));

        $result = $start . $substring . $end;

        return $result;
    }

    /**
     * Returns a new string with the prefix $substring removed, if present.
     *
     * @param string $str
     * @param  string $substring The prefix to remove
     * @return static Object having a $str without the prefix $substring
     */
    final public static function removeLeft(string $str, string $substring): string
    {
        $result = new Str($str);

        if ($result->startsWith($substring)) {
            $substringLength = \mb_strlen($substring);
            return (string)$result->substr($substringLength);
        }

        return (string)$result;
    }

    /**
     * Returns a new string with the suffix $substring removed, if present.
     *
     * @param string $str
     * @param  string $substring The suffix to remove
     * @return static Object having a $str without the suffix $substring
     */
    final public static function removeRight(string $str, string $substring): string
    {
        $result = new Str($str);

        if ($result->endsWith($substring)) {
            $substringLength = \mb_strlen($substring);
            return (string)$result->substr(0, $result->length() - $substringLength);
        }

        return (string)$result;
    }

    /**
     * Returns a repeated string given a multiplier. An alias for str_repeat.
     *
     * @param string $str
     * @param  int $multiplier The number of times to repeat the string
     * @return static Object with a repeated str
     */
    final public static function repeat(string $str, int $multiplier): string
    {
        return str_repeat($str, $multiplier);
    }

    /**
     * Returns a reversed string. A multibyte version of strrev().
     *
     * @param string $str
     * @return static Object with a reversed $str
     */
    final public static function reverse(string $str): string
    {
        $strLength = \mb_strlen($str);
        $reversed = '';

        // Loop from last index of string to first
        for ($i = $strLength - 1; $i >= 0; $i--) {
            $reversed .= \mb_substr($str, $i, 1);
        }

        return $reversed;
    }

    /**
     * A multibyte str_shuffle() function. It returns a string with its
     * characters in random order.
     *
     * @param string $str
     * @return static Object with a shuffled $str
     */
    final public static function shuffle(string $str): string
    {
        $indexes = \range(0, \mb_strlen($str) - 1);
        \shuffle($indexes);

        $shuffledStr = '';
        foreach ($indexes as $i) {
            $shuffledStr .= \mb_substr($str, $i, 1);
        }

        return $shuffledStr;
    }

    /**
     * Returns the substring between $start and $end, if found, or an empty
     * string. An optional offset may be supplied from which to begin the
     * search for the start string.
     *
     * @param string $str
     * @param  string $start Delimiter marking the start of the substring
     * @param  string $end Delimiter marking the end of the substring
     * @param  int $offset Index from which to begin the search
     * @return static Object whose $str is a substring between $start and $end
     */
    final public static function between(string $str, string $start, string $end, int $offset = 0): string
    {
        $string = new Str($str);
        $startIndex = $string->indexOf($start, $offset);

        if ($startIndex === -1) { return ''; }

        $substrIndex = $startIndex + \mb_strlen($start);
        $endIndex = $string->indexOf($end, $substrIndex);

        if ($endIndex === -1) { return ''; }

        if ($endIndex === $substrIndex) { return ''; }

        return (string)$string->substr($substrIndex, $endIndex - $substrIndex);
    }

    /**
     * Returns a camelCase version of the string. Trims surrounding spaces,
     * capitalizes letters following digits, spaces, dashes and underscores,
     * and removes spaces, dashes, as well as underscores.
     *
     * @param string $str
     * @return static Object with $str in camelCase
     */
    final public static function camelize(string $str): string
    {
        $string = new Str($str);
        $string = $string->trim()->lowerCaseFirst();
        $result = (string)$string;
        $result = preg_replace('/^[-_]+/', '', $result);

        $result = preg_replace_callback(
            '/[-_\s]+(.)?/u',
            function ($match) {
                if (isset($match[1])) {
                    return \mb_strtoupper($match[1]);
                }

                return '';
            },
            $result
        );

        $result = preg_replace_callback(
            '/[\d]+(.)?/u',
            function ($match) {
                return \mb_strtoupper($match[0]);
            },
            $result
        );

        return $result;
    }

    /**
     * Converts the first character of the string to lower case.
     *
     * @param string $str
     * @return static Object with the first character of $str being lower case
     */
    final public static function lowerCaseFirst(string $str): string
    {
        $first = \mb_substr($str, 0, 1);
        $rest = \mb_substr($str, 1);

        return \mb_strtolower($first) . $rest;
    }

    /**
     * Converts the first character of the supplied string to upper case.
     *
     * @param string $str
     * @return static Object with the first character of $str being upper case
     */
    final public static function upperCaseFirst(string $str): string
    {
        $first = \mb_substr($str, 0, 1);
        $rest = \mb_substr($str, 1);

        return \mb_strtoupper($first) . $rest;
    }

    /**
     * Trims the string and replaces consecutive whitespace characters with a
     * single space. This includes tabs and newline characters, as well as
     * multibyte whitespace such as the thin space and ideographic space.
     *
     * @param string $str
     * @return static Object with a trimmed $str and condensed whitespace
     */
    final public static function collapseWhitespace(string $str): string
    {
        $result = new Str($str);
        $result->regexReplace('[[:space:]]+', ' ')->trim();

        return (string)$result;
    }

    /**
     * Replaces all occurrences of $pattern in $str by $replacement. An alias
     * for mb_ereg_replace(). Note that the 'i' option with multibyte patterns
     * in mb_ereg_replace() requires PHP 5.6+ for correct results. This is due
     * to a lack of support in the bundled version of Oniguruma in PHP < 5.6,
     * and current versions of HHVM (3.8 and below).
     *
     * @param string $str
     * @param  string $pattern The regular expression pattern
     * @param  string $replacement The string to replace with
     * @param  string $options Matching conditions to be used
     * @return static Object with the resulting $str after the replacements
     */
    final public static function regexReplace(string $str, string $pattern, string $replacement, string $options = 'msr'): string
    {
        $result = $str;
        return \mb_ereg_replace($pattern, $replacement, $result, $options);
    }

    /**
     * Returns a lowercase and trimmed string separated by dashes. Dashes are
     * inserted before uppercase characters (with the exception of the first
     * character of the string), and in place of spaces as well as underscores.
     *
     * @param string $str
     * @return static Object with a dasherized $str
     */
    final public static function dasherize(string $str): string
    {
        return self::delimit($str, '-');
    }

    /**
     * Returns a lowercase and trimmed string separated by the given delimiter.
     * Delimiters are inserted before uppercase characters (with the exception
     * of the first character of the string), and in place of spaces, dashes,
     * and underscores. Alpha delimiters are not converted to lowercase.
     *
     * @param string $str
     * @param  string $delimiter Sequence used to separate parts of the string
     * @return static Object with a delimited $str
     */
    final public static function delimit(string $str, string $delimiter): string
    {
        $result = new Str($str);
        $result = $result
            ->trim()
            ->regexReplace('\B([A-Z])', '-\1')
            ->toLowerCase()
            ->regexReplace('[-_\s]+', $delimiter);

        return (string)$result;
    }
}
