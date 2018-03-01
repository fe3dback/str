<?php

declare(strict_types=1);

namespace Str;

use \Str\Lib\StrMB;

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
        $this->str = StrMB::substr($this->str, $start, $length);
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
        return StrMB::hasPrefix($this->str, $prefix);
    }

    /**
     * Check if the string has $suffix at the end
     *
     * @param  string $suffix
     * @return bool
     */
    public function hasSuffix(string $suffix): bool
    {
        return StrMB::hasSuffix($this->str, $suffix);
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
        $this->str = StrMB::ensureLeft($this->str, $check);
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
        $this->str = StrMB::ensureRight($this->str, $check);
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
        return StrMB::contains($this->str, $sub);
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
        $this->str = StrMB::replace($this->str, $old, $new, $times);
        return $this;
    }

    /**
     * Make a string lowercase
     *
     * @return Str
     */
    public function toLowerCase(): Str
    {
        $this->str = StrMB::toLowerCase($this->str);
        return $this;
    }

    /**
     * Make a string uppercase
     *
     * @return Str
     */
    public function toUpperCase(): Str
    {
        $this->str = StrMB::toUpperCase($this->str);
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
        $this->str = StrMB::trim($this->str, $chars);
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
        $this->str = StrMB::trimLeft($this->str, $chars);
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
        $this->str = StrMB::trimRight($this->str, $chars);
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
        $this->str = StrMB::append($this->str, $sub);
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
        $this->str = StrMB::prepend($this->str, $sub);
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
        $this->str = StrMB::at($this->str, $pos);
        return $this;
    }

    /**
     * Returns an array consisting of the characters in the string.
     *
     * @return array An array of string chars
     */
    public function chars(): array
    {
        return StrMB::chars($this->str);
    }

    /**
     * Return string length
     *
     * @return int
     */
    public function length(): int
    {
        return StrMB::length($this->str);
    }

    /**
     * Returns the first $length characters of the string.
     *
     * @param  int $length Number of characters to retrieve from the start
     * @return Str
     */
    public function first(int $length = 1): Str
    {
        $this->str =  StrMB::first($this->str, $length);
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
        $this->str = StrMB::last($this->str, $length);
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
        return StrMB::indexOf($this->str, $needle, $offset);
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
        return StrMB::indexOfLast($this->str, $needle, $offset);
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
        return StrMB::countSubstr($this->str, $needle, $caseSensitive);
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
        return StrMB::containsAll($this->str, $needles, $caseSensitive);
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
        return StrMB::containsAny($this->str, $needles, $caseSensitive);
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
        return StrMB::startsWith($this->str, $substring, $caseSensitive);
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
        return StrMB::startsWithAny($this->str, $substrings, $caseSensitive);
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
        return StrMB::endsWith($this->str, $substring, $caseSensitive);
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
        return StrMB::endsWithAny($this->str, $substrings, $caseSensitive);
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
        $this->str = StrMB::pad($this->str, $length, $padStr, $padType);
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

        $this->str = StrMB::applyPadding($this->str, (int)floor($padding / 2), (int)ceil($padding / 2),
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
        $this->str = StrMB::applyPadding($this->str, $length - \mb_strlen($this->str), 0, $padStr);
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
        $this->str = StrMB::applyPadding($this->str, 0, $length - \mb_strlen($this->str), $padStr);
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
        $this->str = StrMB::insert($this->str, $substring, $index);
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
        $this->str = StrMB::removeLeft($this->str, $substring);
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
        $this->str = StrMB::removeRight($this->str, $substring);
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
        $this->str = StrMB::repeat($this->str, $multiplier);
        return $this;
    }

    /**
     * Returns a reversed string. A multi-byte version of strrev().
     *
     * @return Str
     */
    public function reverse(): Str
    {
        $this->str = StrMB::reverse($this->str);
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
        $this->str = StrMB::shuffle($this->str);
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
        $this->str = StrMB::between($this->str, $start, $end, $offset);
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
        $this->str = StrMB::camelize($this->str);
        return $this;
    }

    /**
     * Converts the first character of the string to lower case.
     *
     * @return Str
     */
    public function lowerCaseFirst(): Str
    {
        $this->str = StrMB::lowerCaseFirst($this->str);
        return $this;
    }

    /**
     * Converts the first character of the supplied string to upper case.
     *
     * @return Str
     */
    public function upperCaseFirst(): Str
    {
        $this->str = StrMB::upperCaseFirst($this->str);
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
        $this->str = StrMB::collapseWhitespace($this->str);
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
        $this->str = StrMB::regexReplace($this->str, $pattern, $replacement, $options);
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
        $this->str = StrMB::dasherize($this->str);
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
        $this->str = StrMB::delimit($this->str, $delimiter);
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
        return StrMB::isUUIDv4($this->str);
    }

    /**
     * Returns true if the string contains a lower case char, false otherwise.
     *
     * @return bool Whether or not the string contains a lower case character.
     */
    public function hasLowerCase(): bool
    {
        return StrMB::matchesPattern($this->str, '.*[[:lower:]]');
    }

    /**
     * Returns true if the string contains an upper case char, false otherwise.
     *
     * @return bool Whether or not the string contains an upper case character.
     */
    public function hasUpperCase(): bool
    {
        return StrMB::matchesPattern($this->str, '.*[[:upper:]]');
    }

    /**
     * Returns true if $str matches the supplied pattern, false otherwise.
     *
     * @param  string $pattern Regex pattern to match against
     * @return bool            Whether or not $str matches the pattern
     */
    public function matchesPattern(string $pattern): bool
    {
        return StrMB::matchesPattern($this->str, $pattern);
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
        $this->str = StrMB::htmlDecode($this->str, $flags);
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
        $this->str = StrMB::htmlEncode($this->str, $flags);
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
        $this->str = StrMB::humanize($this->str);
        return $this;
    }

    /**
     * Returns true if the string contains only alphabetic chars, false otherwise.
     *
     * @return bool Whether or not $str contains only alphabetic chars
     */
    public function isAlpha(): bool
    {
        return StrMB::isAlpha($this->str);
    }

    /**
     * Returns true if the string contains only alphabetic and numeric
     * chars, false otherwise.
     *
     * @return bool Whether or not $str contains only alphanumeric chars
     */
    public function isAlphanumeric(): bool
    {
        return StrMB::isAlphanumeric($this->str);
    }

    /**
     * Returns true if the string is base64 encoded, false otherwise.
     *
     * @return bool Whether or not $str is base64 encoded
     */
    public function isBase64(): bool
    {
        return StrMB::isBase64($this->str);
    }

    /**
     * Returns true if the string contains only whitespace chars, false otherwise.
     *
     * @return bool Whether or not $str contains only whitespace characters
     */
    public function isBlank(): bool
    {
        return StrMB::isBlank($this->str);
    }

    /**
     * Returns true if the string contains only hexadecimal chars, false otherwise.
     *
     * @return bool Whether or not $str contains only hexadecimal chars
     */
    public function isHexadecimal(): bool
    {
        return StrMB::isHexadecimal($this->str);
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
        return StrMB::isJson($this->str);
    }

    /**
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * @return bool Whether or not $str contains only lower case characters
     */
    public function isLowerCase(): bool
    {
        return StrMB::isLowerCase($this->str);
    }

    /**
     * Returns true if the string is serialized, false otherwise.
     *
     * @return bool Whether or not $str is serialized
     */
    public function isSerialized(): bool
    {
        return StrMB::isSerialized($this->str);
    }

    /**
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * @return bool Whether or not $str contains only lower case characters
     */
    public function isUpperCase(): bool
    {
        return StrMB::isUpperCase($this->str);
    }

    /**
     * Splits on newlines and carriage returns, returning an array of Stringy
     * objects corresponding to the lines in the string.
     *
     * @return array of strings
     */
    public function lines(): array
    {
        return StrMB::lines($this->str);
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
        return StrMB::split($this->str, $pattern, $limit);
    }

    /**
     * Returns the longest common prefix between the string and $otherStr.
     *
     * @param  string $otherStr Second string for comparison
     * @return Str
     */
    public function longestCommonPrefix(string $otherStr): Str
    {
        $this->str = StrMB::longestCommonPrefix($this->str, $otherStr);
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
        $this->str = StrMB::longestCommonSuffix($this->str, $otherStr);
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
        $this->str = StrMB::longestCommonSubstring($this->str, $otherStr);
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
        $this->str = StrMB::safeTruncate($this->str, $length, $substring);
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
        $this->str = StrMB::slugify($this->str, $replacement, $language);
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
        $this->str = StrMB::toAscii($this->str, $language, $removeUnsupported);
        return $this;
    }

    /**
     * Returns the replacements for the toAscii() method.
     *
     * @return array An array of replacements.
     */
    public function charsArray(): array
    {
        return StrMB::charsArray();
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
        return StrMB::langSpecificCharsArray($language);
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
        $this->str = StrMB::slice($this->str, $start, $end);
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
        $this->str = StrMB::stripWhitespace($this->str);
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
        $this->str = StrMB::truncate($this->str, $length, $substring);
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
        $this->str = StrMB::upperCamelize($this->str);
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
        $this->str = StrMB::surround($this->str, $substring);
        return $this;
    }

    /**
     * Returns a case swapped version of the string.
     *
     * @return Str
     */
    public function swapCase(): Str
    {
        $this->str = StrMB::swapCase($this->str);
        return $this;
    }

    /**
     * Returns a string with smart quotes, ellipsis characters, and dashes from
     * Windows-1252 (commonly used in Word documents) replaced by their ASCII
     * equivalents.
     *
     * @return Str
     */
    public function tidy()
    {
        $this->str = StrMB::tidy($this->str);
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
        $this->str = StrMB::titleize($this->str, $ignore);
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
        return StrMB::toBoolean($this->str);
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
        $this->str = StrMB::toSpaces($this->str, $tabLength);
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
        $this->str = StrMB::toTabs($this->str, $tabLength);
        return $this;
    }

    /**
     * Converts the first character of each word in the string to uppercase.
     *
     * @return Str
     */
    public function toTitleCase(): Str
    {
        $this->str = StrMB::toTitleCase($this->str);
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
        $this->str = StrMB::underscored($this->str);
        return $this;
    }
}
