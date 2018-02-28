<?php

declare(strict_types=1);

namespace Str\Lib;

use Str\Str;

class StrModifiersMB
{
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
        if ($length <= 0) { return ''; }

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
        if ($length <= 0) { return ''; }

        return self::substr($s, -$length);
    }

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
     * Append $sub to str
     *
     * @param string $str
     * @param string $sub
     * @return Str
     */
    final public static function append(string $str, string $sub): string
    {
        $result = $str;
        return $result . $sub;
    }

    /**
     * Prepend $sub to str
     *
     * @param string $str
     * @param string $sub
     * @return Str
     */
    final public static function prepend(string $str, string $sub): string
    {
        $result = $str;
        return $sub . $result;
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
        if (StrCommonMB::hasPrefix($str, $check)) { return $str; }

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
        if (StrCommonMB::hasSuffix($str, $check)) { return $str; }

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
        $result = $str;

        if (StrCommonMB::startsWith($result, $substring)) {
            $substringLength = \mb_strlen($substring);
            return self::substr($result, $substringLength);
        }

        return $result;
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
        $result = $str;

        if (StrCommonMB::endsWith($result, $substring)) {
            return self::substr($result, 0, \mb_strlen($result) - \mb_strlen($substring));
        }

        return $result;
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
        $string = $str;
        $startIndex = StrCommonMB::indexOf($string, $start, $offset);

        if ($startIndex === -1) { return ''; }

        $substrIndex = $startIndex + \mb_strlen($start);
        $endIndex = StrCommonMB::indexOf($string, $end, $substrIndex);

        if ($endIndex === -1) { return ''; }

        if ($endIndex === $substrIndex) { return ''; }

        return self::substr($string, $substrIndex, $endIndex - $substrIndex);
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
        $string = $str;
        $string = self::trim($string);
        $string = self::lowerCaseFirst($string);
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
     * Make a string lowercase
     * @param string $str
     * @return Str
     */
    final public static function toLowerCase(string $str): string
    {
        $result = $str;
        return \mb_strtolower($result);
    }

    /**
     * Make a string uppercase
     * @param string $str
     * @return Str
     */
    final public static function toUpperCase(string $str): string
    {
        $result = $str;
        return \mb_strtoupper($result);
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
        $result = $str;
        $result = self::regexReplace($result, '[[:space:]]+', ' ');

        return self::trim($result);
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
        $result = $str;
        $result = self::trim($result);
        $result = self::regexReplace($result, '\B([A-Z])', '-\1');
        $result = self::toLowerCase($result);

        return self::regexReplace($result, '[-_\s]+', $delimiter);
    }

    /**
     * Convert all HTML entities to their applicable characters. An alias of
     * html_entity_decode. For a list of flags, refer to
     * http://php.net/manual/en/function.html-entity-decode.php
     *
     * @param string $str
     * @param  int|null $flags Optional flags
     * @return static   Object with the resulting $str after being html decoded.
     */
    final public static function htmlDecode(string $str, int $flags = ENT_COMPAT): string
    {
        $result = $str;

        return \html_entity_decode($result, $flags);
    }

    /**
     * Convert all applicable characters to HTML entities. An alias of
     * htmlentities. Refer to http://php.net/manual/en/function.htmlentities.php
     * for a list of flags.
     *
     * @param string $str
     * @param  int|null $flags Optional flags
     * @return static   Object with the resulting $str after being html encoded.
     */
    final public static function htmlEncode(string $str, int $flags = ENT_COMPAT): string
    {
        $result = $str;

        return \htmlentities($result, $flags);
    }

    /**
     * Capitalizes the first word of the string, replaces underscores with
     * spaces, and strips '_id'.
     *
     * @param string $str
     * @return static Object with a humanized $str
     */
    final public static function humanize(string $str): string
    {
        $result = $str;
        $result = str_replace(['_id', '_'], ['', ' '], $result);
        $result = self::trim($result);

        return self::upperCaseFirst($result);
    }

    /**
     * Splits on newlines and carriage returns, returning an array of Stringy
     * objects corresponding to the lines in the string.
     *
     * @param string $str
     * @return static[] An array of Stringy objects
     */
    final public static function lines(string $str): array
    {
        $result = $str;

        return self::split($result, '[\r\n]{1,2}');
    }

    /**
     * Splits the string with the provided regular expression, returning an
     * array of Stringy objects. An optional integer $limit will truncate the
     * results.
     *
     * @param string $str
     * @param  string $pattern The regex with which to split the string
     * @param  int $limit Optional maximum number of results to return
     * @return static[] An array of Stringy objects
     */
    final public static function split(string $str, string $pattern, int $limit = -1): array
    {
        $innerStr = $str;
        if (0 === $limit || '' === $innerStr) { return []; }

        // mb_split errors when supplied an empty pattern in < PHP 5.4.13
        // and HHVM < 3.8
        if ($pattern === '') { return [new Str($innerStr)]; }

        // mb_split returns the remaining unsplit string in the last index when
        // supplying a limit
        $limit = ($limit > 0) ? $limit + 1 : -1;

        $array = \mb_split($pattern, $innerStr, $limit);
        $arrLen = \count($array);

        if ($limit > 0 && $arrLen === $limit) {
            array_pop($array);
        }

        $result = [];
        foreach ($array as $string) {
            $result[] = new Str($string);
        }

        return $result;
    }

    /**
     * Returns the longest common prefix between the string and $otherStr.
     *
     * @param string $str
     * @param  string $otherStr Second string for comparison
     * @return static Object with its $str being the longest common prefix
     */
    final public static function longestCommonPrefix(string $str, string $otherStr): string
    {
        $innerStr = $str;
        $maxLength = min(\mb_strlen($innerStr), \mb_strlen($otherStr));

        $longestCommonPrefix = '';

        for ($i = 0; $i < $maxLength; $i++) {
            $char = \mb_substr($innerStr, $i, 1);

            if ($char === \mb_substr($otherStr, $i, 1)) {
                $longestCommonPrefix .= $char;
            } else { break; }
        }

        return $longestCommonPrefix;
    }

    /**
     * Returns the longest common suffix between the string and $otherStr.
     *
     * @param string $str
     * @param  string $otherStr Second string for comparison
     * @return static Object with its $str being the longest common suffix
     */
    final public static function longestCommonSuffix(string $str, string $otherStr): string
    {
        $innerStr = $str;
        $maxLength = min(\mb_strlen($innerStr), \mb_strlen($otherStr));

        $longestCommonSuffix = '';

        for ($i = 1; $i <= $maxLength; $i++) {
            $char = \mb_substr($innerStr, -$i, 1);

            if ($char === \mb_substr($otherStr, -$i, 1)) {
                $longestCommonSuffix = $char . $longestCommonSuffix;
            } else { break; }
        }

        return $longestCommonSuffix;
    }

    /**
     * Returns the longest common substring between the string and $otherStr.
     * In the case of ties, it returns that which occurs first.
     *
     * @param string $str
     * @param  string $otherStr Second string for comparison
     * @return static Object with its $str being the longest common substring
     */
    final public static function longestCommonSubstring(string $str, string $otherStr): string
    {
        $innerStr = $str;

        // Uses dynamic programming to solve
        // http://en.wikipedia.org/wiki/Longest_common_substring_problem
        $strLength = \mb_strlen($innerStr);
        $otherLength = \mb_strlen($otherStr);

        // Return if either string is empty
        if ($strLength === 0 || $otherLength === 0) {
            $innerStr = '';
            return $innerStr;
        }

        $len = 0;
        $end = 0;
        $table = array_fill(0, $strLength + 1,
            array_fill(0, $otherLength + 1, 0));

        for ($i = 1; $i <= $strLength; $i++) {
            for ($j = 1; $j <= $otherLength; $j++) {
                $strChar = \mb_substr($innerStr, $i - 1, 1);
                $otherChar = \mb_substr($otherStr, $j - 1, 1);

                if ($strChar === $otherChar) {
                    $table[$i][$j] = $table[$i - 1][$j - 1] + 1;
                    if ($table[$i][$j] > $len) {
                        $len = $table[$i][$j];
                        $end = $i;
                    }
                } else {
                    $table[$i][$j] = 0;
                }
            }
        }

        $innerStr = \mb_substr($innerStr, $end - $len, $len);

        return $innerStr;
    }

    /**
     * Truncates the string to a given length, while ensuring that it does not
     * split words. If $substring is provided, and truncating occurs, the
     * string is further truncated so that the substring may be appended without
     * exceeding the desired length.
     *
     * @param string $str
     * @param  int $length Desired length of the truncated string
     * @param  string $substring The substring to append if it can fit
     * @return static Object with the resulting $str after truncating
     */
    final public static function safeTruncate(string $str, int $length, string $substring = ''): string
    {
        $innerStr = $str;
        if ($length >= \mb_strlen($innerStr)) {
            return $innerStr;
        }

        // Need to further trim the string so we can append the substring
        $substringLength = \mb_strlen($substring);
        $length -= $substringLength;

        $truncated = \mb_substr($innerStr, 0, $length);

        // If the last word was truncated
        if (\mb_strpos($innerStr, ' ', $length - 1) !== $length) {
            // Find pos of the last occurrence of a space, get up to that
            $lastPos = \mb_strrpos($truncated, ' ', 0);
            if ($lastPos !== false) {
                $truncated = \mb_substr($truncated, 0, $lastPos);
            }
        }

        $innerStr = $truncated . $substring;

        return $innerStr;
    }

    /**
     * Converts the string into an URL slug. This includes replacing non-ASCII
     * characters with their closest ASCII equivalents, removing remaining
     * non-ASCII and non-alphanumeric characters, and replacing whitespace with
     * $replacement. The replacement defaults to a single dash, and the string
     * is also converted to lowercase. The language of the source string can
     * also be supplied for language-specific transliteration.
     *
     * @param string $str
     * @param  string $replacement The string used to replace whitespace
     * @param  string $language Language of the source string
     * @return static Object whose $str has been converted to an URL slug
     */
    final public static function slugify(string $str, string $replacement = '-', string $language = 'en'): string
    {
        $innerStr = self::toAscii($str, $language);

        $innerStr = \str_replace('@', $replacement, $innerStr);
        $quotedReplacement = \preg_quote($replacement, '');
        $pattern = "/[^a-zA-Z\d\s-_$quotedReplacement]/u";
        $innerStr = \preg_replace($pattern, '', $innerStr);

        $innerStr = self::toLowerCase($innerStr);
        $innerStr = self::delimit($innerStr, $replacement);
        $innerStr = self::removeLeft($innerStr, $replacement);

        return self::removeRight($innerStr, $replacement);
    }

    /**
     * Returns an ASCII version of the string. A set of non-ASCII characters are
     * replaced with their closest ASCII counterparts, and the rest are removed
     * by default. The language or locale of the source string can be supplied
     * for language-specific transliteration in any of the following formats:
     * en, en_GB, or en-GB. For example, passing "de" results in "äöü" mapping
     * to "aeoeue" rather than "aou" as in other languages.
     *
     * @param string $str
     * @param  string $language Language of the source string
     * @param  bool $removeUnsupported Whether or not to remove the
     *                                    unsupported characters
     * @return string Object whose $str contains only ASCII characters
     */
    final public static function toAscii(string $str, string $language = 'en', bool $removeUnsupported = true): string
    {
        $innerStr = $str;

        $langSpecific = StrCommonMB::langSpecificCharsArray($language);

        if (!empty($langSpecific)) {
            $innerStr = \str_replace($langSpecific[0], $langSpecific[1], $innerStr);
        }

        // @todo optimize
        foreach (StrCommonMB::charsArray() as $key => $value) {
            foreach ($value as $item) {
                $innerStr = self::replace($innerStr, $item, (string)$key);
            }
        }

        if ($removeUnsupported) {
            $innerStr = \preg_replace('/[^\x20-\x7E]/', '', $innerStr);
        }

        return $innerStr;
    }

    /**
     * Returns the substring beginning at $start, and up to, but not including
     * the index specified by $end. If $end is omitted, the function extracts
     * the remaining string. If $end is negative, it is computed from the end
     * of the string.
     *
     * @param string $str
     * @param  int $start Initial index from which to begin extraction
     * @param  int $end Optional index at which to end extraction
     * @return static Object with its $str being the extracted substring
     */
    final public static function slice(string $str, int $start, int $end = null): string
    {
        $innerStr = $str;

        if ($end === null) {
            $length = \mb_strlen($innerStr);
        }
        elseif ($end >= 0 && $end <= $start) {
            return '';
        }
        elseif ($end < 0) {
            $length = \mb_strlen($innerStr) + $end - $start;
        }
        else {
            $length = $end - $start;
        }

        return self::substr($innerStr, $start, $length);
    }

    /**
     * Strip all whitespace characters. This includes tabs and newline
     * characters, as well as multibyte whitespace such as the thin space
     * and ideographic space.
     *
     * @param string $str
     * @return static Object with whitespace stripped
     */
    final public static function stripWhitespace(string $str): string
    {
        $innerStr = $str;
        return self::regexReplace($innerStr, '[[:space:]]+', '');
    }

    /**
     * Truncates the string to a given length. If $substring is provided, and
     * truncating occurs, the string is further truncated so that the substring
     * may be appended without exceeding the desired length.
     *
     * @param string $str
     * @param  int $length Desired length of the truncated string
     * @param  string $substring The substring to append if it can fit
     * @return static Object with the resulting $str after truncating
     */
    final public static function truncate(string $str, int $length, string $substring = ''): string
    {
        $innerStr = $str;
        if ($length >= \mb_strlen($innerStr)) {
            return $innerStr;
        }

        // Need to further trim the string so we can append the substring
        $substringLength = \mb_strlen($substring);
        $length -= $substringLength;

        $truncated = \mb_substr($innerStr, 0, $length);
        $innerStr = $truncated . $substring;

        return $innerStr;
    }

    /**
     * Returns an UpperCamelCase version of the supplied string. It trims
     * surrounding spaces, capitalizes letters following digits, spaces, dashes
     * and underscores, and removes spaces, dashes, underscores.
     *
     * @param string $str
     * @return static Object with $str in UpperCamelCase
     */
    final public static function upperCamelize(string $str): string
    {
        $innerStr = $str;
        $innerStr = self::camelize($innerStr);

        return self::upperCaseFirst($innerStr);
    }
}
