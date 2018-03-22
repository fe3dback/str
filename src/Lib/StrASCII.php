<?php

declare(strict_types=1);

namespace Str\Lib;

/**
 * Check if the string has $prefix at the start.
 *
 * @param  string $s
 * @param  string $prefix
 * @return bool
 */
function libstr_ascii_hasPrefix(string $s, string $prefix): bool
{
    if ($s === '' || $prefix === '') { return false; }

    return (0 === \strpos($s, $prefix));
}

/**
 * Check if the string has $suffix at the end.
 *
 * @param  string $s
 * @param  string $suffix
 * @return bool
 */
function libstr_ascii_hasSuffix(string $s, string $suffix): bool
{
    if ($s === '' || $suffix === '') { return false; }

    return \substr($s, -\strlen($suffix)) === $suffix;
}

/**
 * Return string length
 *
 * @param  string $str
 * @return int
 */
function libstr_ascii_length(string $str): int
{
    return \strlen($str);
}

/**
 * Check if $haystack contains $needle substring.
 *
 * @param  string $haystack
 * @param  string $needle
 * @param  bool $caseSensitive
 * @return bool
 */
function libstr_ascii_contains(string $haystack, string $needle, bool $caseSensitive = true): bool
{
    if ($haystack === '' || $needle === '') { return false; }

    if ($caseSensitive) {
        return false !== \strpos($haystack, $needle);
    }

    return (false !== \stripos($haystack, $needle));
}

/**
 * Returns the index of the first occurrence of $needle in the string,
 * and -1 if not found. Accepts an optional offset from which to begin
 * the search.
 *
 * @param  string $haystack
 * @param  string $needle Substring to look for
 * @param  int $offset Offset from which to search
 * @return int The occurrence's index if found, otherwise -1
 */
function libstr_ascii_indexOf(string $haystack, string $needle, int $offset = 0): int
{
    if ($needle === '' || $haystack === '')  { return -1; }

    $maxLen = \strlen($haystack);

    if ($offset < 0) {
        $offset = $maxLen - (int)abs($offset);
    }

    if ($offset > $maxLen)  { return -1; }

    if ($offset < 0)  { return -1; }

    $pos = \strpos($haystack, $needle, $offset);

    return false === $pos ? -1 : $pos;
}

/**
 * Returns the index of the last occurrence of $needle in the string,
 * and -1 if not found. Accepts an optional offset from which to begin
 * the search. Offsets may be negative to count from the last character
 * in the string.
 *
 * @param  string $haystack
 * @param  string $needle Substring to look for
 * @param  int $offset Offset from which to search
 * @return int The last occurrence's index if found, otherwise -1
 */
function libstr_ascii_indexOfLast(string $haystack, string $needle, int $offset = 0): int
{
    if ($needle === '' || $haystack === '') { return -1; }

    $maxLen = \strlen($haystack);

    if ($offset < 0) {
        $offset = $maxLen - (int)abs($offset);
    }

    if ($offset > $maxLen) { return -1; }

    if ($offset < 0) { return -1; }

    $pos = \strrpos($haystack, $needle, $offset);

    return false === $pos ? -1 : $pos;
}

/**
 * Returns the number of occurrences of $substring in the given string.
 * By default, the comparison is case-sensitive, but can be made insensitive
 * by setting $caseSensitive to false.
 *
 * @param  string $haystack
 * @param  string $needle        The substring to search for
 * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
 * @return int                   The number of $substring occurrences
 */
function libstr_ascii_countSubstr(string $haystack, string $needle, bool $caseSensitive = true): int
{
    if ($caseSensitive) {
        return \substr_count($haystack, $needle);
    }

    $haystack = \strtoupper($haystack);
    $needle = \strtoupper($needle);

    return \substr_count($haystack, $needle);
}

/**
 * Returns true if the string contains all $needles, false otherwise. By
 * default the comparison is case-sensitive, but can be made insensitive by
 * setting $caseSensitive to false.
 *
 * @param  string   $str
 * @param  string[] $needles       Substrings to look for
 * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
 * @return bool                    Whether or not $str contains $needle
 */
function libstr_ascii_containsAll(string $str, array $needles, bool $caseSensitive = true): bool
{
    if (empty($needles)) { return false; }

    foreach ($needles as $needle) {
        if (!libstr_ascii_contains($str, $needle, $caseSensitive)) { return false; }
    }

    return true;
}

/**
 * Returns true if the string contains any $needles, false otherwise. By
 * default the comparison is case-sensitive, but can be made insensitive by
 * setting $caseSensitive to false.
 *
 * @param  string   $str
 * @param  string[] $needles       Substrings to look for
 * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
 * @return bool                    Whether or not $str contains $needle
 */
function libstr_ascii_containsAny(string $str, array $needles, bool $caseSensitive = true): bool
{
    if (empty($needles)) { return false; }

    foreach ($needles as $needle) {
        if (libstr_ascii_contains($str, $needle, $caseSensitive)) { return true; }
    }

    return false;
}

/**
 * Returns true if the string begins with $substring, false otherwise. By
 * default, the comparison is case-sensitive, but can be made insensitive
 * by setting $caseSensitive to false.
 *
 * @param  string $str
 * @param  string $substring     The substring to look for
 * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
 * @return bool                  Whether or not $str starts with $substring
 */
function libstr_ascii_startsWith(string $str, string $substring, bool $caseSensitive = true): bool
{
    if ($caseSensitive) {
        return libstr_ascii_hasPrefix($str, $substring);
    }

    return libstr_ascii_hasPrefix(\strtoupper($str), \strtoupper($substring));
}

/**
 * Returns true if the string begins with any of $substrings, false
 * otherwise. By default the comparison is case-sensitive, but can be made
 * insensitive by setting $caseSensitive to false.
 *
 * @param  string   $str
 * @param  string[] $substrings    Substrings to look for
 * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
 * @return bool                    Whether or not $str starts with $substring
 */
function libstr_ascii_startsWithAny(string $str, array $substrings, bool $caseSensitive = true): bool
{
    if (empty($substrings)) { return false; }

    foreach ($substrings as $substring) {
        if (libstr_ascii_startsWith($str, $substring, $caseSensitive)) { return true; }
    }

    return false;
}

/**
 * Returns true if the string ends with $substring, false otherwise. By
 * default, the comparison is case-sensitive, but can be made insensitive
 * by setting $caseSensitive to false.
 *
 * @param  string $str
 * @param  string $substring     The substring to look for
 * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
 * @return bool                  Whether or not $str ends with $substring
 */
function libstr_ascii_endsWith(string $str, string $substring, bool $caseSensitive = true): bool
{
    if ($caseSensitive) {
        return libstr_ascii_hasSuffix($str, $substring);
    }

    return libstr_ascii_hasSuffix(\mb_strtoupper($str), \mb_strtoupper($substring));
}

/**
 * Returns true if the string ends with any of $substrings, false otherwise.
 * By default, the comparison is case-sensitive, but can be made insensitive
 * by setting $caseSensitive to false.
 *
 * @param  string   $str
 * @param  string[] $substrings    Substrings to look for
 * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
 * @return bool                    Whether or not $str ends with $substring
 */
function libstr_ascii_endsWithAny(string $str, array $substrings, bool $caseSensitive = true): bool
{
    if (empty($substrings)) { return false; }

    foreach ($substrings as $substring) {
        if (libstr_ascii_endsWith($str, $substring, $caseSensitive)) { return true; }
    }

    return false;
}

/**
 * Checks if the given string is a valid UUID v.4.
 * It doesn't matter whether the given UUID has dashes.
 *
 * @param  string $str
 * @return bool
 */
function libstr_ascii_isUUIDv4(string $str): bool
{
    $l = '[a-f0-9]';
    $pattern = "/^{$l}{8}-?{$l}{4}-?4{$l}{3}-?[89ab]{$l}{3}-?{$l}{12}\Z/";
    return (bool)\preg_match($pattern, $str);
}

/**
 * Returns true if the string contains a lower case char, false otherwise.
 * This function check only ascii [a-z] chars.
 *
 * @param  string $str
 * @return bool
 */
function libstr_ascii_hasLowerCase(string $str): bool
{
    return libstr_ascii_matchesPattern($str, '.*[[:lower:]]');
}

/**
 * Returns true if the string contains an upper case char, false otherwise.
 * This function check only ascii [A-Z] chars.
 *
 * @param  string $str
 * @return bool
 */
function libstr_ascii_hasUpperCase(string $str): bool
{
    return libstr_ascii_matchesPattern($str, '.*[[:upper:]]');
}

/**
 * Returns true if $str matches the supplied pattern, false otherwise.
 *
 * @param  string $str
 * @param  string $pattern Regex pattern to match against
 * @return bool            Whether or not $str matches the pattern
 */
function libstr_ascii_matchesPattern(string $str, string $pattern): bool
{
    return (bool)\preg_match($pattern, $str);
}

/**
 * Returns true if the string contains only alphabetic chars, false otherwise.
 * This function check only ascii [a-zA-Z] chars.
 *
 * @param  string $str
 * @return bool   Whether or not $str contains only alphabetic chars
 */
function libstr_ascii_isAlpha(string $str): bool
{
    return libstr_ascii_matchesPattern($str,'^[[:alpha:]]*$');
}

/**
 * Returns true if the string contains only alphabetic and numeric chars, false otherwise.
 * This function check only ascii [a-zA-Z0-9] chars.
 *
 * @param  string $str
 * @return bool   Whether or not $str contains only alphanumeric chars
 */
function libstr_ascii_isAlphanumeric(string $str): bool
{
    return libstr_ascii_matchesPattern($str,'^[[:alnum:]]*$');
}

/**
 * Returns true if the string contains only whitespace chars, false otherwise.
 *
 * @param  string $str
 * @return bool   Whether or not $str contains only whitespace characters
 */
function libstr_ascii_isBlank(string $str): bool
{
    return libstr_ascii_matchesPattern($str,'^[[:space:]]*$');
}

/**
 * Returns true if the string is base64 encoded, false otherwise.
 *
 * @param  string $str
 * @return bool   Whether or not $str is base64 encoded
 */
function libstr_ascii_isBase64(string $str): bool
{
    return (base64_encode(base64_decode($str)) === $str);
}

/**
 * Returns true if the string contains only hexadecimal chars, false otherwise.
 * This function check only ascii [A-Fa-f0-9] chars.
 *
 * @param  string $str
 * @return bool   Whether or not $str contains only hexadecimal chars
 */
function libstr_ascii_isHexadecimal(string $str): bool
{
    return libstr_ascii_matchesPattern($str,'^[[:xdigit:]]*$');
}

/**
 * Returns true if the string is JSON, false otherwise. Unlike json_decode
 * in PHP 5.x, this method is consistent with PHP 7 and other JSON parsers,
 * in that an empty string is not considered valid JSON.
 *
 * @param  string $str
 * @return bool   Whether or not $str is JSON
 */
function libstr_ascii_isJson(string $str): bool
{
    if ('' === $str) { return false; }

    json_decode($str);
    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * Returns true if the string contains only lower case chars, false  otherwise.
 * This function check only ascii [a-z] chars.
 *
 * @param  string $str
 * @return bool   Whether or not $str contains only lower case characters
 */
function libstr_ascii_isLowerCase(string $str): bool
{
    return libstr_ascii_matchesPattern($str, '^[[:lower:]]*$');
}

/**
 * Returns true if the string contains only lower case chars, false otherwise.
 * This function check only ascii [A-Z] chars.
 *
 * @param  string $str
 * @return bool   Whether or not $str contains only lower case characters
 */
function libstr_ascii_isUpperCase(string $str): bool
{
    return libstr_ascii_matchesPattern($str,'^[[:upper:]]*$');
}

/**
 * Returns true if the string is serialized, false otherwise.
 *
 * @param  string $str
 * @return bool   Whether or not $str is serialized
 */
function libstr_ascii_isSerialized(string $str): bool
{
    return $str === 'b:0;' || @unserialize($str, []) !== false;
}

/**
 * Returns a boolean representation of the given logical string value.
 * For example, 'true', '1', 'on' and 'yes' will return true. 'false', '0',
 * 'off', and 'no' will return false. In all instances, case is ignored.
 * For other numeric strings, their sign will determine the return value.
 * In addition, blank strings consisting of only whitespace will return
 * false. For all other strings, the return value is a result of a
 * boolean cast.
 *
 * @param  string $str
 * @return bool   A boolean value for the string
 */
function libstr_ascii_toBoolean(string $str): bool
{
    $key = libstr_ascii_toLowerCase($str);
    $map = [
        'true'  => true,
        '1'     => true,
        'on'    => true,
        'yes'   => true,
        'false' => false,
        '0'     => false,
        'off'   => false,
        'no'    => false
    ];

    if (\array_key_exists($key, $map)) {
        return $map[$key];
    }

    if (\is_numeric($str)) {
        return ((int)$str > 0);
    }

    return (bool)libstr_ascii_regexReplace($str,'[[:space:]]', '');
}

/**
 * Returns the substring beginning at $start with the specified $length.
 * It differs from the mb_substr() function in that providing a $length of 0
 * will return the rest of the string, rather than an empty string.
 *
 * @param  string $s
 * @param  int    $start Position of the first character to use
 * @param  int    $length Maximum number of characters used
 * @return string
 */
function libstr_ascii_substr(string $s, int $start = 0, int $length = 0): string
{
    if ($length === 0) {
        $length = libstr_ascii_length($s);
    }

    return \substr($s, $start, $length);
}

/**
 * Returns the character at $pos, with indexes starting at 0.
 *
 * @param  string $s
 * @param  int    $pos
 * @return string
 */
function libstr_ascii_at(string $s, int $pos): string
{
    return libstr_ascii_substr($s, $pos, 1);
}

/**
 * Returns an array consisting of the characters in the string.
 *
 * @param  string $s
 * @return array  An array of string chars
 */
function libstr_ascii_chars(string $s): array
{
    if ($s === '') {
        return [];
    }

    $chars = [];

    for ($i = 0, $iMax = libstr_ascii_length($s); $i < $iMax; $i++) {
        $chars[] = libstr_ascii_at($s, $i);
    }

    return $chars;
}

/**
 * Returns the first $length characters of the string.
 *
 * @param  string $s      String for search
 * @param  int    $length Number of characters to retrieve from the start
 * @return string
 */
function libstr_ascii_first(string $s, int $length = 1): string
{
    if ($length <= 0) { return ''; }

    return libstr_ascii_substr($s, 0, $length);
}

/**
 * Returns the last $length characters of the string.
 *
 * @param  string $s      String for search
 * @param  int    $length Number of characters to retrieve from the end
 * @return string
 */
function libstr_ascii_last(string $s, int $length = 1): string
{
    if ($length <= 0) { return ''; }

    return libstr_ascii_substr($s, -$length);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Replace returns a copy of the string $str with the first
 * n non-overlapping instances of old replaced by new.
 * If old is empty, it matches at the beginning of the string and
 * after each UTF-8 sequence, yielding up to k+1 replacements
 * for a k-rune string. If n < 0,
 * there is no limit on the number of replacements.
 *
 * @param  string $str
 * @param  string $old
 * @param  string $new
 * @param  int    $limit
 * @return string
 */
function libstr_ascii_replace(string $str, string $old, string $new, int $limit = -1): string
{
    if ($old === $new || $limit === 0) { return $str; }

    $oldCount = libstr_ascii_countSubstr($str, $old);

    if ($oldCount === 0) { return $str; }

    if ($limit < 0 || $oldCount < $limit) {
        $limit = $oldCount;
    }

    $result = $str;
    $offset = 0;

    while (--$limit >= 0) {
        $pos = \strpos($result, $old, $offset);
        $offset = $pos + \strlen($old);
        $result = \substr($result, 0, $pos) . $new . \substr($result, $offset);
    }

    return $result;
}

/**
 * Returns a string with whitespace removed from the start and end of the
 * string. Supports the removal of unicode whitespace. Accepts an optional
 * string of characters to strip instead of the defaults.
 *
 * @param  string $str
 * @param  string $chars Optional string of characters to strip
 * @return string
 */
function libstr_ascii_trim(string $str, string $chars = ''): string
{
    $chars = $chars ? \preg_quote($chars, '/') : '\s';
    return \preg_replace("^[$chars]+|[$chars]+\$", '', $str);
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
function libstr_ascii_trimLeft(string $str, string $chars = ''): string
{
    $chars = $chars ? \preg_quote($chars, '/') : '\s';
    return \preg_replace("^[$chars]+", '', $str);
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
function libstr_ascii_trimRight(string $str, string $chars = ''): string
{
    $chars = $chars ? \preg_quote($chars, '/') : '\s';
    return \preg_replace("[$chars]+\$", '', $str);
}

/**
 * Append $sub to str
 *
 * @param  string $str
 * @param  string $sub
 * @return string
 */
function libstr_ascii_append(string $str, string $sub): string
{
    return $str . $sub;
}

/**
 * Prepend $sub to str
 *
 * @param  string $str
 * @param  string $sub
 * @return string
 */
function libstr_ascii_prepend(string $str, string $sub): string
{
    return $sub . $str;
}

/**
 * Check whether $prefix exists in the string, and
 * prepend $prefix to the string if it doesn't
 *
 * @param  $str
 * @param  $check
 * @return string
 */
function libstr_ascii_ensureLeft(string $str, string $check): string
{
    if (libstr_ascii_hasPrefix($str, $check)) { return $str; }
    return libstr_ascii_prepend($str, $check);
}

/**
 * Check whether $suffix exists in the string, and
 * append $suffix to the string if it doesn't
 *
 * @param  $str
 * @param  $check
 * @return string
 */
function libstr_ascii_ensureRight(string $str, string $check): string
{
    if (libstr_ascii_hasSuffix($str, $check)) { return $str; }
    return libstr_ascii_append($str, $check);
}

/**
 * Returns a new string of a given length such that both sides of the
 * string are padded. Alias for pad() with a $padType of 'both'.
 *
 * @param  string $str
 * @param  int    $length Desired string length after padding
 * @param  string $padStr String used to pad, defaults to space
 * @return string
 */
function libstr_ascii_padBoth(string $str, int $length, string $padStr = ' '): string
{
    $padding = $length - \strlen($str);
    return libstr_ascii_applyPadding($str, (int)floor($padding / 2), (int)ceil($padding / 2), $padStr);
}

/**
 * Returns a new string of a given length such that the beginning of the
 * string is padded. Alias for pad() with a $padType of 'left'.
 *
 * @param  string $str
 * @param  int    $length Desired string length after padding
 * @param  string $padStr String used to pad, defaults to space
 * @return string
 */
function libstr_ascii_padLeft(string $str, int $length, string $padStr = ' '): string
{
    return libstr_ascii_applyPadding($str, $length - \strlen($str), 0, $padStr);
}

/**
 * Returns a new string of a given length such that the end of the string
 * is padded. Alias for pad() with a $padType of 'right'.
 *
 * @param  string $str
 * @param  int    $length Desired string length after padding
 * @param  string $padStr String used to pad, defaults to space
 * @return string
 */
function libstr_ascii_padRight(string $str, int $length, string $padStr = ' '): string
{
    return libstr_ascii_applyPadding($str, 0, $length - \strlen($str), $padStr);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Adds the specified amount of left and right padding to the given string.
 * The default character used is a space.
 *
 * @param  string $str
 * @param  int    $left   Length of left padding
 * @param  int    $right  Length of right padding
 * @param  string $padStr String used to pad
 * @return string
 *
 * @internal
 */
function libstr_ascii_applyPadding(string $str, int $left = 0, int $right = 0, string $padStr = ' '): string
{
    if ($right + $left <= 0) { return $str; }
    if ('' === $padStr) { return $str;}

    if (1 === \strlen($padStr)) {
        return str_repeat($padStr, $left) . $str . str_repeat($padStr, $right);
    }

    $leftPadding = \substr(str_repeat($padStr, $left), 0, $left);
    $rightPadding = \substr(str_repeat($padStr, $right), 0, $right);
    return $leftPadding . $str . $rightPadding;
}

/**
 * Inserts $substring into the string at the $index provided.
 *
 * @param  string $str
 * @param  string $substring String to be inserted
 * @param  int    $index     The index at which to insert the substring
 * @return string with the resulting $str after the insertion
 */
function libstr_ascii_insert(string $str, string $substring, int $index): string
{
    if (0 === $index) { return $substring . $str; }
    if ($substring === '') { return $str; }

    return \substr($str, 0, $index) . $substring . \substr($str, $index);
}

/**
 * Returns a new string with the prefix $substring removed, if present.
 *
 * @param  string $str
 * @param  string $substring The prefix to remove
 * @return string having a $str without the prefix $substring
 */
function libstr_ascii_removeLeft(string $str, string $substring): string
{
    if ('' !== $substring && libstr_ascii_hasPrefix($str, $substring)) {
        return \substr($str, \strlen($substring));
    }

    return $str;
}

/**
 * Returns a new string with the suffix $substring removed, if present.
 *
 * @param  string $str
 * @param  string $substring The suffix to remove
 * @return string having a $str without the suffix $substring
 */
function libstr_ascii_removeRight(string $str, string $substring): string
{
    if ('' !== $substring && libstr_ascii_hasSuffix($str, $substring)) {
        return \substr($str, 0, \strlen($str) - \strlen($substring));
    }

    return $str;
}

/**
 * Returns a repeated string given a multiplier. An alias for str_repeat.
 *
 * @param  string $str
 * @param  int    $multiplier The number of times to repeat the string
 * @return string with a repeated str
 */
function libstr_ascii_repeat(string $str, int $multiplier): string
{
    return \str_repeat($str, $multiplier);
}

/**
 * Returns a reversed string. A multi-byte version of strrev().
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_reverse(string $str): string
{
    if ('' === $str) { return ''; }

    $reversed = '';

    // Loop from last index of string to first
    $i = \strlen($str);
    while ($i--) {
        $reversed .= $str[$i];
    }

    return $reversed;
}

/**
 * A multi-byte str_shuffle() function. It returns a string with its
 * characters in random order.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_shuffle(string $str): string
{
    $indexes = \range(0, \strlen($str) - 1);
    \shuffle($indexes);

    $shuffledStr = '';
    foreach ($indexes as $i) {
        $shuffledStr .= $str[$i];
    }

    return $shuffledStr;
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Returns the substring between $start and $end, if found, or an empty
 * string. An optional offset may be supplied from which to begin the
 * search for the start string.
 *
 * @param  string $str
 * @param  string $start  Delimiter marking the start of the substring
 * @param  string $end    Delimiter marking the end of the substring
 * @param  int    $offset Index from which to begin the search
 * @return string
 */
function libstr_ascii_between(string $str, string $start, string $end, int $offset = 0): string
{
    $startIndex = libstr_ascii_indexOf($str, $start, $offset);

    if ($startIndex === -1) { return ''; }

    $substrIndex = $startIndex + \mb_strlen($start);
    $endIndex = libstr_ascii_indexOf($str, $end, $substrIndex);

    if ($endIndex === -1) { return ''; }
    if ($endIndex === $substrIndex) { return ''; }

    return libstr_ascii_substr($str, $substrIndex, $endIndex - $substrIndex);
}

/**
 * Returns a camelCase version of the string. Trims surrounding spaces,
 * capitalizes letters following digits, spaces, dashes and underscores,
 * and removes spaces, dashes, as well as underscores.
 *
 * @param  string $str
 * @return string in camelCase
 */
function libstr_ascii_camelize(string $str): string
{
    $str = libstr_ascii_lowerCaseFirst(libstr_ascii_trim($str));
    $str = preg_replace('/^[-_]+/', '', $str);
    $str = preg_replace_callback('/[-_\s]+(.)?/u', function ($match)
    {
        if (isset($match[1])) { return \strtoupper($match[1]); }
        return '';
    }, $str);
    $str = preg_replace_callback('/[\d]+(.)?/u', function ($match) {
        return \strtoupper($match[0]);
    }, $str);
    return $str;
}

/**
 * Make a string lowercase
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_toLowerCase(string $str): string
{
    return \strtolower($str);
}

/**
 * Make a string uppercase
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_toUpperCase(string $str): string
{
    return \strtoupper($str);
}

/**
 * Converts the first character of the string to lower case.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_lowerCaseFirst(string $str): string
{
    if ('' === $str) { return ''; }

    $first = $str[0];
    $rest = \substr($str, 1);
    return \strtolower($first) . $rest;
}

/**
 * Converts the first character of the supplied string to upper case.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_upperCaseFirst(string $str): string
{
    if ('' === $str) { return ''; }

    $first = $str[0];
    $rest = \substr($str, 1);
    return \strtoupper($first) . $rest;
}

/**
 * Trims the string and replaces consecutive whitespace characters with a
 * single space. This includes tabs and newline characters, as well as
 * multi-byte whitespace such as the thin space and ideographic space.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_collapseWhitespace(string $str): string
{
    $str = libstr_ascii_regexReplace($str, '[[:space:]]+', ' ');
    return libstr_ascii_trim($str);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Replaces all occurrences of $pattern in $str by $replacement. An alias
 * for mb_ereg_replace(). Note that the 'i' option with multi-byte patterns
 * in mb_ereg_replace() requires PHP 5.6+ for correct results. This is due
 * to a lack of support in the bundled version of Oniguruma in PHP < 5.6,
 * and current versions of HHVM (3.8 and below).
 *
 * @param  string $str
 * @param  string $pattern     The regular expression pattern
 * @param  string $replacement The string to replace with
 * @param  string $options     Matching conditions to be used
 * @return string
 */
function libstr_ascii_regexReplace(string $str, string $pattern, string $replacement, string $options = 'msr'): string
{
    return \preg_replace($pattern, $replacement, $str, $options);
}

/**
 * Returns a lowercase and trimmed string separated by dashes. Dashes are
 * inserted before uppercase characters (with the exception of the first
 * character of the string), and in place of spaces as well as underscores.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_dasherize(string $str): string
{
    return libstr_ascii_delimit($str, '-');
}

/**
 * Returns a lowercase and trimmed string separated by the given delimiter.
 * Delimiters are inserted before uppercase characters (with the exception
 * of the first character of the string), and in place of spaces, dashes,
 * and underscores. Alpha delimiters are not converted to lowercase.
 *
 * @param  string $str
 * @param  string $delimiter Sequence used to separate parts of the string
 * @return string
 */
function libstr_ascii_delimit(string $str, string $delimiter): string
{
    $str = libstr_ascii_trim($str);
    $str = libstr_ascii_regexReplace($str, '\B([A-Z])', '-\1');
    $str = libstr_ascii_toLowerCase($str);
    return libstr_ascii_regexReplace($str, '[-_\s]+', $delimiter);
}

/**
 * Convert all HTML entities to their applicable characters. An alias of
 * html_entity_decode. For a list of flags, refer to
 * http://php.net/manual/en/function.html-entity-decode.php
 *
 * @param  string $str
 * @param  int    $flags Optional flags
 * @return string
 */
function libstr_ascii_htmlDecode(string $str, int $flags = ENT_QUOTES): string
{
    return \html_entity_decode($str, $flags);
}

/**
 * Convert all applicable characters to HTML entities. An alias of
 * htmlentities. Refer to http://php.net/manual/en/function.htmlentities.php
 * for a list of flags.
 *
 * @param  string $str
 * @param  int    $flags Optional flags
 * @return string
 */
function libstr_ascii_htmlEncode(string $str, int $flags = ENT_QUOTES): string
{
    return \htmlentities($str, $flags);
}

/**
 * Capitalizes the first word of the string, replaces underscores with
 * spaces, and strips '_id'.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_humanize(string $str): string
{
    $str = \str_replace(['_id', '_'], ['', ' '], $str);
    $str = libstr_ascii_trim($str);
    return libstr_ascii_upperCaseFirst($str);
}

/**
 * Splits on newlines and carriage returns, returning an array of strings
 * corresponding to the lines in the string.
 *
 * @param  string $str
 * @return array of strings
 */
function libstr_ascii_lines(string $str): array
{
    return libstr_ascii_split($str, '[\r\n]{1,2}');
}

/**
 * Splits the string with the provided regular expression, returning an
 * array of strings. An optional integer $limit will truncate the
 * results.
 *
 * @param  string $str
 * @param  string $pattern The regex with which to split the string
 * @param  int    $limit   Optional maximum number of results to return
 * @return array of strings
 */
function libstr_ascii_split(string $str, string $pattern, int $limit = -1): array
{
    if (0 === $limit || '' === $str) { return []; }
    if ($pattern === '') { return [$str]; }

    // mb_split returns the remaining unsplit string in the last index when
    // supplying a limit
    $limit = ($limit > 0) ? $limit + 1 : -1;

    $array = \preg_split($pattern, $str, $limit);
    if ($limit > 0 && \count($array) === $limit) {
        array_pop($array);
    }

    $result = [];
    foreach ($array as $string) {
        $result[] = $string;
    }

    return $result;
}

// @todo Optimize all below this line:
// ----------------------------------------------------------

/**
 * Returns the longest common prefix between the string and $otherStr.
 *
 * @param  string $str
 * @param  string $otherStr Second string for comparison
 * @return string being the longest common prefix
 */
function libstr_ascii_longestCommonPrefix(string $str, string $otherStr): string
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
 * @param  string $str
 * @param  string $otherStr Second string for comparison
 * @return string being the longest common suffix
 */
function libstr_ascii_longestCommonSuffix(string $str, string $otherStr): string
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
 * @param  string $str
 * @param  string $otherStr Second string for comparison
 * @return string being the longest common substring
 */
function libstr_ascii_longestCommonSubstring(string $str, string $otherStr): string
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
 * @param  string $str
 * @param  int    $length    Desired length of the truncated string
 * @param  string $substring The substring to append if it can fit
 * @return string
 */
function libstr_ascii_safeTruncate(string $str, int $length, string $substring = ''): string
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
 * @param  string $str
 * @param  string $replacement The string used to replace whitespace
 * @param  string $language    Language of the source string
 * @return string
 */
function libstr_ascii_slugify(string $str, string $replacement = '-', string $language = 'en'): string
{
    $innerStr = libstr_ascii_toAscii($str, $language);

    $innerStr = \str_replace('@', $replacement, $innerStr);
    $quotedReplacement = \preg_quote($replacement, '');
    $pattern = "/[^a-zA-Z\d\s-_$quotedReplacement]/u";
    $innerStr = \preg_replace($pattern, '', $innerStr);

    $innerStr = libstr_ascii_toLowerCase($innerStr);
    $innerStr = libstr_ascii_delimit($innerStr, $replacement);
    $innerStr = libstr_ascii_removeLeft($innerStr, $replacement);

    return libstr_ascii_removeRight($innerStr, $replacement);
}

/**
 * Returns an ASCII version of the string. A set of non-ASCII characters are
 * replaced with their closest ASCII counterparts, and the rest are removed
 * by default. The language or locale of the source string can be supplied
 * for language-specific transliteration in any of the following formats:
 * en, en_GB, or en-GB. For example, passing "de" results in "äöü" mapping
 * to "aeoeue" rather than "aou" as in other languages.
 *
 * @param  string $str
 * @param  string $language          Language of the source string
 * @param  bool   $removeUnsupported Whether or not to remove the unsupported characters
 * @return string
 */
function libstr_ascii_toAscii(string $str, string $language = 'en', bool $removeUnsupported = true): string
{
    $innerStr = $str;

    $langSpecific = libstr_ascii_langSpecificCharsArray($language);

    if (!empty($langSpecific)) {
        $innerStr = \str_replace($langSpecific[0], $langSpecific[1], $innerStr);
    }

    // @todo optimize
    foreach (libstr_ascii_charsArray() as $key => $value) {
        /** @noinspection ForeachSourceInspection */
        foreach ($value as $item) {
            $innerStr = libstr_ascii_replace($innerStr, $item, (string)$key);
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
 * @param  string $str
 * @param  int    $start Initial index from which to begin extraction
 * @param  int    $end   Optional index at which to end extraction
 * @return string being the extracted substring
 */
function libstr_ascii_slice(string $str, int $start, int $end = null): string
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

    return libstr_ascii_substr($innerStr, $start, $length);
}

/**
 * Strip all whitespace characters. This includes tabs and newline
 * characters, as well as multi-byte whitespace such as the thin space
 * and ideographic space.
 *
 * @param  string $str
 * @return string with whitespace stripped
 */
function libstr_ascii_stripWhitespace(string $str): string
{
    $innerStr = $str;
    return libstr_ascii_regexReplace($innerStr, '[[:space:]]+', '');
}

/**
 * Truncates the string to a given length. If $substring is provided, and
 * truncating occurs, the string is further truncated so that the substring
 * may be appended without exceeding the desired length.
 *
 * @param  string $str
 * @param  int    $length    Desired length of the truncated string
 * @param  string $substring The substring to append if it can fit
 * @return string
 */
function libstr_ascii_truncate(string $str, int $length, string $substring = ''): string
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
 * @param  string $str
 * @return string
 */
function libstr_ascii_upperCamelize(string $str): string
{
    $innerStr = $str;
    $innerStr = libstr_ascii_camelize($innerStr);

    return libstr_ascii_upperCaseFirst($innerStr);
}

/**
 * Surrounds $str with the given substring.
 *
 * @param  string $str
 * @param  string $substring The substring to add to both sides
 * @return string
 */
function libstr_ascii_surround(string $str, string $substring): string
{
    $innerStr = $str;

    return implode('', [$substring, $innerStr, $substring]);
}

/**
 * Returns a case swapped version of the string.
 *
 * @param  string $str
 * @return string that has each character's case swapped
 */
function libstr_ascii_swapCase(string $str): string
{
    $innerStr = $str;

    $innerStr = preg_replace_callback(
        '/[\S]/u',
        function ($match) {
            if ($match[0] === \mb_strtoupper($match[0])) {
                return \mb_strtolower($match[0]);
            }

            return \mb_strtoupper($match[0]);
        },
        $innerStr
    );

    return $innerStr;
}

/**
 * Returns a string with smart quotes, ellipsis characters, and dashes from
 * Windows-1252 (commonly used in Word documents) replaced by their ASCII
 * equivalents.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_tidy(string $str): string
{
    $innerStr = $str;
    return preg_replace([
        '/\x{2026}/u',
        '/[\x{201C}\x{201D}]/u',
        '/[\x{2018}\x{2019}]/u',
        '/[\x{2013}\x{2014}]/u',
    ], [
        '...',
        '"',
        "'",
        '-',
    ], $innerStr);
}

/**
 * Returns a trimmed string with the first letter of each word capitalized.
 * Also accepts an array, $ignore, allowing you to list words not to be
 * capitalized.
 *
 * @param  string $str
 * @param  array  $ignore An array of words not to capitalize
 * @return string
 */
function libstr_ascii_titleize(string $str, array $ignore = []): string
{
    $innerStr = $str;
    $innerStr = trim($innerStr);

    $innerStr = preg_replace_callback(
        '/([\S]+)/u',
        function ($match) use ($ignore) {
            if ($ignore && \in_array($match[0], $ignore, true)) {
                return $match[0];
            }

            $innerStr = $match[0];
            $innerStr = libstr_ascii_toLowerCase($innerStr);

            return libstr_ascii_upperCaseFirst($innerStr);
        },
        $innerStr
    );

    return $innerStr;
}

/**
 * Converts each tab in the string to some number of spaces, as defined by
 * $tabLength. By default, each tab is converted to 4 consecutive spaces.
 *
 * @param  string $str
 * @param  int    $tabLength Number of spaces to replace each tab with
 * @return string
 */
function libstr_ascii_toSpaces(string $str, int $tabLength = 4): string
{
    $innerStr = $str;
    $spaces = \str_repeat(' ', $tabLength);

    return \str_replace("\t", $spaces, $innerStr);
}

/**
 * Converts each occurrence of some consecutive number of spaces, as
 * defined by $tabLength, to a tab. By default, each 4 consecutive spaces
 * are converted to a tab.
 *
 * @param  string $str
 * @param  int    $tabLength Number of spaces to replace with a tab
 * @return string
 */
function libstr_ascii_toTabs(string $str, int $tabLength = 4): string
{
    $innerStr = $str;
    $spaces = \str_repeat(' ', $tabLength);

    return \str_replace($spaces, "\t", $innerStr);
}

/**
 * Converts the first character of each word in the string to uppercase.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_toTitleCase(string $str): string
{
    $innerStr = $str;

    return \mb_convert_case($innerStr, \MB_CASE_TITLE);
}

/**
 * Returns a lowercase and trimmed string separated by underscores.
 * Underscores are inserted before uppercase characters (with the exception
 * of the first character of the string), and in place of spaces as well as
 * dashes.
 *
 * @param  string $str
 * @return string
 */
function libstr_ascii_underscored(string $str): string
{
    $innerStr = $str;

    return libstr_ascii_delimit($innerStr, '_');
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Move substring of desired $length to $destination index of the original $str.
 * In case $destination is less than $length returns $str untouched.
 *
 * @param  string $str
 * @param  int    $start
 * @param  int    $length
 * @param  int    $destination
 * @return string
 */
function libstr_ascii_move(string $str, int $start, int $length, int $destination): string
{
    $innerStr = $str;

    if ($destination <= $length) { return $innerStr; }

    $substr = libstr_ascii_substr($innerStr, $start, $length);
    $result = libstr_ascii_insert($innerStr, $substr, $destination);

    return libstr_ascii_replace($result, $substr, '', 1);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Replaces substring in the original $str of $length with given $substr.
 *
 * @param  string $str
 * @param  int    $start
 * @param  int    $length
 * @param  string $substr
 * @return string
 */
function libstr_ascii_overwrite(string $str, int $start, int $length, string $substr): string
{
    $innerStr = $str;

    if ($length <= 0) { return $innerStr; }

    $sub = libstr_ascii_substr($innerStr, $start, $length);

    return libstr_ascii_replace($innerStr, $sub, $substr, 1);
}

/**
 * Returns a snake_case version of the string.
 *
 * @todo refactoring
 * @param  string $str
 * @return string
 */
function libstr_ascii_snakeize(string $str): string
{
    $innerStr = $str;

    $innerStr = \mb_ereg_replace('::', '/', $innerStr);
    $innerStr = \mb_ereg_replace('([A-Z]+)([A-Z][a-z])', '\1_\2', $innerStr);
    $innerStr = \mb_ereg_replace('([a-z\d])([A-Z])', '\1_\2', $innerStr);
    $innerStr = \mb_ereg_replace('\s+', '_', $innerStr);
    $innerStr = \mb_ereg_replace('\s+', '_', $innerStr);
    $innerStr = \mb_ereg_replace('^\s+|\s+$', '', $innerStr);
    $innerStr = \mb_ereg_replace('-', '_', $innerStr);
    $innerStr = libstr_ascii_toLowerCase($innerStr);

    $innerStr = \mb_ereg_replace_callback(
        '([\d|A-Z])',
        function ($matches) {
            $match = $matches[1];
            if ((string)(int)$match === $match) {
                return '_' . $match . '_';
            }
            return null;
        },
        $innerStr
    );

    $innerStr = \mb_ereg_replace('_+', '_', $innerStr);
    $innerStr = libstr_ascii_trim($innerStr, '_');

    return $innerStr;
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Inserts given $substr $times times into the original $str after
 * the first occurrence of $needle.
 *
 * @param  string $str
 * @param  string $needle
 * @param  string $substr
 * @param  int    $times
 * @return string
 */
function libstr_ascii_afterFirst(string $str, string $needle, string $substr, int $times = 1): string
{
    $innerStr = $str;
    $idx = libstr_ascii_indexOf($innerStr, $needle);
    $needleLen = \mb_strlen($needle);
    $idxEnd = $idx + $needleLen;
    $innerSubstr = libstr_ascii_repeat($substr, $times);

    return libstr_ascii_insert($innerStr, $innerSubstr, $idxEnd);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Inserts given $substr $times times into the original $str before
 * the first occurrence of $needle.
 *
 * @param  string $str
 * @param  string $needle
 * @param  string $substr
 * @param  int    $times
 * @return string
 */
function libstr_ascii_beforeFirst(string $str, string $needle, string $substr, int $times = 1): string
{
    $innerStr = $str;
    $idx = libstr_ascii_indexOf($innerStr, $needle);
    $innerSubstr = libstr_ascii_repeat($substr, $times);

    return libstr_ascii_insert($innerStr, $innerSubstr, $idx);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Inserts given $substr $times times into the original $str after
 * the last occurrence of $needle.
 *
 * @param  string $str
 * @param  string $needle
 * @param  string $substr
 * @param  int    $times
 * @return string
 */
function libstr_ascii_afterLast(string $str, string $needle, string $substr, int $times = 1): string
{
    $innerStr = $str;
    $idx = libstr_ascii_indexOfLast($innerStr, $needle);
    $needleLen = \mb_strlen($needle);
    $idxEnd = $idx + $needleLen;
    $innerSubstr = libstr_ascii_repeat($substr, $times);

    return libstr_ascii_insert($innerStr, $innerSubstr, $idxEnd);
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Inserts given $substr $times times into the original $str before
 * the last occurrence of $needle.
 *
 * @param  string $str
 * @param  string $needle
 * @param  string $substr
 * @param  int    $times
 * @return string
 */
function libstr_ascii_beforeLast(string $str, string $needle, string $substr, int $times = 1): string
{
    $innerStr = $str;
    $idx = libstr_ascii_indexOfLast($innerStr, $needle);
    $innerSubstr = libstr_ascii_repeat($substr, $times);

    return libstr_ascii_insert($innerStr, $innerSubstr, $idx);
}

/**
 * Splits the given $str in pieces by '@' delimiter and returns
 * true in case the resulting array consists of 2 parts.
 *
 * @param  string $str
 * @return bool
 */
function libstr_ascii_isEmail(string $str): bool
{
    $innerStr = $str;
    $split = libstr_ascii_split($innerStr, '@');

    return \count($split) === 2;
}

/**
 * Checks whether given $str is a valid ip v4.
 *
 * @param  string $str
 * @return bool
 */
function libstr_ascii_isIpV4(string $str): bool
{
    $regex = '\b((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.|$)){4}\b';

    return libstr_ascii_matchesPattern($str, $regex);
}

/**
 * Checks whether given $str is a valid ip v6.
 *
 * @param  string $str
 * @return bool
 */
function libstr_ascii_isIpV6(string $str): bool
{
    $regex = '^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$';

    return libstr_ascii_matchesPattern($str, $regex);
}

/**
 * Generates a random string consisting of $possibleChars, if specified, of given $size or
 * random length between $size and $sizeMax.
 *
 * @param  int    $size          The desired length of the string
 * @param  string $possibleChars If given, specifies allowed characters to make the string of
 * @param  int    $sizeMax       If given and is > $size, the generated string will have random length
 *                               between $size and $sizeMax
 * @return string
 */
function libstr_ascii_random(int $size, int $sizeMax = -1, string $possibleChars = ''): string
{
    if ($size <= 0 || $sizeMax === 0) { return ''; }
    if ($sizeMax > 0 && $sizeMax < $size) { return ''; }

    $allowedChars = $possibleChars ?: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $maxLen = $sizeMax > 0 ? $sizeMax : $size;
    /** @noinspection RandomApiMigrationInspection */
    $actualLen = \rand($size, $maxLen);
    $allowedCharsLen = \mb_strlen($allowedChars) - 1;

    $result = '';

    while ($actualLen--) {
        /** @noinspection RandomApiMigrationInspection */
        $char = libstr_ascii_substr($allowedChars, \rand(0, $allowedCharsLen), 1);
        $result .= $char;
    }

    return $result;
}

/** @noinspection MoreThanThreeArgumentsInspection */
/**
 * Appends a random string consisting of $possibleChars, if specified, of given $size or
 * random length between $size and $sizeMax to the given $str.
 *
 * @param  string $str
 * @param  int    $size          The desired length of the string. Defaults to 4
 * @param  string $possibleChars If given, specifies allowed characters to make the string of
 * @param  int    $sizeMax       If given and is > $size, the generated string will have random length
 *                               between $size and $sizeMax
 * @return string
 */
function libstr_ascii_appendUniqueIdentifier(string $str, int $size = 4, int $sizeMax = -1, string $possibleChars = ''): string
{
    $innerStr = $str;
    $identifier = libstr_ascii_random($size, $sizeMax, $possibleChars);

    return $innerStr . $identifier;
}

/**
 * Splits whitespace, returning an array of strings corresponding to the words in the string.
 *
 * @param  string $str
 * @return array of strings
 */
function libstr_ascii_words(string $str): array
{
    $innerStr = $str;

    return libstr_ascii_split($innerStr, '[[:space:]]+');
}

/**
 * Wraps each word in the given $str with specified $quote.
 *
 * @param  string $str
 * @param  string $quote Defaults to ".
 * @return string
 */
function libstr_ascii_quote(string $str, string $quote = '"'): string
{
    $innerStr = $str;

    $words = libstr_ascii_words($innerStr);
    $result = [];

    foreach ($words as $word) {
        $result[] = $quote . $word . $quote;
    }

    return \implode(' ', $result);
}

/**
 * Unwraps each word in the given $str, deleting the specified $quote.
 *
 * @param  string $str
 * @param  string $quote Defaults to ".
 * @return string
 */
function libstr_ascii_unquote(string $str, string $quote = '"'): string
{
    $innerStr = $str;

    $words = libstr_ascii_words($innerStr);
    $result = [];

    foreach ($words as $word) {
        $result[] = libstr_ascii_trim($word, $quote);
    }

    return \implode(' ', $result);
}

/**
 * Cuts the given $str in pieces of $step size.
 *
 * @param  string $str
 * @param  int    $step
 * @return array
 */
function libstr_ascii_chop(string $str, int $step = 0): array
{
    $innerStr = $str;
    $result = [];
    $len = \mb_strlen($innerStr);

    if ($innerStr === '' || $step <= 0) { return []; }

    if ($step >= $len) { return [$innerStr]; }

    $startPos = 0;

    for ($i = 0; $i < $len; $i+=$step) {
        $result[] = libstr_ascii_substr($innerStr, $startPos, $step);
        $startPos += $step;
    }

    return $result;
}

/**
 * Joins the original string with an array of other strings.
 *
 * @param string $str
 * @param  $separator
 * @param   $otherStrings
 *
 * @return string
 */
function libstr_ascii_join(string $str, string $separator, array $otherStrings = []): string
{
    $innerStr = $str;

    if (empty($otherStrings)) { return $innerStr; }

    foreach ($otherStrings as $otherString) {
        if ($otherString) {
            $innerStr .= $separator . $otherString;
        }
    }

    return $innerStr;
}

/**
 * Returns the substring of the original string from beginning to
 * the first occurrence of $delimiter.
 *
 * @param  string $str
 * @param  string $delimiter
 *
 * @return string
 */
function libstr_ascii_shift(string $str, string $delimiter): string
{
    if (!$str || !$delimiter) { return ''; }

    $innerStr = $str;
    $idx = libstr_ascii_indexOf($innerStr, $delimiter);

    if ($idx === -1) { return $innerStr; }

    return libstr_ascii_substr($innerStr, 0, $idx);
}

/**
 * Returns the substring of the original string from the first
 * occurrence of $delimiter to the end.
 *
 * @param  string $str
 * @param  string $delimiter
 *
 * @return string
 */
function libstr_ascii_shiftReversed(string $str, string $delimiter): string
{
    if (!$str || !$delimiter) { return ''; }

    $innerStr = $str;
    $idx = libstr_ascii_indexOf($innerStr, $delimiter) + 1;

    if ($idx === -1) { return $innerStr; }

    return libstr_ascii_substr($innerStr, $idx);
}

/**
 * Returns the substring of the original string from the last
 * occurrence of $delimiter to the end.
 *
 * @param  string $str
 * @param  string $delimiter
 *
 * @return string
 */
function libstr_ascii_pop(string $str, string $delimiter): string
{
    if (!$str || !$delimiter) { return ''; }

    $innerStr = $str;
    $idx = libstr_ascii_indexOfLast($innerStr, $delimiter) + 1;

    if ($idx === -1) { return $innerStr; }

    return libstr_ascii_substr($innerStr, $idx);
}


/**
 * Returns the substring of the original string from the beginning
 * to the last occurrence of $delimiter.
 *
 * @param  string $str
 * @param  string $delimiter
 *
 * @return string
 */
function libstr_ascii_popReversed(string $str, string $delimiter): string
{
    if (!$str || !$delimiter) { return ''; }

    $innerStr = $str;
    $idx = libstr_ascii_indexOfLast($innerStr, $delimiter);

    if ($idx === -1) { return $innerStr; }

    return libstr_ascii_substr($innerStr, 0, $idx);
}
