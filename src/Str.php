<?php

declare(strict_types=1);

namespace Str;

class Str
{
    /**
    * @var string
    * @internal
    */
    private $__str_buffer;

    public function __construct($str)
    {
        $this->__str_buffer = $str;
    }

    public function __toString(): string
    {
        return $this->__str_buffer;
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
        if ($length === 0) {
            $length = \mb_strlen($this->__str_buffer);
        }

        $this->__str_buffer = \mb_substr($this->__str_buffer, $start, $length);

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
        if ($this->__str_buffer === '' || $prefix === '') { return false; }

        return (0 === \mb_strpos($this->__str_buffer, $prefix));
    }

    /**
     * Check if the string has $suffix at the end
     *
     * @param  string $suffix
     * @return bool
     */
    public function hasSuffix(string $suffix): bool
    {
        if ($this->__str_buffer === '' || $suffix === '') { return false; }

        return \mb_substr($this->__str_buffer, -\mb_strlen($suffix)) === $suffix;
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
        if ($this->hasPrefix($check)) { return $this; }

        $this->prepend($check);

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
        if ($this->hasSuffix($check)) { return $this; }

        $this->append($check);

        return $this;
    }

    /**
     * Check if $haystack contains $needle substring
     *
     * @param string $needle
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function contains(string $needle, bool $caseSensitive = true): bool
    {
        if ($this->__str_buffer === '' || $needle === '') { return false; }

        if ($caseSensitive) {
            return false !== \mb_strpos($this->__str_buffer, $needle);
        }

        return (false !== \mb_stripos($this->__str_buffer, $needle));
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
     * @param int     $limit
     *
     * @return Str
     */
    public function replace(string $old, string $new, int $limit = -1): Str
    {
        if ($old === $new || $limit === 0) { return $this; }

        $oldCount = $this->countSubstr($old);

        if ($oldCount === 0) { return $this; }

        if ($limit < 0 || $oldCount < $limit) {
            $limit = $oldCount;
        }

        $result = $this->__str_buffer;
        $offset = 0;

        while (--$limit >= 0) {
            $pos = \mb_strpos($result, $old, $offset);
            $offset = $pos + \mb_strlen($old);
            $result = \mb_substr($result, 0, $pos) . $new . \mb_substr($result, $offset);
        }

        $this->__str_buffer = $result;
        return $this;
    }

    /**
     * Make a string lowercase
     *
     * @return Str
     */
    public function toLowerCase(): Str
    {
        $this->__str_buffer = \mb_strtolower($this->__str_buffer);

        return $this;
    }

    /**
     * Make a string uppercase
     *
     * @return Str
     */
    public function toUpperCase(): Str
    {
        $this->__str_buffer = \mb_strtoupper($this->__str_buffer);

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
        $chars = $chars ? \preg_quote($chars, '/') : '\s';
        $this->__str_buffer = \mb_ereg_replace("^[$chars]+|[$chars]+\$", '', $this->__str_buffer);

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
        $chars = $chars ? \preg_quote($chars, '/') : '\s';
        $this->__str_buffer = \mb_ereg_replace("^[$chars]+", '', $this->__str_buffer);

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
        $chars = $chars ? \preg_quote($chars, '/') : '\s';
        $this->__str_buffer = \mb_ereg_replace("[$chars]+\$", '', $this->__str_buffer);

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
        $this->__str_buffer .= $sub;

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
        $this->__str_buffer = $sub . $this->__str_buffer;

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
        $this->substr($pos, 1);

        return $this;
    }

    /**
     * Returns an array consisting of the characters in the string.
     *
     * @return array An array of string chars
     */
    public function chars(): array
    {
        if ($this->__str_buffer === '') { return []; }

        $chars = [];

        for ($i = 0, $iMax = $this->length(); $i < $iMax; $i++) {
            $tmp = $this->__str_buffer;
            $chars[] = (string)$this->at($i);
            $this->__str_buffer = $tmp;
        }

        return $chars;
    }

    /**
     * Return string length
     *
     * @return int
     */
    public function length(): int
    {
        return \mb_strlen($this->__str_buffer);
    }

    /**
     * Returns the first $length characters of the string.
     *
     * @param  int $length Number of characters to retrieve from the start
     * @return Str
     */
    public function first(int $length = 1): Str
    {
        if ($length <= 0) {
            $this->__str_buffer = '';
            return $this;
        }

        $this->substr(0, $length);

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
        if ($length <= 0) {
            $this->__str_buffer = '';
            return $this;
        }

        $this->substr(-$length);

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
        if ($needle === '' || $this->__str_buffer === '')  { return -1; }

        $maxLen = \mb_strlen($this->__str_buffer);

        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }

        if ($offset > $maxLen)  { return -1; }

        if ($offset < 0)  { return -1; }

        $pos = \mb_strpos($this->__str_buffer, $needle, $offset);

        return false === $pos ? -1 : $pos;
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
        if ($needle === '' || $this->__str_buffer === '') { return -1; }

        $maxLen = \mb_strlen($this->__str_buffer);

        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }

        if ($offset > $maxLen) { return -1; }

        if ($offset < 0) { return -1; }

        $pos = \mb_strrpos($this->__str_buffer, $needle, $offset);

        return false === $pos ? -1 : $pos;
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
        if ($caseSensitive) {
            return \mb_substr_count($this->__str_buffer, $needle);
        }

        $tmp = $this->__str_buffer;
        $this->__str_buffer = \mb_strtoupper($this->__str_buffer);
        $needle = \mb_strtoupper($needle);
        $result = \mb_substr_count($this->__str_buffer, $needle);

        $this->__str_buffer = $tmp;

        return $result;
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
        if (empty($needles)) { return false; }

        foreach ($needles as $needle) {
            if (!$this->contains($needle, $caseSensitive)) { return false; }
        }

        return true;
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
        if (empty($needles)) { return false; }

        foreach ($needles as $needle) {
            if ($this->contains($needle, $caseSensitive)) { return true; }
        }

        return false;
    }

    /**
     * Returns true if the string begins with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @todo refactor
     *
     * @param  string $substring     The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                  Whether or not $str starts with $substring
     */
    public function startsWith(string $substring, bool $caseSensitive = true): bool
    {
        if ($caseSensitive) {
            return $this->hasPrefix($substring);
        }

        // need a tmp var to avoid mutating the original string.
        // i know how ugly this looks.
        $tmp = $this->__str_buffer;
        $this->__str_buffer = \mb_strtoupper($this->__str_buffer);

        $result = $this->hasPrefix(\mb_strtoupper($substring));

        $this->__str_buffer = $tmp;

        return $result;
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
        if (empty($substrings)) { return false; }

        foreach ($substrings as $substring) {
            if ($this->startsWith($substring, $caseSensitive)) { return true; }
        }

        return false;
    }

    /**
     * Returns true if the string ends with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @todo refactor
     * @todo NEED UNIT TEST WITH safeWrap
     *
     * @param  string $substring     The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool                  Whether or not $str ends with $substring
     */
    public function endsWith(string $substring, bool $caseSensitive = true): bool
    {
        if ($caseSensitive) {
            return $this->hasSuffix($substring);
        }

        return $this->safeWrap(function () use ($substring) {
            $this->__str_buffer = \mb_strtoupper($this->__str_buffer);
            return $this->hasSuffix(\mb_strtoupper($substring));
        });

//        $this->__str_buffer = \mb_strtoupper($this->__str_buffer);
//        return $this->hasSuffix($substring);
//
//        // need a tmp var to avoid mutating the original string.
//        // i know how ugly this looks.
//        $tmp = $this->__str_buffer;
//        $this->__str_buffer = \mb_strtoupper($this->__str_buffer);
//
//        $result = $this->hasSuffix(\mb_strtoupper($substring));
//
//        $this->__str_buffer = $tmp;
//
//        return $result;
    }

    private function safeWrap(callable $f) {
        $tmp = $this->__str_buffer;
        $r = $f();
        $this->__str_buffer = $tmp;
        return $r;
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
        if (empty($substrings)) { return false; }

        foreach ($substrings as $substring) {
            if ($this->endsWith($substring, $caseSensitive)) { return true; }
        }

        return false;
    }

    /**
     * Returns a new string of a given length such that both sides of the
     * string are padded.
     *
     * @param  int    $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return Str
     */
    public function padBoth(int $length, string $padStr = ' '): Str
    {
        $padding = $length - \mb_strlen($this->__str_buffer);
        $this->applyPadding((int)floor($padding / 2), (int)ceil($padding / 2), $padStr);

        return $this;
    }

    /**
     * Adds the specified amount of left and right padding to the given string.
     * The default character used is a space.
     *
     * @param  int    $left   Length of left padding
     * @param  int    $right  Length of right padding
     * @param  string $padStr String used to pad
     * @return string
     *
     * @internal
     */
    private function applyPadding(int $left = 0, int $right = 0, string $padStr = ' '): Str
    {
        if ($right + $left <= 0) { return $this->__str_buffer; }
        if ('' === $padStr) { return $this->__str_buffer;}

        if (1 === \mb_strlen($padStr)) {
            $this->__str_buffer = str_repeat($padStr, $left) . $this->__str_buffer . str_repeat($padStr, $right);
            return $this;
        }

        $leftPadding = \mb_substr(str_repeat($padStr, $left), 0, $left);
        $rightPadding = \mb_substr(str_repeat($padStr, $right), 0, $right);

        $this->__str_buffer = $leftPadding . $this->__str_buffer . $rightPadding;
        return $this;
    }

    /**
     * Returns a new string of a given length such that the beginning of the
     * string is padded.
     *
     * @param  int    $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return Str
     */
    public function padLeft(int $length, string $padStr = ' '): Str
    {
        $this->applyPadding($length - \mb_strlen($this->__str_buffer), 0, $padStr);

        return $this;
    }

    /**
     * Returns a new string of a given length such that the end of the string
     * is padded.
     *
     * @param  int    $length Desired string length after padding
     * @param  string $padStr String used to pad, defaults to space
     * @return Str
     */
    public function padRight(int $length, string $padStr = ' '): Str
    {
        $this->applyPadding(0, $length - \mb_strlen($this->__str_buffer), $padStr);

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
        if (0 === $index) {
            $this->__str_buffer = $substring . $this->__str_buffer;
            return $this;
        }

        if ($substring === '') { return $this; }

        $this->__str_buffer = \mb_substr($this->__str_buffer, 0, $index) . $substring . \mb_substr($this->__str_buffer, $index);

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
        if ('' !== $substring && $this->hasPrefix($substring)) {
            $this->__str_buffer = \mb_substr($this->__str_buffer, \mb_strlen($substring));
        }

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
        if ('' !== $substring && $this->hasSuffix($substring)) {
            $this->__str_buffer = \mb_substr($this->__str_buffer, 0, \mb_strlen($this->__str_buffer) - \mb_strlen($substring));
        }

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
        $this->__str_buffer = \str_repeat($this->__str_buffer, $multiplier);

        return $this;
    }

    /**
     * Returns a reversed string. A multi-byte version of strrev().
     *
     * @return Str
     */
    public function reverse(): Str
    {
        if ('' === $this->__str_buffer) { return $this; }

        $reversed = '';

        // Loop from last index of string to first
        $i = \mb_strlen($this->__str_buffer);

        while ($i--) {
            $reversed .= \mb_substr($this->__str_buffer, $i, 1);
        }

        $this->__str_buffer = $reversed;

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
        $indexes = \range(0, \mb_strlen($this->__str_buffer) - 1);
        \shuffle($indexes);

        $shuffledStr = '';

        foreach ($indexes as $i) {
            $shuffledStr .= \mb_substr($this->__str_buffer, $i, 1);
        }

        $this->__str_buffer = $shuffledStr;

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
        $startIndex = $this->indexOf($start, $offset);

        if ($startIndex === -1) {
            $this->__str_buffer = '';
            return $this;
        }

        $substrIndex = $startIndex + \mb_strlen($start);
        $endIndex = $this->indexOf($end, $substrIndex);

        if ($endIndex === -1 || $endIndex === $substrIndex) {
            $this->__str_buffer = '';
            return $this;
        }

        $this->substr($substrIndex, $endIndex - $substrIndex);

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
        $this
            ->trim()
            ->lowerCaseFirst();

        $this->__str_buffer = preg_replace('/^[-_]+/', '', $this->__str_buffer);

        $this->__str_buffer = preg_replace_callback('/[-_\s]+(.)?/u', function ($match)
        {
            if (isset($match[1])) { return \mb_strtoupper($match[1]); }

            return '';
        }, $this->__str_buffer);

        $this->__str_buffer = preg_replace_callback('/[\d]+(.)?/u', function ($match) {
            return \mb_strtoupper($match[0]);
        }, $this->__str_buffer);

        return $this;
    }

    /**
     * Converts the first character of the string to lower case.
     *
     * @return Str
     */
    public function lowerCaseFirst(): Str
    {
        if ('' === $this->__str_buffer) { return $this; }

        $first = \mb_substr($this->__str_buffer, 0, 1);
        $rest = \mb_substr($this->__str_buffer, 1);
        $this->__str_buffer = \mb_strtolower($first) . $rest;

        return $this;
    }

    /**
     * Converts the first character of the supplied string to upper case.
     *
     * @return Str
     */
    public function upperCaseFirst(): Str
    {
        if ('' === $this->__str_buffer) { return $this; }

        $first = \mb_substr($this->__str_buffer, 0, 1);
        $rest = \mb_substr($this->__str_buffer, 1);
        $this->__str_buffer = \mb_strtoupper($first) . $rest;

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
        $this
            ->regexReplace('[[:space:]]+', ' ')
            ->trim();

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
        $this->__str_buffer = \mb_ereg_replace($pattern, $replacement, $this->__str_buffer, $options);

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
        $this->delimit('-');

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
        $this->trim()
            ->regexReplace('\B([A-Z])', '-\1')
            ->toLowerCase()
            ->regexReplace('[-_\s]+', $delimiter);

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
        $l = '[a-f0-9]';
        $pattern = "/^{$l}{8}-?{$l}{4}-?4{$l}{3}-?[89ab]{$l}{3}-?{$l}{12}\Z/";

        return (bool)\preg_match($pattern, $this->__str_buffer);
    }

    /**
     * Returns true if the string contains a lower case char, false otherwise.
     *
     * @return bool Whether or not the string contains a lower case character.
     */
    public function hasLowerCase(): bool
    {
        return $this->matchesPattern('.*[[:lower:]]');
    }

    /**
     * Returns true if the string contains an upper case char, false otherwise.
     *
     * @return bool Whether or not the string contains an upper case character.
     */
    public function hasUpperCase(): bool
    {
        return $this->matchesPattern('.*[[:upper:]]');
    }

    /**
     * Returns true if $str matches the supplied pattern, false otherwise.
     *
     * @param  string $pattern Regex pattern to match against
     * @return bool            Whether or not $str matches the pattern
     */
    public function matchesPattern(string $pattern): bool
    {
        return \mb_ereg_match($pattern, $this->__str_buffer);
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
        $this->__str_buffer = \html_entity_decode($this->__str_buffer, $flags);

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
        $this->__str_buffer = \htmlentities($this->__str_buffer, $flags);

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
        $this->__str_buffer = \str_replace(['_id', '_'], ['', ' '], $this->__str_buffer);
        $this
            ->trim()
            ->upperCaseFirst();

        return $this;
    }

    /**
     * Returns true if the string contains only alphabetic chars, false otherwise.
     *
     * @return bool Whether or not $str contains only alphabetic chars
     */
    public function isAlpha(): bool
    {
        return $this->matchesPattern('^[[:alpha:]]*$');
    }

    /**
     * Returns true if the string contains only alphabetic and numeric
     * chars, false otherwise.
     *
     * @return bool Whether or not $str contains only alphanumeric chars
     */
    public function isAlphanumeric(): bool
    {
        return $this->matchesPattern('^[[:alnum:]]*$');
    }

    /**
     * Returns true if the string is base64 encoded, false otherwise.
     *
     * @return bool Whether or not $str is base64 encoded
     */
    public function isBase64(): bool
    {
        return (base64_encode(base64_decode($this->__str_buffer)) === $this->__str_buffer);
    }

    /**
     * Returns true if the string contains only whitespace chars, false otherwise.
     *
     * @return bool Whether or not $str contains only whitespace characters
     */
    public function isBlank(): bool
    {
        return $this->matchesPattern('^[[:space:]]*$');
    }

    /**
     * Returns true if the string contains only hexadecimal chars, false otherwise.
     *
     * @return bool Whether or not $str contains only hexadecimal chars
     */
    public function isHexadecimal(): bool
    {
        return $this->matchesPattern('^[[:xdigit:]]*$');
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
        if ('' === $this->__str_buffer) { return false; }

        json_decode($this->__str_buffer);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * @return bool Whether or not $str contains only lower case characters
     */
    public function isLowerCase(): bool
    {
        return $this->matchesPattern('^[[:lower:]]*$');
    }

    /**
     * Returns true if the string is serialized, false otherwise.
     *
     * @return bool Whether or not $str is serialized
     */
    public function isSerialized(): bool
    {
        return ($this->__str_buffer === 'b:0;') || (@unserialize($this->__str_buffer, []) !== false);
    }

    /**
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * @return bool Whether or not $str contains only lower case characters
     */
    public function isUpperCase(): bool
    {
        return $this->matchesPattern('^[[:upper:]]*$');
    }

    /**
     * Splits on newlines and carriage returns, returning an array of strings corresponding to the lines in the string.
     *
     * We don't check for ascii here.
     *
     * @return array of strings
     */
    public function lines(): array
    {
        return $this->split('[\r\n]{1,2}');
    }

    /**
     * Splits the string with the provided regular expression, returning an
     * array of strings. An optional integer $limit will truncate the
     * results.
     *
     * @param  string $pattern The regex with which to split the string
     * @param  int    $limit   Optional maximum number of results to return
     * @return array of strings
     */
    public function split(string $pattern, int $limit = -1): array
    {
        if (0 === $limit || '' === $this->__str_buffer) { return []; }
        if ($pattern === '') { return [$this->__str_buffer]; }

        // mb_split returns the remaining unsplit string in the last index when
        // supplying a limit
        $limit = ($limit > 0) ? $limit + 1 : -1;

        $array = \mb_split($pattern, $this->__str_buffer, $limit);

        if ($limit > 0 && \count($array) === $limit) { array_pop($array); }

        $result = [];
        foreach ($array as $string) {
            $result[] = $string;
        }

        return $result;
    }

    /**
     * Returns the longest common prefix between the string and $otherStr.
     *
     * @param  string $otherStr Second string for comparison
     * @return Str
     */
    public function longestCommonPrefix(string $otherStr): Str
    {
        $maxLength = min(\mb_strlen($this->__str_buffer), \mb_strlen($otherStr));

        $longestCommonPrefix = '';

        for ($i = 0; $i < $maxLength; $i++) {
            $char = \mb_substr($this->__str_buffer, $i, 1);

            if ($char === \mb_substr($otherStr, $i, 1)) {
                $longestCommonPrefix .= $char;
            } else { break; }
        }

        $this->__str_buffer = $longestCommonPrefix;

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
        $maxLength = min(\mb_strlen($this->__str_buffer), \mb_strlen($otherStr));

        $longestCommonSuffix = '';

        for ($i = 1; $i <= $maxLength; $i++) {
            $char = \mb_substr($this->__str_buffer, -$i, 1);

            if ($char === \mb_substr($otherStr, -$i, 1)) {
                $longestCommonSuffix = $char . $longestCommonSuffix;
            } else { break; }
        }

        $this->__str_buffer = $longestCommonSuffix;

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
        // Uses dynamic programming to solve
        // http://en.wikipedia.org/wiki/Longest_common_substring_problem
        $strLength = \mb_strlen($this->__str_buffer);
        $otherLength = \mb_strlen($otherStr);

        // Return if either string is empty
        if ($strLength === 0 || $otherLength === 0) {
            $this->__str_buffer = '';
            return $this;
        }

        $len = 0;
        $end = 0;
        $table = array_fill(0, $strLength + 1,
            array_fill(0, $otherLength + 1, 0));

        for ($i = 1; $i <= $strLength; $i++) {
            for ($j = 1; $j <= $otherLength; $j++) {
                $strChar = \mb_substr($this->__str_buffer, $i - 1, 1);
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

        $this->__str_buffer = \mb_substr($this->__str_buffer, $end - $len, $len);

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
        if ($length >= \mb_strlen($this->__str_buffer)) { return $this; }

        // Need to further trim the string so we can append the substring
        $substringLength = \mb_strlen($substring);
        $length -= $substringLength;

        $truncated = \mb_substr($this->__str_buffer, 0, $length);

        // If the last word was truncated
        if (\mb_strpos($this->__str_buffer, ' ', $length - 1) !== $length) {
            // Find pos of the last occurrence of a space, get up to that
            $lastPos = \mb_strrpos($truncated, ' ', 0);
            if ($lastPos !== false) {
                $truncated = \mb_substr($truncated, 0, $lastPos);
            }
        }

        $this->__str_buffer = $truncated . $substring;

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
        $this->toAscii($language);

        $this->__str_buffer = \str_replace('@', $replacement, $this->__str_buffer);
        $quotedReplacement = \preg_quote($replacement, '');
        $pattern = "/[^a-zA-Z\d\s-_$quotedReplacement]/u";
        $this->__str_buffer = \preg_replace($pattern, '', $this->__str_buffer);

        $this
            ->toLowerCase()
            ->delimit($replacement)
            ->removeLeft($replacement)
            ->removeRight($replacement);

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
     * @todo check if it still works.
     *
     * @param  string $language          Language of the source string
     * @param  bool   $removeUnsupported Whether or not to remove the unsupported characters
     * @return Str
     */
    public function toAscii(string $language = 'en', bool $removeUnsupported = true): Str
    {
        $langSpecific = $this->langSpecificCharsArray($language);

        if (!empty($langSpecific)) {
            $this->__str_buffer = \str_replace($langSpecific[0], $langSpecific[1], $this->__str_buffer);
        }

        // @todo optimize
        foreach ($this->charsArray() as $key => $value) {
            /** @noinspection ForeachSourceInspection */
            foreach ($value as $item) {
                $this->replace($item, (string)$key);
            }
        }

        if ($removeUnsupported) {
            $this->__str_buffer = \preg_replace('/[^\x20-\x7E]/', '', $this->__str_buffer);
        }

        return $this;
    }

    /**
     * Returns the replacements for the toAscii() method.
     *
     * @todo this shouldn't be a function.
     *
     * @return array An array of replacements.
     */
    public function charsArray(): array
    {
        /** @noinspection UselessReturnInspection */
        return $charsArray = [
            '0'     => ['°', '₀', '۰', '０'],
            '1'     => ['¹', '₁', '۱', '１'],
            '2'     => ['²', '₂', '۲', '２'],
            '3'     => ['³', '₃', '۳', '３'],
            '4'     => ['⁴', '₄', '۴', '٤', '４'],
            '5'     => ['⁵', '₅', '۵', '٥', '５'],
            '6'     => ['⁶', '₆', '۶', '٦', '６'],
            '7'     => ['⁷', '₇', '۷', '７'],
            '8'     => ['⁸', '₈', '۸', '８'],
            '9'     => ['⁹', '₉', '۹', '９'],
            'a'     => ['à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ',
                'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ā', 'ą', 'å',
                'α', 'ά', 'ἀ', 'ἁ', 'ἂ', 'ἃ', 'ἄ', 'ἅ', 'ἆ', 'ἇ',
                'ᾀ', 'ᾁ', 'ᾂ', 'ᾃ', 'ᾄ', 'ᾅ', 'ᾆ', 'ᾇ', 'ὰ', 'ά',
                'ᾰ', 'ᾱ', 'ᾲ', 'ᾳ', 'ᾴ', 'ᾶ', 'ᾷ', 'а', 'أ', 'အ',
                'ာ', 'ါ', 'ǻ', 'ǎ', 'ª', 'ა', 'अ', 'ا', 'ａ', 'ä'],
            'b'     => ['б', 'β', 'ب', 'ဗ', 'ბ', 'ｂ'],
            'c'     => ['ç', 'ć', 'č', 'ĉ', 'ċ', 'ｃ'],
            'd'     => ['ď', 'ð', 'đ', 'ƌ', 'ȡ', 'ɖ', 'ɗ', 'ᵭ', 'ᶁ', 'ᶑ',
                'д', 'δ', 'د', 'ض', 'ဍ', 'ဒ', 'დ', 'ｄ'],
            'e'     => ['é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ',
                'ệ', 'ë', 'ē', 'ę', 'ě', 'ĕ', 'ė', 'ε', 'έ', 'ἐ',
                'ἑ', 'ἒ', 'ἓ', 'ἔ', 'ἕ', 'ὲ', 'έ', 'е', 'ё', 'э',
                'є', 'ə', 'ဧ', 'ေ', 'ဲ', 'ე', 'ए', 'إ', 'ئ', 'ｅ'],
            'f'     => ['ф', 'φ', 'ف', 'ƒ', 'ფ', 'ｆ'],
            'g'     => ['ĝ', 'ğ', 'ġ', 'ģ', 'г', 'ґ', 'γ', 'ဂ', 'გ', 'گ', 'ｇ'],
            'h'     => ['ĥ', 'ħ', 'η', 'ή', 'ح', 'ه', 'ဟ', 'ှ', 'ჰ', 'ｈ'],
            'i'     => ['í', 'ì', 'ỉ', 'ĩ', 'ị', 'î', 'ï', 'ī', 'ĭ', 'į',
                'ı', 'ι', 'ί', 'ϊ', 'ΐ', 'ἰ', 'ἱ', 'ἲ', 'ἳ', 'ἴ',
                'ἵ', 'ἶ', 'ἷ', 'ὶ', 'ί', 'ῐ', 'ῑ', 'ῒ', 'ΐ', 'ῖ',
                'ῗ', 'і', 'ї', 'и', 'ဣ', 'ိ', 'ီ', 'ည်', 'ǐ', 'ი',
                'इ', 'ی', 'ｉ'],
            'j'     => ['ĵ', 'ј', 'Ј', 'ჯ', 'ج', 'ｊ'],
            'k'     => ['ķ', 'ĸ', 'к', 'κ', 'Ķ', 'ق', 'ك', 'က', 'კ', 'ქ',
                'ک', 'ｋ'],
            'l'     => ['ł', 'ľ', 'ĺ', 'ļ', 'ŀ', 'л', 'λ', 'ل', 'လ', 'ლ', 'ｌ'],
            'm'     => ['м', 'μ', 'م', 'မ', 'მ', 'ｍ'],
            'n'     => ['ñ', 'ń', 'ň', 'ņ', 'ŉ', 'ŋ', 'ν', 'н', 'ن', 'န', 'ნ', 'ｎ'],
            'o'     => ['ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ',
                'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ø', 'ō', 'ő',
                'ŏ', 'ο', 'ὀ', 'ὁ', 'ὂ', 'ὃ', 'ὄ', 'ὅ', 'ὸ', 'ό',
                'о', 'و', 'θ', 'ို', 'ǒ', 'ǿ', 'º', 'ო', 'ओ', 'ｏ',
                'ö'],
            'p'     => ['п', 'π', 'ပ', 'პ', 'پ', 'ｐ'],
            'q'     => ['ყ', 'ｑ'],
            'r'     => ['ŕ', 'ř', 'ŗ', 'р', 'ρ', 'ر', 'რ', 'ｒ'],
            's'     => ['ś', 'š', 'ş', 'с', 'σ', 'ș', 'ς', 'س', 'ص', 'စ', 'ſ', 'ს', 'ｓ'],
            't'     => ['ť', 'ţ', 'т', 'τ', 'ț', 'ت', 'ط', 'ဋ', 'တ', 'ŧ', 'თ', 'ტ', 'ｔ'],
            'u'     => ['ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ',
                'ự', 'û', 'ū', 'ů', 'ű', 'ŭ', 'ų', 'µ', 'у', 'ဉ',
                'ု', 'ူ', 'ǔ', 'ǖ', 'ǘ', 'ǚ', 'ǜ', 'უ', 'उ', 'ｕ',
                'ў', 'ü'],
            'v'     => ['в', 'ვ', 'ϐ', 'ｖ'],
            'w'     => ['ŵ', 'ω', 'ώ', 'ဝ', 'ွ', 'ｗ'],
            'x'     => ['χ', 'ξ', 'ｘ'],
            'y'     => ['ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'ÿ', 'ŷ', 'й', 'ы', 'υ',
                'ϋ', 'ύ', 'ΰ', 'ي', 'ယ', 'ｙ'],
            'z'     => ['ź', 'ž', 'ż', 'з', 'ζ', 'ز', 'ဇ', 'ზ', 'ｚ'],
            'aa'    => ['ع', 'आ', 'آ'],
            'ae'    => ['æ', 'ǽ'],
            'ai'    => ['ऐ'],
            'ch'    => ['ч', 'ჩ', 'ჭ', 'چ'],
            'dj'    => ['ђ', 'đ'],
            'dz'    => ['џ', 'ძ'],
            'ei'    => ['ऍ'],
            'gh'    => ['غ', 'ღ'],
            'ii'    => ['ई'],
            'ij'    => ['ĳ'],
            'kh'    => ['х', 'خ', 'ხ'],
            'lj'    => ['љ'],
            'nj'    => ['њ'],
            'oe'    => ['œ', 'ؤ'],
            'oi'    => ['ऑ'],
            'oii'   => ['ऒ'],
            'ps'    => ['ψ'],
            'sh'    => ['ш', 'შ', 'ش'],
            'shch'  => ['щ'],
            'ss'    => ['ß'],
            'sx'    => ['ŝ'],
            'th'    => ['þ', 'ϑ', 'ث', 'ذ', 'ظ'],
            'ts'    => ['ц', 'ც', 'წ'],
            'uu'    => ['ऊ'],
            'ya'    => ['я'],
            'yu'    => ['ю'],
            'zh'    => ['ж', 'ჟ', 'ژ'],
            '(c)'   => ['©'],
            'A'     => ['Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ',
                'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Å', 'Ā', 'Ą',
                'Α', 'Ά', 'Ἀ', 'Ἁ', 'Ἂ', 'Ἃ', 'Ἄ', 'Ἅ', 'Ἆ', 'Ἇ',
                'ᾈ', 'ᾉ', 'ᾊ', 'ᾋ', 'ᾌ', 'ᾍ', 'ᾎ', 'ᾏ', 'Ᾰ', 'Ᾱ',
                'Ὰ', 'Ά', 'ᾼ', 'А', 'Ǻ', 'Ǎ', 'Ａ', 'Ä'],
            'B'     => ['Б', 'Β', 'ब', 'Ｂ'],
            'C'     => ['Ç','Ć', 'Č', 'Ĉ', 'Ċ', 'Ｃ'],
            'D'     => ['Ď', 'Ð', 'Đ', 'Ɖ', 'Ɗ', 'Ƌ', 'ᴅ', 'ᴆ', 'Д', 'Δ', 'Ｄ'],
            'E'     => ['É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ',
                'Ệ', 'Ë', 'Ē', 'Ę', 'Ě', 'Ĕ', 'Ė', 'Ε', 'Έ', 'Ἐ',
                'Ἑ', 'Ἒ', 'Ἓ', 'Ἔ', 'Ἕ', 'Έ', 'Ὲ', 'Е', 'Ё', 'Э',
                'Є', 'Ə', 'Ｅ'],
            'F'     => ['Ф', 'Φ', 'Ｆ'],
            'G'     => ['Ğ', 'Ġ', 'Ģ', 'Г', 'Ґ', 'Γ', 'Ｇ'],
            'H'     => ['Η', 'Ή', 'Ħ', 'Ｈ'],
            'I'     => ['Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Î', 'Ï', 'Ī', 'Ĭ', 'Į',
                'İ', 'Ι', 'Ί', 'Ϊ', 'Ἰ', 'Ἱ', 'Ἳ', 'Ἴ', 'Ἵ', 'Ἶ',
                'Ἷ', 'Ῐ', 'Ῑ', 'Ὶ', 'Ί', 'И', 'І', 'Ї', 'Ǐ', 'ϒ',
                'Ｉ'],
            'J'     => ['Ｊ'],
            'K'     => ['К', 'Κ', 'Ｋ'],
            'L'     => ['Ĺ', 'Ł', 'Л', 'Λ', 'Ļ', 'Ľ', 'Ŀ', 'ल', 'Ｌ'],
            'M'     => ['М', 'Μ', 'Ｍ'],
            'N'     => ['Ń', 'Ñ', 'Ň', 'Ņ', 'Ŋ', 'Н', 'Ν', 'Ｎ'],
            'O'     => ['Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ',
                'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ø', 'Ō', 'Ő',
                'Ŏ', 'Ο', 'Ό', 'Ὀ', 'Ὁ', 'Ὂ', 'Ὃ', 'Ὄ', 'Ὅ', 'Ὸ',
                'Ό', 'О', 'Θ', 'Ө', 'Ǒ', 'Ǿ', 'Ｏ', 'Ö'],
            'P'     => ['П', 'Π', 'Ｐ'],
            'Q'     => ['Ｑ'],
            'R'     => ['Ř', 'Ŕ', 'Р', 'Ρ', 'Ŗ', 'Ｒ'],
            'S'     => ['Ş', 'Ŝ', 'Ș', 'Š', 'Ś', 'С', 'Σ', 'Ｓ'],
            'T'     => ['Ť', 'Ţ', 'Ŧ', 'Ț', 'Т', 'Τ', 'Ｔ'],
            'U'     => ['Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ',
                'Ự', 'Û', 'Ū', 'Ů', 'Ű', 'Ŭ', 'Ų', 'У', 'Ǔ', 'Ǖ',
                'Ǘ', 'Ǚ', 'Ǜ', 'Ｕ', 'Ў', 'Ü'],
            'V'     => ['В', 'Ｖ'],
            'W'     => ['Ω', 'Ώ', 'Ŵ', 'Ｗ'],
            'X'     => ['Χ', 'Ξ', 'Ｘ'],
            'Y'     => ['Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ', 'Ÿ', 'Ῠ', 'Ῡ', 'Ὺ', 'Ύ',
                'Ы', 'Й', 'Υ', 'Ϋ', 'Ŷ', 'Ｙ'],
            'Z'     => ['Ź', 'Ž', 'Ż', 'З', 'Ζ', 'Ｚ'],
            'AE'    => ['Æ', 'Ǽ'],
            'Ch'    => ['Ч'],
            'Dj'    => ['Ђ'],
            'Dz'    => ['Џ'],
            'Gx'    => ['Ĝ'],
            'Hx'    => ['Ĥ'],
            'Ij'    => ['Ĳ'],
            'Jx'    => ['Ĵ'],
            'Kh'    => ['Х'],
            'Lj'    => ['Љ'],
            'Nj'    => ['Њ'],
            'Oe'    => ['Œ'],
            'Ps'    => ['Ψ'],
            'Sh'    => ['Ш'],
            'Shch'  => ['Щ'],
            'Ss'    => ['ẞ'],
            'Th'    => ['Þ'],
            'Ts'    => ['Ц'],
            'Ya'    => ['Я'],
            'Yu'    => ['Ю'],
            'Zh'    => ['Ж'],
            ' '     => ["\xC2\xA0", "\xE2\x80\x80", "\xE2\x80\x81",
                "\xE2\x80\x82", "\xE2\x80\x83", "\xE2\x80\x84",
                "\xE2\x80\x85", "\xE2\x80\x86", "\xE2\x80\x87",
                "\xE2\x80\x88", "\xE2\x80\x89", "\xE2\x80\x8A",
                "\xE2\x80\xAF", "\xE2\x81\x9F", "\xE3\x80\x80",
                "\xEF\xBE\xA0"],
        ];
    }

    /**
     * Returns language-specific replacements for the toAscii() method.
     * For example, German will map 'ä' to 'ae', while other languages
     * will simply return 'a'.
     *
     * @todo this shouldn't be a function.
     *
     * @param  string $language Language of the source string
     * @return array  An array of replacements.
     */
    public function langSpecificCharsArray(string $language = 'en'): array
    {
        $split = preg_split('/[-_]/', $language);
        $language = strtolower($split[0]);

        $languageSpecific = [
            'de' => [
                ['ä',  'ö',  'ü',  'Ä',  'Ö',  'Ü' ],
                ['ae', 'oe', 'ue', 'AE', 'OE', 'UE'],
            ],
            'bg' => [
                ['х', 'Х', 'щ', 'Щ', 'ъ', 'Ъ', 'ь', 'Ь'],
                ['h', 'H', 'sht', 'SHT', 'a', 'А', 'y', 'Y']
            ]
        ];

        if (isset($languageSpecific[$language])) {
            return $languageSpecific[$language];
        }

        return [];
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
        if ($end === null) {
            $length = \mb_strlen($this->__str_buffer);
        }
        elseif ($end >= 0 && $end <= $start) {
            $this->__str_buffer = '';
            return $this;
        }
        elseif ($end < 0) {
            $length = \mb_strlen($this->__str_buffer) + $end - $start;
        }
        else {
            $length = $end - $start;
        }

        $this->substr($start, $length);

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
        $this->regexReplace('[[:space:]]+', '');

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
        if ($length >= \mb_strlen($this->__str_buffer)) { return $this; }

        // Need to further trim the string so we can append the substring
        $substringLength = \mb_strlen($substring);
        $length -= $substringLength;

        $truncated = \mb_substr($this->__str_buffer, 0, $length);
        $this->__str_buffer = $truncated . $substring;

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
        $this
            ->camelize()
            ->upperCaseFirst();

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
        $this->__str_buffer = implode('', [$substring, $this->__str_buffer, $substring]);

        return $this;
    }

    /**
     * Returns a case swapped version of the string.
     *
     * @return Str
     */
    public function swapCase(): Str
    {
        $this->__str_buffer = preg_replace_callback(
            '/[\S]/u',
            function ($match) {
                if ($match[0] === \mb_strtoupper($match[0])) {
                    return \mb_strtolower($match[0]);
                }

                return \mb_strtoupper($match[0]);
            },
            $this->__str_buffer
        );

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
        $this->__str_buffer = preg_replace([
            '/\x{2026}/u',
            '/[\x{201C}\x{201D}]/u',
            '/[\x{2018}\x{2019}]/u',
            '/[\x{2013}\x{2014}]/u',
        ], [
            '...',
            '"',
            "'",
            '-',
        ], $this->__str_buffer);

        return $this;
    }

    /**
     * Returns a trimmed string with the first letter of each word capitalized.
     * Also accepts an array, $ignore, allowing you to list words not to be
     * capitalized.
     *
     * @todo check if it still works.
     *
     * @param  array $ignore An array of words not to capitalize
     * @return Str
     */
    public function titleize(array $ignore = []): Str
    {
        $this->trim();

        $this->__str_buffer = preg_replace_callback(
            '/([\S]+)/u',
            function ($match) use ($ignore) {
                if ($ignore && \in_array($match[0], $ignore, true)) {
                    return $match[0];
                }

                $this->__str_buffer = $match[0];
                $this
                    ->toLowerCase()
                    ->upperCaseFirst();

                return $this->__str_buffer;
            },
            $this->__str_buffer
        );

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
        $key = (string)$this->toLowerCase();
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

        if (\is_numeric($this->__str_buffer)) {
            return ((int)$this->__str_buffer > 0);
        }

        $this->regexReplace('[[:space:]]+', '');

        return (bool)$this->__str_buffer;
    }

    /**
     * Converts each tab in the string to some number of spaces, as defined by
     * $tabLength. By default, each tab is converted to 4 consecutive spaces.
     *
     * We don't check for ascii here.
     *
     * @param  int $tabLength Number of spaces to replace each tab with
     * @return Str
     */
    public function toSpaces(int $tabLength = 4): Str
    {
        $spaces = \str_repeat(' ', $tabLength);
        $this->__str_buffer = \str_replace("\t", $spaces, $this->__str_buffer);

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
        $spaces = \str_repeat(' ', $tabLength);
        $this->__str_buffer = \str_replace($spaces, "\t", $this->__str_buffer);

        return $this;
    }

    /**
     * Converts the first character of each word in the string to uppercase.
     *
     * NB! In this function we don't check if the string is ascii.
     *
     * @return Str
     */
    public function toTitleCase(): Str
    {
        $this->__str_buffer = \mb_convert_case($this->__str_buffer, \MB_CASE_TITLE);

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
        $this->delimit('_');

        return $this;
    }

    /**
     * Move substring of desired $length to $destination index of the original string.
     * In case $destination is less than $length returns $str untouched.
     *
     * @param  int $start
     * @param  int $length
     * @param  int $destination
     * @return Str
     */
    public function move(int $start, int $length, int $destination): Str
    {
        if ($destination <= $length) { return $this; }

        $substr = \mb_substr($this->__str_buffer, $start, $length);

        $this
            ->insert($substr, $destination)
            ->replace($substr, '', 1);

        return $this;
    }

    /**
     * Replaces substring in the original string of $length with given $substr.
     *
     * @param  int    $start
     * @param  int    $length
     * @param  string $substr
     * @return Str
     */
    public function overwrite(int $start, int $length, string $substr): Str
    {
        if ($length <= 0) { return $this; }

        $sub = \mb_substr($this->__str_buffer, $start, $length);

        $this->replace($sub, $substr, 1);

        return $this;
    }

    /**
     * Returns a snake_case version of the string.
     *
     * @return Str
     */
    public function snakeize(): Str
    {
        $this->__str_buffer = \mb_ereg_replace('::', '/', $this->__str_buffer);
        $this->__str_buffer = \mb_ereg_replace('([A-Z]+)([A-Z][a-z])', '\1_\2', $this->__str_buffer);
        $this->__str_buffer = \mb_ereg_replace('([a-z\d])([A-Z])', '\1_\2', $this->__str_buffer);
        $this->__str_buffer = \mb_ereg_replace('\s+', '_', $this->__str_buffer);
        $this->__str_buffer = \mb_ereg_replace('\s+', '_', $this->__str_buffer);
        $this->__str_buffer = \mb_ereg_replace('^\s+|\s+$', '', $this->__str_buffer);
        $this->__str_buffer = \mb_ereg_replace('-', '_', $this->__str_buffer);

        $this->toLowerCase();

        $this->__str_buffer = \mb_ereg_replace_callback(
            '([\d|A-Z])',
            function ($matches) {
                $match = $matches[1];
                if ((string)(int)$match === $match) {
                    return '_' . $match . '_';
                }
            },
            $this->__str_buffer
        );

        $this->__str_buffer = \mb_ereg_replace('_+', '_', $this->__str_buffer);

        $this->trim('_');

        return $this;
    }

    /**
     * Inserts given $substr $times times into the original string after
     * the first occurrence of $needle.
     *
     * @param  string $needle
     * @param  string $substr
     * @param  int    $times
     * @return Str
     */
    public function afterFirst(string $needle, string $substr, int $times = 1): Str
    {
        $idx = $this->indexOf($needle);
        $needleLen = \mb_strlen($needle);
        $idxEnd = $idx + $needleLen;
        $innerSubstr = str_repeat($substr, $times);

        $this->insert($innerSubstr, $idxEnd);

        return $this;
    }

    /**
     * Inserts given $substr $times times into the original string before
     * the first occurrence of $needle.
     *
     * @param  string $needle
     * @param  string $substr
     * @param  int    $times
     * @return Str
     */
    public function beforeFirst(string $needle, string $substr, int $times = 1): Str
    {
        $idx = $this->indexOf($needle);
        $innerSubstr = str_repeat($substr, $times);

        $this->insert($innerSubstr, $idx);

        return $this;
    }

    /**
     * Inserts given $substr $times times into the original string after
     * the last occurrence of $needle.
     *
     * @param  string $needle
     * @param  string $substr
     * @param  int    $times
     * @return Str
     */
    public function afterLast(string $needle, string $substr, int $times = 1): Str
    {
        $idx = $this->indexOfLast($needle);
        $needleLen = \mb_strlen($needle);
        $idxEnd = $idx + $needleLen;
        $innerSubstr = str_repeat($substr, $times);

        $this->insert($innerSubstr, $idxEnd);

        return $this;
    }

    /**
     * Inserts given $substr $times times into the original string before
     * the last occurrence of $needle.
     *
     * @param  string $needle
     * @param  string $substr
     * @param  int $times
     * @return Str
     */
    public function beforeLast(string $needle, string $substr, int $times = 1): Str
    {
        $idx = $this->indexOfLast($needle);
        $innerSubstr = str_repeat($substr, $times);

        $this->insert($innerSubstr, $idx);

        return $this;
    }

    /**
     * Splits the original string in pieces by '@' delimiter and returns
     * true in case the resulting array consists of 2 parts.
     *
     * @return bool
     */
    public function isEmail(): bool
    {
        $split = $this->split('@');

        return \count($split) === 2;
    }

    /**
     * Checks whether given $str is a valid ip v4.
     *
     * @return bool
     */
    public function isIpV4(): bool
    {
        $regex = '\b((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.|$)){4}\b';

        return $this->matchesPattern($regex);
    }

    /**
     * Checks whether given $str is a valid ip v6.
     *
     * @return bool
     */
    public function isIpV6(): bool
    {
        $regex = '^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$';

        return $this->matchesPattern($regex);
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
    public function random(int $size, int $sizeMax = -1, string $possibleChars = ''): string
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
            $char = \mb_substr($allowedChars, \rand(0, $allowedCharsLen), 1);
            $result .= $char;
        }

        return $result;
    }

    /**
     * Appends a random string consisting of $possibleChars, if specified, of given $size or
     * random length between $size and $sizeMax to the original string.
     *
     * @param  int    $size          The desired length of the string. Defaults to 4
     * @param  string $possibleChars If given, specifies allowed characters to make the string of
     * @param  int    $sizeMax       If given and is > $size, the generated string will have random length
     *                               between $size and $sizeMax
     * @return Str
     */
    public function appendUniqueIdentifier(int $size = 4, int $sizeMax = -1, string $possibleChars = ''): Str
    {
        $identifier = $this->random($size, $sizeMax, $possibleChars);

        $this->__str_buffer .= $identifier;

        return $this;
    }

    /**
     * Splits on whitespace, returning an array of strings corresponding to the words in the string.
     *
     * @return array of strings
     */
    public function words(): array
    {
        return $this->split('[[:space:]]+');
    }

    /**
     * Wraps each word in the original string with specified $quote.
     *
     * @param  string $quote Defaults to ".
     * @return Str
     */
    public function quote(string $quote = '"'): Str
    {
        $words = $this->words();
        $result = [];

        foreach ($words as $word) {
            $result[] = $quote . $word . $quote;
        }

        $this->__str_buffer = \implode(' ', $result);

        return $this;
    }

    /**
     * Unwraps each word in the original string, deleting the specified $quote.
     *
     * @param  string $quote Defaults to ".
     * @return Str
     */
    public function unquote(string $quote = '"'): Str
    {
        $words = $this->words();
        $result = [];

        foreach ($words as $word) {
            $this->__str_buffer = $word;
            $this->trim($quote);
            $result[] = $this->__str_buffer;
        }

        $this->__str_buffer = \implode(' ', $result);

        return $this;
    }

    /**
     * Cuts the original string in pieces of $step size.
     *
     * @param int $step
     * @return array
     */
    public function chop(int $step): array
    {
        $result = [];
        $len = \mb_strlen($this->__str_buffer);

        if ($this->__str_buffer === '' || $step <= 0) { return []; }

        if ($step >= $len) { return [$this->__str_buffer]; }

        $startPos = 0;

        for ($i = 0; $i < $len; $i+=$step) {
            $result[] = \mb_substr($this->__str_buffer, $startPos, $step);
            $startPos += $step;
        }

        return $result;
    }

    /**
     * Joins the original string with an array of other strings.
     *
     * @param  string $separator
     * @param  array  $otherStrings
     * @return Str
     */
    public function join(string $separator, array $otherStrings = []): Str
    {
        if (empty($otherStrings)) { return $this; }

        foreach ($otherStrings as $otherString) {
            if ($otherString) {
                $this->__str_buffer .= ($separator . $otherString);
            }
        }

        return $this;
    }

    /**
     * Returns the substring of the original string from beginning to
     * the first occurrence of $delimiter.
     *
     * @param  string $delimiter
     *
     * @return Str
     */
    public function shift(string $delimiter): Str
    {
        if (!$this->__str_buffer || !$delimiter) {
            $this->__str_buffer = '';
            return $this;
        }

        $idx = $this->indexOf($delimiter);

        if ($idx === -1) { return $this; }

        $this->substr(0, $idx);

        return $this;
    }

    /**
     * Returns the substring of the original string from the first
     * occurrence of $delimiter to the end.
     *
     * @param  string $delimiter
     *
     * @return Str
     */
    public function shiftReversed(string $delimiter): Str
    {
        if (!$this->__str_buffer || !$delimiter) {
            $this->__str_buffer = '';
            return $this;
        }

        $idx = $this->indexOf($delimiter) + 1;

        if ($idx === -1) { return $this; }

        $this->substr($idx);

        return $this;
    }

    /**
     * Returns the substring of the original string from the last
     * occurrence of $delimiter to the end.
     *
     * @param  string $delimiter
     *
     * @return Str
     */
    public function pop(string $delimiter): Str
    {
        if (!$this->__str_buffer || !$delimiter) {
            $this->__str_buffer = '';
            return $this;
        }

        $idx = $this->indexOfLast($delimiter) + 1;

        if ($idx === -1) { return $this; }

        $this->substr($idx);

        return $this;
    }


    /**
     * Returns the substring of the original string from the beginning
     * to the last occurrence of $delimiter.
     *
     * @param  string $delimiter
     *
     * @return Str
     */
    public function popReversed(string $delimiter): Str
    {
        if (!$this->__str_buffer || !$delimiter) {
            $this->__str_buffer = '';
            return $this;
        }

        $idx = $this->indexOfLast($delimiter);

        if ($idx === -1) { return $this; }

        $this->substr(0, $idx);

        return $this;
    }
}
