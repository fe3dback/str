<?php

declare(strict_types=1);

namespace Str;

use function Str\Lib\libstr_at;
use function Str\Lib\libstr_append;
use function Str\Lib\libstr_applyPadding;
use function Str\Lib\libstr_between;
use function Str\Lib\libstr_camelize;
use function Str\Lib\libstr_chars;
use function Str\Lib\libstr_charsArray;
use function Str\Lib\libstr_collapseWhitespace;
use function Str\Lib\libstr_containsAll;
use function Str\Lib\libstr_containsAny;
use function Str\Lib\libstr_contains;
use function Str\Lib\libstr_countSubstr;
use function Str\Lib\libstr_dasherize;
use function Str\Lib\libstr_delimit;
use function Str\Lib\libstr_endsWith;
use function Str\Lib\libstr_endsWithAny;
use function Str\Lib\libstr_ensureLeft;
use function Str\Lib\libstr_ensureRight;
use function Str\Lib\libstr_first;
use function Str\Lib\libstr_hasPrefix;
use function Str\Lib\libstr_hasSuffix;
use function Str\Lib\libstr_htmlDecode;
use function Str\Lib\libstr_htmlEncode;
use function Str\Lib\libstr_humanize;
use function Str\Lib\libstr_indexOf;
use function Str\Lib\libstr_indexOfLast;
use function Str\Lib\libstr_insert;
use function Str\Lib\libstr_isAlpha;
use function Str\Lib\libstr_isAlphanumeric;
use function Str\Lib\libstr_isBase64;
use function Str\Lib\libstr_isBlank;
use function Str\Lib\libstr_isHexadecimal;
use function Str\Lib\libstr_isLowerCase;
use function Str\Lib\libstr_isSerialized;
use function Str\Lib\libstr_isUpperCase;
use function Str\Lib\libstr_isUUIDv4;
use function Str\Lib\libstr_langSpecificCharsArray;
use function Str\Lib\libstr_last;
use function Str\Lib\libstr_move;
use function Str\Lib\libstr_overwrite;
use function Str\Lib\libstr_snakeize;
use function Str\Lib\libstr_split;
use function Str\Lib\libstr_length;
use function Str\Lib\libstr_lines;
use function Str\Lib\libstr_longestCommonPrefix;
use function Str\Lib\libstr_longestCommonSubstring;
use function Str\Lib\libstr_longestCommonSuffix;
use function Str\Lib\libstr_lowerCaseFirst;
use function Str\Lib\libstr_matchesPattern;
use function Str\Lib\libstr_pad;
use function Str\Lib\libstr_prepend;
use function Str\Lib\libstr_regexReplace;
use function Str\Lib\libstr_removeLeft;
use function Str\Lib\libstr_removeRight;
use function Str\Lib\libstr_repeat;
use function Str\Lib\libstr_replace;
use function Str\Lib\libstr_reverse;
use function Str\Lib\libstr_safeTruncate;
use function Str\Lib\libstr_shuffle;
use function Str\Lib\libstr_slice;
use function Str\Lib\libstr_slugify;
use function Str\Lib\libstr_startsWith;
use function Str\Lib\libstr_startsWithAny;
use function Str\Lib\libstr_stripWhitespace;
use function Str\Lib\libstr_substr;
use function Str\Lib\libstr_surround;
use function Str\Lib\libstr_swapCase;
use function Str\Lib\libstr_tidy;
use function Str\Lib\libstr_titleize;
use function Str\Lib\libstr_toAscii;
use function Str\Lib\libstr_toBoolean;
use function Str\Lib\libstr_toLowerCase;
use function Str\Lib\libstr_toSpaces;
use function Str\Lib\libstr_toTabs;
use function Str\Lib\libstr_toTitleCase;
use function Str\Lib\libstr_toUpperCase;
use function Str\Lib\libstr_trim;
use function Str\Lib\libstr_trimLeft;
use function Str\Lib\libstr_trimRight;
use function Str\Lib\libstr_truncate;
use function Str\Lib\libstr_underscored;
use function Str\Lib\libstr_upperCamelize;
use function Str\Lib\libstr_upperCaseFirst;
use function Str\Lib\libstr_isJson;

class Str
{
    /** @var string */
    private $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * Get resulting string
     *
     * @return string
     */
    public function getString(): string
    {
        return $this->str;
    }

    /**
     * Alias for getString method
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
     * It differs from the mb_substr() function in that providing a $length of 0
     * will return the rest of the string, rather than an empty string.
     *
     * @param  int $start  Position of the first character to use
     * @param  int $length Maximum number of characters used
     * @return Str
     */
    public function substr(int $start = 0, int $length = 0): Str
    {
        $this->str = libstr_substr($this->str, $start, $length);
        return $this;
    }

    /**
     * Check if the string has $prefix at the start
     *
     * @param  string $prefix
     * @return bool
     */
    public function hasPrefix(string $prefix): bool
    {
        return libstr_hasPrefix($this->str, $prefix);
    }

    /**
     * Check if the string has $suffix at the end
     *
     * @param  string $suffix
     * @return bool
     */
    public function hasSuffix(string $suffix): bool
    {
        return libstr_hasSuffix($this->str, $suffix);
    }

    /**
     * Check whether $prefix exists in the string, and
     * prepend $prefix to the string if it doesn't
     *
     * @param  string $check
     * @return Str
     */
    public function ensureLeft(string $check): Str
    {
        $this->str = libstr_ensureLeft($this->str, $check);
        return $this;
    }

    /**
     * Check whether $suffix exists in the string, and
     * append $suffix to the string if it doesn't
     *
     * @param  string $check
     * @return Str
     */
    public function ensureRight(string $check): Str
    {
        $this->str = libstr_ensureRight($this->str, $check);
        return $this;
    }

    /**
     * Check if $haystack contains $needle substring
     *
     * @param  string $sub
     * @return bool
     */
    public function contains(string $sub): bool
    {
        return libstr_contains($this->str, $sub);
    }

    /**
     * Replace returns a copy of the string s with the first
     * n non-overlapping instances of old replaced by new.
     * If old is empty, it matches at the beginning of the string and
     * after each UTF-8 sequence, yielding up to k+1 replacements
     * for a k-rune string. If n < 0,
     * there is no limit on the number of replacements.
     *
     * @param  string $old
     * @param  string $new
     * @param  int    $times
     * @return Str
     */
    public function replace(string $old, string $new, int $times = -1): Str
    {
        $this->str = libstr_replace($this->str, $old, $new, $times);
        return $this;
    }

    /**
     * Make a string lowercase
     *
     * @return Str
     */
    public function toLowerCase(): Str
    {
        $this->str = libstr_toLowerCase($this->str);
        return $this;
    }

    /**
     * Make a string uppercase
     *
     * @return Str
     */
    public function toUpperCase(): Str
    {
        $this->str = libstr_toUpperCase($this->str);
        return $this;
    }

    /**
     * Returns a string with whitespace removed from the start and end of the
     * string. Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param  string $chars
     * @return Str
     */
    public function trim(string $chars = ''): Str
    {
        $this->str = libstr_trim($this->str, $chars);
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
        $this->str = libstr_trimLeft($this->str, $chars);
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
        $this->str = libstr_trimRight($this->str, $chars);
        return $this;
    }

    /**
     * Append $sub to the string
     *
     * @param  string $sub
     * @return Str
     */
    public function append(string $sub): Str
    {
        $this->str = libstr_append($this->str, $sub);
        return $this;
    }

    /**
     * Prepend $sub to the string
     *
     * @param  string $sub
     * @return Str
     */
    public function prepend(string $sub): Str
    {
        $this->str = libstr_prepend($this->str, $sub);
        return $this;
    }

    /**
     * Returns the character at $pos, with indexes starting at 0.
     *
     * @param  int $pos
     * @return Str
     */
    public function at(int $pos): Str
    {
        $this->str = libstr_at($this->str, $pos);
        return $this;
    }

    /**
     * Returns an array consisting of the characters in the string.
     *
     * @return array An array of string chars
     */
    public function chars(): array
    {
        return libstr_chars($this->str);
    }

    /**
     * Return string length
     *
     * @return int
     */
    public function length(): int
    {
        return libstr_length($this->str);
    }

    /**
     * Returns the first $length characters of the string.
     *
     * @param  int $length Number of characters to retrieve from the start
     * @return Str
     */
    public function first(int $length = 1): Str
    {
        $this->str = libstr_first($this->str, $length);
        return $this;
    }

    /**
     * Returns the last $length characters of the string.
     *
     * @param  int $length Number of characters to retrieve from the end
     * @return Str
     */
    public function last(int $length = 1): Str
    {
        $this->str = libstr_last($this->str, $length);
        return $this;
    }

    /**
     * Returns the index of the first occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search.
     *
     * @param  string $needle Substring to look for
     * @param  int    $offset Offset from which to search
     * @return int            The occurrence's index if found, otherwise -1
     */
    public function indexOf(string $needle, int $offset = 0): int
    {
        return libstr_indexOf($this->str, $needle, $offset);
    }

    /**
     * Returns the index of the last occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search. Offsets may be negative to count from the last character
     * in the string.
     *
     * @param  string $needle Substring to look for
     * @param  int    $offset Offset from which to search
     * @return int            The last occurrence's index if found, otherwise -1
     */
    public function indexOfLast(string $needle, int $offset = 0): int
    {
        return libstr_indexOfLast($this->str, $needle, $offset);
    }

    /**
     * Returns the number of occurrences of $substring in the given string.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $needle        The substring to search for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return int                   The number of $substring occurrences
     */
    public function countSubstr(string $needle, bool $caseSensitive = true): int
    {
        return libstr_countSubstr($this->str, $needle, $caseSensitive);
    }

    /**
     * Returns true if the string contains all $needles, false otherwise. By
     * default the comparison is case-sensitive, but can be made insensitive by
     * setting $caseSensitive to false.
     *
     * @param  array $needles       Substrings to look for
     * @param  bool  $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                 Whether or not $str contains $needle
     */
    public function containsAll(array $needles, bool $caseSensitive = true): bool
    {
        return libstr_containsAll($this->str, $needles, $caseSensitive);
    }

    /**
     * Returns true if the string contains any $needles, false otherwise. By
     * default the comparison is case-sensitive, but can be made insensitive by
     * setting $caseSensitive to false.
     *
     * @param  array $needles       Substrings to look for
     * @param  bool  $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                 Whether or not $str contains $needle
     */
    public function containsAny(array $needles, bool $caseSensitive = true): bool
    {
        return libstr_containsAny($this->str, $needles, $caseSensitive);
    }

    /**
     * Returns true if the string begins with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $substring     The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                  Whether or not $str starts with $substring
     */
    public function startsWith(string $substring, bool $caseSensitive = true): bool
    {
        return libstr_startsWith($this->str, $substring, $caseSensitive);
    }

    /**
     * Returns true if the string begins with any of $substrings, false
     * otherwise. By default the comparison is case-sensitive, but can be made
     * insensitive by setting $caseSensitive to false.
     *
     * @param  array $substrings    Substrings to look for
     * @param  bool  $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                 Whether or not $str starts with $substring
     */
    public function startsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        return libstr_startsWithAny($this->str, $substrings, $caseSensitive);
    }

    /**
     * Returns true if the string ends with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $substring     The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                  Whether or not $str ends with $substring
     */
    public function endsWith(string $substring, bool $caseSensitive = true): bool
    {
        return libstr_endsWith($this->str, $substring, $caseSensitive);
    }

    /**
     * Returns true if the string ends with any of $substrings, false otherwise.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  array $substrings    Substrings to look for
     * @param  bool  $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                 Whether or not $str ends with $substring
     */
    public function endsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        return libstr_endsWithAny($this->str, $substrings, $caseSensitive);
    }

    /**
     * Pads the string to a given length with $padStr. If length is less than
     * or equal to the length of the string, no padding takes places. The
     * default string used for padding is a space, and the default type (one of
     * 'left', 'right', 'both') is 'right'.
     *
     * @param  int    $length  Desired string length after padding
     * @param  string $padStr  String used to pad, defaults to space
     * @param  string $padType One of 'left', 'right', 'both'
     * @return Str
     */
    public function pad(int $length, string $padStr = ' ', string $padType = 'right'): Str
    {
        $this->str = libstr_pad($this->str, $length, $padStr, $padType);
        return $this;
    }

    /**
     * Returns a new string of a given length such that both sides of the
     * string are padded. Alias for pad() with a $padType of 'both'.
     *
     * @param  int    $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return Str
     */
    public function padBoth(int $length, string $padStr = ' '): Str
    {
        $padding = $length - \mb_strlen($this->str);

        $this->str = libstr_applyPadding($this->str, (int)floor($padding / 2), (int)ceil($padding / 2),
            $padStr);

        return $this;
    }

    /**
     * Returns a new string of a given length such that the beginning of the
     * string is padded. Alias for pad() with a $padType of 'left'.
     *
     * @param  int    $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return Str
     */
    public function padLeft(int $length, string $padStr = ' '): Str
    {
        $this->str = libstr_applyPadding($this->str, $length - \mb_strlen($this->str), 0, $padStr);
        return $this;
    }

    /**
     * Returns a new string of a given length such that the end of the string
     * is padded. Alias for pad() with a $padType of 'right'.
     *
     * @param  int    $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return Str
     */
    public function padRight(int $length, string $padStr = ' '): Str
    {
        $this->str = libstr_applyPadding($this->str, 0, $length - \mb_strlen($this->str), $padStr);
        return $this;
    }

    /**
     * Inserts $substring into the string at the $index provided.
     *
     * @param  string $substring String to be inserted
     * @param  int    $index     The index at which to insert the substring
     * @return Str
     */
    public function insert(string $substring, int $index): Str
    {
        $this->str = libstr_insert($this->str, $substring, $index);
        return $this;
    }

    /**
     * Returns a new string with the prefix $substring removed, if present.
     *
     * @param  string $substring The prefix to remove
     * @return Str
     */
    public function removeLeft(string $substring): Str
    {
        $this->str = libstr_removeLeft($this->str, $substring);
        return $this;
    }

    /**
     * Returns a new string with the suffix $substring removed, if present.
     *
     * @param  string $substring The suffix to remove
     * @return Str
     */
    public function removeRight(string $substring): Str
    {
        $this->str = libstr_removeRight($this->str, $substring);
        return $this;
    }

    /**
     * Returns a repeated string given a multiplier. An alias for str_repeat.
     *
     * @param  int $multiplier The number of times to repeat the string
     * @return Str
     */
    public function repeat(int $multiplier): Str
    {
        $this->str = libstr_repeat($this->str, $multiplier);
        return $this;
    }

    /**
     * Returns a reversed string. A multi-byte version of strrev().
     *
     * @return Str
     */
    public function reverse(): Str
    {
        $this->str = libstr_reverse($this->str);
        return $this;
    }

    /**
     * A multi-byte str_shuffle() function. It returns a string with its
     * characters in random order.
     *
     * @return Str
     */
    public function shuffle(): Str
    {
        $this->str = libstr_shuffle($this->str);
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
     * @return Str
     */
    public function between(string $start, string $end, int $offset = 0): Str
    {
        $this->str = libstr_between($this->str, $start, $end, $offset);
        return $this;
    }

    /**
     * Returns a camelCase version of the string. Trims surrounding spaces,
     * capitalizes letters following digits, spaces, dashes and underscores,
     * and removes spaces, dashes, as well as underscores.
     *
     * @return Str
     */
    public function camelize(): Str
    {
        $this->str = libstr_camelize($this->str);
        return $this;
    }

    /**
     * Converts the first character of the string to lower case.
     *
     * @return Str
     */
    public function lowerCaseFirst(): Str
    {
        $this->str = libstr_lowerCaseFirst($this->str);
        return $this;
    }

    /**
     * Converts the first character of the supplied string to upper case.
     *
     * @return Str
     */
    public function upperCaseFirst(): Str
    {
        $this->str = libstr_upperCaseFirst($this->str);
        return $this;
    }

    /**
     * Trims the string and replaces consecutive whitespace characters with a
     * single space. This includes tabs and newline characters, as well as
     * multi-byte whitespace such as the thin space and ideographic space.
     *
     * @return Str
     */
    public function collapseWhitespace(): Str
    {
        $this->str = libstr_collapseWhitespace($this->str);
        return $this;
    }

    /**
     * Replaces all occurrences of $pattern in $str by $replacement. An alias
     * for mb_ereg_replace(). Note that the 'i' option with multi-byte patterns
     * in mb_ereg_replace() requires PHP 5.6+ for correct results. This is due
     * to a lack of support in the bundled version of Oniguruma in PHP < 5.6,
     * and current versions of HHVM (3.8 and below).
     *
     * @param  string $pattern     The regular expression pattern
     * @param  string $replacement The string to replace with
     * @param  string $options     Matching conditions to be used
     * @return Str
     */
    public function regexReplace(string $pattern, string $replacement, string $options = 'msr'): Str
    {
        $this->str = libstr_regexReplace($this->str, $pattern, $replacement, $options);
        return $this;
    }

    /**
     * Returns a lowercase and trimmed string separated by dashes. Dashes are
     * inserted before uppercase characters (with the exception of the first
     * character of the string), and in place of spaces as well as underscores.
     *
     * @return Str
     */
    public function dasherize(): Str
    {
        $this->str = libstr_dasherize($this->str);
        return $this;
    }

    /**
     * Returns a lowercase and trimmed string separated by the given delimiter.
     * Delimiters are inserted before uppercase characters (with the exception
     * of the first character of the string), and in place of spaces, dashes,
     * and underscores. Alpha delimiters are not converted to lowercase.
     *
     * @param  string $delimiter Sequence used to separate parts of the string
     * @return Str
     */
    public function delimit($delimiter): Str
    {
        $this->str = libstr_delimit($this->str, $delimiter);
        return $this;
    }

    /**
     * Checks if the given string is a valid UUID v.4.
     * It doesn't matter whether the given UUID has dashes.
     *
     * @return bool
     */
    public function isUUIDv4(): bool
    {
        return libstr_isUUIDv4($this->str);
    }

    /**
     * Returns true if the string contains a lower case char, false otherwise.
     *
     * @return bool Whether or not the string contains a lower case character.
     */
    public function hasLowerCase(): bool
    {
        return libstr_matchesPattern($this->str, '.*[[:lower:]]');
    }

    /**
     * Returns true if the string contains an upper case char, false otherwise.
     *
     * @return bool Whether or not the string contains an upper case character.
     */
    public function hasUpperCase(): bool
    {
        return libstr_matchesPattern($this->str, '.*[[:upper:]]');
    }

    /**
     * Returns true if $str matches the supplied pattern, false otherwise.
     *
     * @param  string $pattern Regex pattern to match against
     * @return bool            Whether or not $str matches the pattern
     */
    public function matchesPattern(string $pattern): bool
    {
        return libstr_matchesPattern($this->str, $pattern);
    }

    /**
     * Convert all HTML entities to their applicable characters. An alias of
     * html_entity_decode. For a list of flags, refer to
     * http://php.net/manual/en/function.html-entity-decode.php
     *
     * @param  int $flags Optional flags
     * @return Str
     */
    public function htmlDecode(int $flags = ENT_COMPAT): Str
    {
        $this->str = libstr_htmlDecode($this->str, $flags);
        return $this;
    }

    /**
     * Convert all applicable characters to HTML entities. An alias of
     * htmlentities. Refer to http://php.net/manual/en/function.htmlentities.php
     * for a list of flags.
     *
     * @param  int $flags Optional flags
     * @return Str
     */
    public function htmlEncode(int $flags = ENT_COMPAT): Str
    {
        $this->str = libstr_htmlEncode($this->str, $flags);
        return $this;
    }

    /**
     * Capitalizes the first word of the string, replaces underscores with
     * spaces, and strips '_id'.
     *
     * @return Str
     */
    public function humanize(): Str
    {
        $this->str = libstr_humanize($this->str);
        return $this;
    }

    /**
     * Returns true if the string contains only alphabetic chars, false otherwise.
     *
     * @return bool Whether or not $str contains only alphabetic chars
     */
    public function isAlpha(): bool
    {
        return libstr_isAlpha($this->str);
    }

    /**
     * Returns true if the string contains only alphabetic and numeric
     * chars, false otherwise.
     *
     * @return bool Whether or not $str contains only alphanumeric chars
     */
    public function isAlphanumeric(): bool
    {
        return libstr_isAlphanumeric($this->str);
    }

    /**
     * Returns true if the string is base64 encoded, false otherwise.
     *
     * @return bool Whether or not $str is base64 encoded
     */
    public function isBase64(): bool
    {
        return libstr_isBase64($this->str);
    }

    /**
     * Returns true if the string contains only whitespace chars, false otherwise.
     *
     * @return bool Whether or not $str contains only whitespace characters
     */
    public function isBlank(): bool
    {
        return libstr_isBlank($this->str);
    }

    /**
     * Returns true if the string contains only hexadecimal chars, false otherwise.
     *
     * @return bool Whether or not $str contains only hexadecimal chars
     */
    public function isHexadecimal(): bool
    {
        return libstr_isHexadecimal($this->str);
    }

    /**
     * Returns true if the string is JSON, false otherwise. Unlike json_decode
     * in PHP 5.x, this method is consistent with PHP 7 and other JSON parsers,
     * in that an empty string is not considered valid JSON.
     *
     * @return bool Whether or not $str is JSON
     */
    public function isJson(): bool
    {
        return libstr_isJson($this->str);
    }

    /**
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * @return bool Whether or not $str contains only lower case characters
     */
    public function isLowerCase(): bool
    {
        return libstr_isLowerCase($this->str);
    }

    /**
     * Returns true if the string is serialized, false otherwise.
     *
     * @return bool Whether or not $str is serialized
     */
    public function isSerialized(): bool
    {
        return libstr_isSerialized($this->str);
    }

    /**
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * @return bool Whether or not $str contains only lower case characters
     */
    public function isUpperCase(): bool
    {
        return libstr_isUpperCase($this->str);
    }

    /**
     * Splits on newlines and carriage returns, returning an array of Stringy
     * objects corresponding to the lines in the string.
     *
     * @return array of strings
     */
    public function lines(): array
    {
        return libstr_lines($this->str);
    }

    /**
     * Splits the string with the provided regular expression, returning an
     * array of Stringy objects. An optional integer $limit will truncate the
     * results.
     *
     * @param  string $pattern The regex with which to split the string
     * @param  int    $limit   Optional maximum number of results to return
     * @return array of strings
     */
    public function split(string $pattern, int $limit = -1): array
    {
        return libstr_split($this->str, $pattern, $limit);
    }

    /**
     * Returns the longest common prefix between the string and $otherStr.
     *
     * @param  string $otherStr Second string for comparison
     * @return Str
     */
    public function longestCommonPrefix(string $otherStr): Str
    {
        $this->str = libstr_longestCommonPrefix($this->str, $otherStr);
        return $this;
    }

    /**
     * Returns the longest common suffix between the string and $otherStr.
     *
     * @param  string $otherStr Second string for comparison
     * @return Str
     */
    public function longestCommonSuffix(string $otherStr): Str
    {
        $this->str = libstr_longestCommonSuffix($this->str, $otherStr);
        return $this;
    }

    /**
     * Returns the longest common substring between the string and $otherStr.
     * In the case of ties, it returns that which occurs first.
     *
     * @param  string $otherStr Second string for comparison
     * @return Str
     */
    public function longestCommonSubstring(string $otherStr): Str
    {
        $this->str = libstr_longestCommonSubstring($this->str, $otherStr);
        return $this;
    }

    /**
     * Truncates the string to a given length, while ensuring that it does not
     * split words. If $substring is provided, and truncating occurs, the
     * string is further truncated so that the substring may be appended without
     * exceeding the desired length.
     *
     * @param  int    $length    Desired length of the truncated string
     * @param  string $substring The substring to append if it can fit
     * @return Str
     */
    public function safeTruncate(int $length, string $substring = ''): Str
    {
        $this->str = libstr_safeTruncate($this->str, $length, $substring);
        return $this;
    }

    /**
     * Converts the string into an URL slug. This includes replacing non-ASCII
     * characters with their closest ASCII equivalents, removing remaining
     * non-ASCII and non-alphanumeric characters, and replacing whitespace with
     * $replacement. The replacement defaults to a single dash, and the string
     * is also converted to lowercase. The language of the source string can
     * also be supplied for language-specific transliteration.
     *
     * @param  string $replacement The string used to replace whitespace
     * @param  string $language    Language of the source string
     * @return Str
     */
    public function slugify(string $replacement = '-', string $language = 'en'): Str
    {
        $this->str = libstr_slugify($this->str, $replacement, $language);
        return $this;
    }

    /**
     * Returns an ASCII version of the string. A set of non-ASCII characters are
     * replaced with their closest ASCII counterparts, and the rest are removed
     * by default. The language or locale of the source string can be supplied
     * for language-specific transliteration in any of the following formats:
     * en, en_GB, or en-GB. For example, passing "de" results in "äöü" mapping
     * to "aeoeue" rather than "aou" as in other languages.
     *
     * @param  string $language          Language of the source string
     * @param  bool   $removeUnsupported Whether or not to remove the unsupported characters
     * @return Str
     */
    public function toAscii(string $language = 'en', bool $removeUnsupported = true): Str
    {
        $this->str = libstr_toAscii($this->str, $language, $removeUnsupported);
        return $this;
    }

    /**
     * Returns the replacements for the toAscii() method.
     *
     * @return array An array of replacements.
     */
    public function charsArray(): array
    {
        return libstr_charsArray();
    }

    /**
     * Returns language-specific replacements for the toAscii() method.
     * For example, German will map 'ä' to 'ae', while other languages
     * will simply return 'a'.
     *
     * @param  string $language Language of the source string
     * @return array  An array of replacements.
     */
    public function langSpecificCharsArray(string $language = 'en'): array
    {
        return libstr_langSpecificCharsArray($language);
    }

    /**
     * Returns the substring beginning at $start, and up to, but not including
     * the index specified by $end. If $end is omitted, the function extracts
     * the remaining string. If $end is negative, it is computed from the end
     * of the string.
     *
     * @param  int $start Initial index from which to begin extraction
     * @param  int $end   Optional index at which to end extraction
     * @return Str
     */
    public function slice(int $start, int $end = null): Str
    {
        $this->str = libstr_slice($this->str, $start, $end);
        return $this;
    }

    /**
     * Strip all whitespace characters. This includes tabs and newline
     * characters, as well as multi-byte whitespace such as the thin space
     * and ideographic space.
     *
     * @return Str
     */
    public function stripWhitespace(): Str
    {
        $this->str = libstr_stripWhitespace($this->str);
        return $this;
    }

    /**
     * Truncates the string to a given length. If $substring is provided, and
     * truncating occurs, the string is further truncated so that the substring
     * may be appended without exceeding the desired length.
     *
     * @param  int    $length    Desired length of the truncated string
     * @param  string $substring The substring to append if it can fit
     * @return Str
     */
    public function truncate(int $length, string $substring = ''): Str
    {
        $this->str = libstr_truncate($this->str, $length, $substring);
        return $this;
    }

    /**
     * Returns an UpperCamelCase version of the supplied string. It trims
     * surrounding spaces, capitalizes letters following digits, spaces, dashes
     * and underscores, and removes spaces, dashes, underscores.
     *
     * @return Str
     */
    public function upperCamelize(): Str
    {
        $this->str = libstr_upperCamelize($this->str);
        return $this;
    }

    /**
     * Surrounds $str with the given substring.
     *
     * @param  string $substring The substring to add to both sides
     * @return Str
     */
    public function surround(string $substring): Str
    {
        $this->str = libstr_surround($this->str, $substring);
        return $this;
    }

    /**
     * Returns a case swapped version of the string.
     *
     * @return Str
     */
    public function swapCase(): Str
    {
        $this->str = libstr_swapCase($this->str);
        return $this;
    }

    /**
     * Returns a string with smart quotes, ellipsis characters, and dashes from
     * Windows-1252 (commonly used in Word documents) replaced by their ASCII
     * equivalents.
     *
     * @return Str
     */
    public function tidy(): Str
    {
        $this->str = libstr_tidy($this->str);
        return $this;
    }

    /**
     * Returns a trimmed string with the first letter of each word capitalized.
     * Also accepts an array, $ignore, allowing you to list words not to be
     * capitalized.
     *
     * @param  array $ignore An array of words not to capitalize
     * @return Str
     */
    public function titleize(array $ignore = []): Str
    {
        $this->str = libstr_titleize($this->str, $ignore);
        return $this;
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
     * @return bool A boolean value for the string
     */
    public function toBoolean(): bool
    {
        return libstr_toBoolean($this->str);
    }

    /**
     * Converts each tab in the string to some number of spaces, as defined by
     * $tabLength. By default, each tab is converted to 4 consecutive spaces.
     *
     * @param  int $tabLength Number of spaces to replace each tab with
     * @return Str
     */
    public function toSpaces(int $tabLength = 4): Str
    {
        $this->str = libstr_toSpaces($this->str, $tabLength);
        return $this;
    }

    /**
     * Converts each occurrence of some consecutive number of spaces, as
     * defined by $tabLength, to a tab. By default, each 4 consecutive spaces
     * are converted to a tab.
     *
     * @param  int $tabLength Number of spaces to replace with a tab
     * @return Str
     */
    public function toTabs(int $tabLength = 4): Str
    {
        $this->str = libstr_toTabs($this->str, $tabLength);
        return $this;
    }

    /**
     * Converts the first character of each word in the string to uppercase.
     *
     * @return Str
     */
    public function toTitleCase(): Str
    {
        $this->str = libstr_toTitleCase($this->str);
        return $this;
    }

    /**
     * Returns a lowercase and trimmed string separated by underscores.
     * Underscores are inserted before uppercase characters (with the exception
     * of the first character of the string), and in place of spaces as well as
     * dashes.
     *
     * @return Str
     */
    public function underscored(): Str
    {
        $this->str = libstr_underscored($this->str);
        return $this;
    }

    /**
     * Move substring of desired $length to $destination index of the original $str.
     * In case $destination is less than $length returns $str untouched.
     *
     * @param  int $start
     * @param  int $length
     * @param  int $destination
     * @return Str
     */
    public function move(int $start, int $length, int $destination): Str
    {
        $this->str = libstr_move($this->str, $start, $length, $destination);
        return $this;
    }

    /**
     * Replaces substring in the original $str of $length with given $substr.
     *
     * @param  int    $start
     * @param  int    $length
     * @param  string $substr
     * @return Str
     */
    public function overwrite(int $start, int $length, string $substr): Str
    {
        $this->str = libstr_overwrite($this->str, $start, $length, $substr);
        return $this;
    }

    /**
     * Returns a snake_case version of the string.
     *
     * @return Str
     */
    public function snakeize(): Str
    {
        $this->str = libstr_snakeize($this->str);
        return $this;
    }
}
