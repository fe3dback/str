<?php

declare(strict_types=1);

namespace FS;

use \FS\Lib\StrCommon;

class Str
{
    /** @var string */
    private $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * get result string
     *
     * @return string
     */
    public function getString(): string
    {
        return $this->str;
    }

    /**
     * alias for getString method
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
     * string has prefix at the start
     *
     * @param string $prefix
     * @return bool
     */
    public function hasPrefix(string $prefix): bool
    {
        return StrCommon::hasPrefix($this->str, $prefix);
    }

    /**
     * string has suffix at the end?
     *
     * @param string $suffix
     * @return bool
     */
    public function hasSuffix(string $suffix): bool
    {
        return StrCommon::hasSuffix($this->str, $suffix);
    }

    /**
     * Check if prefix exist in string, and
     * prepend prefix to str - if not
     *
     * @param string $check
     * @return $this
     */
    public function ensureLeft(string $check): Str
    {
        $this->str = StrCommon::ensureLeft($this->str, $check);
        return $this;
    }

    /**
     * Check if suffix exist in string, and
     * append suffix to str - if not.
     *
     * @param string $check
     * @return $this
     */
    public function ensureRight(string $check): Str
    {
        $this->str = StrCommon::ensureRight($this->str, $check);
        return $this;
    }

    /**
     * Replace returns a copy of the string s with the first
     * n non-overlapping instances of old replaced by new.
     * If old is empty, it matches at the beginning of the string and
     * after each UTF-8 sequence, yielding up to k+1 replacements
     * for a k-rune string. If n < 0,
     * there is no limit on the number of replacements.
     *
     * @param $old
     * @param $new
     * @param int $times
     * @return $this
     */
    public function replace(string $old, string $new, int $times = -1): Str
    {
        $this->str = StrCommon::replace($this->str, $old, $new, $times);
        return $this;
    }

    /**
     * Make a string lowercase
     * @return Str
     */
    public function toLowerCase(): Str
    {
        $this->str = \mb_strtolower($this->str);
        return $this;
    }

    /**
     * Make a string uppercase
     * @return Str
     */
    public function toUpperCase(): Str
    {
        $this->str = \mb_strtoupper($this->str);
        return $this;
    }

    /**s
     * Returns a string with whitespace removed from the start and end of the
     * string. Supports the removal of unicode whitespace. Accepts an optional
     * string of characters to strip instead of the defaults.
     *
     * @param string $chars
     * @return Str
     */
    public function trim(string $chars = ''): Str
    {
        $this->str = StrCommon::trim($this->str, $chars);
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
        $this->str = StrCommon::trimLeft($this->str, $chars);
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
        $this->str = StrCommon::trimRight($this->str, $chars);
        return $this;
    }
}