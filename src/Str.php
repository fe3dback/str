<?php

declare(strict_types=1);

namespace Str;

class Str
{
    private $__str_buffer;

    public function __construct($str)
    {
        $this->__str_buffer = $str;
    }

    public function __toString(): string
    {
        return $this->__str_buffer;
    }

    public function getString(): string
    {
        return $this->__str_buffer;
    }

    public function substr(int $start = 0, int $length = 0): Str
    {
        $this->__str_buffer = \mb_substr($this->__str_buffer, $start, $length !== 0 ?
            $length :
            \mb_strlen($this->__str_buffer));

        return $this;
    }

    public function hasPrefix(string $prefix): bool
    {
        if ('' === $this->__str_buffer || '' === $prefix) { return false; }
        return (0 === \mb_strpos($this->__str_buffer, $prefix));
    }

    public function hasSuffix(string $suffix): bool
    {
        if ('' === $this->__str_buffer || '' === $suffix) { return false; }
        return \mb_substr($this->__str_buffer, -\mb_strlen($suffix)) === $suffix;
    }

    public function ensureLeft(string $check): Str
    {
        if ('' !== $check && 0 === \mb_strpos($this->__str_buffer, $check)) { return $this; }
        $this->__str_buffer = $check . $this->__str_buffer;
        return $this;
    }

    public function ensureRight(string $check): Str
    {
        if ('' !== $check && \mb_substr($this->__str_buffer, -\mb_strlen($check)) === $check) { return $this; }
        $this->__str_buffer .= $check;
        return $this;
    }

    public function contains(string $needle, bool $caseSensitive = true): bool
    {
        if ($this->__str_buffer === '' || $needle === '') { return false; }
        return $caseSensitive ? (false !== \mb_strpos($this->__str_buffer, $needle)) : (false !== \mb_stripos($this->__str_buffer, $needle));
    }

    public function replace(string $old, string $new): Str
    {
        $this->__str_buffer = \mb_ereg_replace(\preg_quote($old, '/'), $new, $this->__str_buffer);
        return $this;
    }

    public function replaceWithLimit(string $old, string $new, int $limit = -1): Str
    {
        if ($old === $new || $limit === 0) { return $this; }

        $strUpper = \mb_strtolower($this->__str_buffer);
        $oldUpper = \mb_strtolower($old);
        $oldCount = \mb_substr_count($strUpper, $oldUpper);

        if ($oldCount === 0) { return $this; }

        if ($limit < 0 || $oldCount < $limit) { $limit = $oldCount; }

        $offset = 0;

        while ($limit--) {
            $pos = \mb_strpos($this->__str_buffer, $old, $offset);
            $offset = $pos + \mb_strlen($old);
            $this->__str_buffer = \mb_substr($this->__str_buffer, 0, $pos) . $new . \mb_substr($this->__str_buffer, $offset);
        }

        return $this;
    }

    public function toLowerCase(): Str
    {
        $this->__str_buffer = \mb_strtolower($this->__str_buffer);
        return $this;
    }

    public function toUpperCase(): Str
    {
        $this->__str_buffer = \mb_strtoupper($this->__str_buffer);
        return $this;
    }

    public function trim(string $chars = ''): Str
    {
        $chars = '' === $chars ? '\s' : \preg_quote($chars, '/');
        $this->__str_buffer = \mb_ereg_replace("^[$chars]+|[$chars]+\$", '', $this->__str_buffer);
        return $this;
    }

    public function trimLeft(string $chars = ''): Str
    {
        $chars = '' === $chars ? '\s' : \preg_quote($chars, '/');
        $this->__str_buffer = \mb_ereg_replace("^[$chars]+", '', $this->__str_buffer);
        return $this;
    }

    public function trimRight(string $chars = ''): Str
    {
        $chars = '' === $chars ? '\s' : \preg_quote($chars, '/');
        $this->__str_buffer = \mb_ereg_replace("[$chars]+\$", '', $this->__str_buffer);
        return $this;
    }

    public function append(string $sub): Str
    {
        $this->__str_buffer .= $sub;
        return $this;
    }

    public function prepend(string $sub): Str
    {
        $this->__str_buffer = $sub . $this->__str_buffer;
        return $this;
    }

    public function at(int $pos): Str
    {
        $this->__str_buffer = \mb_substr($this->__str_buffer, $pos, 1);
        return $this;
    }

    public function chars(): array
    {
        if ($this->__str_buffer === '') { return []; }
        $chars = [];
        for ($i = 0, $iMax = \mb_strlen($this->__str_buffer); $i < $iMax; $i++) { $chars[] = \mb_substr($this->__str_buffer, $i, 1); }
        return $chars;
    }

    public function length(): int
    {
        return \mb_strlen($this->__str_buffer);
    }

    public function first(int $length = 1): Str
    {
        if ($length <= 0) { $this->__str_buffer = ''; return $this; }
        $this->__str_buffer = \mb_substr($this->__str_buffer, 0, $length);
        return $this;
    }

    public function last(int $length = 1): Str
    {
        if ($length <= 0) { $this->__str_buffer = ''; return $this; }
        $this->__str_buffer = \mb_substr($this->__str_buffer, -$length);
        return $this;
    }

    public function indexOf(string $needle, int $offset = 0): int
    {
        if ($needle === '' || $this->__str_buffer === '')  { return -1; }
        $pos = \mb_strpos($this->__str_buffer, $needle, $offset);
        return false === $pos ? -1 : $pos;
    }

    public function indexOfLast(string $needle, int $offset = 0): int
    {
        if ($needle === '' || $this->__str_buffer === '') { return -1; }
        $maxLen = \mb_strlen($this->__str_buffer);
        if ($offset < 0) { $offset = $maxLen - (int)abs($offset); }
        if ($offset > $maxLen || $offset < 0) { return -1; }
        $pos = \mb_strrpos($this->__str_buffer, $needle, $offset);
        return false === $pos ? -1 : $pos;
    }

    public function countSubstr(string $needle, bool $caseSensitive = true): int
    {
        if ($caseSensitive) { return \mb_substr_count($this->__str_buffer, $needle); }
        return \mb_substr_count(\mb_strtolower($this->__str_buffer), \mb_strtolower($needle));
    }

    public function containsAll(array $needles, bool $caseSensitive = true): bool
    {
        if ([] === $needles) { return false; }
        foreach ($needles as $needle) { if (!$this->contains($needle, $caseSensitive)) { return false; } }
        return true;
    }

    public function containsAny(array $needles, bool $caseSensitive = true): bool
    {
        foreach ($needles as $needle) { if ($this->contains($needle, $caseSensitive)) { return true; } }
        return false;
    }

    public function startsWith(string $substring, bool $caseSensitive = true): bool
    {
        if ($caseSensitive) { return 0 === \mb_strpos($this->__str_buffer, $substring); }
        return 0 === \mb_stripos($this->__str_buffer, $substring);
    }

    public function startsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        if ([] === $substrings) { return false; }
        foreach ($substrings as $substring) { if ($this->startsWith($substring, $caseSensitive)) { return true; } }
        return false;
    }

    public function endsWith(string $substring, bool $caseSensitive = true): bool
    {
        if ($caseSensitive) { return \mb_substr($this->__str_buffer, -\mb_strlen($substring)) === $substring; }
        return -1 !== \mb_strripos($this->__str_buffer, $substring);
    }

    public function endsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        if ([] === $substrings) { return false; }
        foreach ($substrings as $substring) { if ($this->endsWith($substring, $caseSensitive)) { return true; } }
        return false;
    }

    public function padBoth(int $length, string $padStr = ' '): Str
    {
        $padding = $length - \mb_strlen($this->__str_buffer);
        $this->applyPadding((int)floor($padding / 2), (int)ceil($padding / 2), $padStr);
        return $this;
    }

    private function applyPadding(int $left = 0, int $right = 0, string $padStr = ' '): Str
    {
        if ('' === $padStr || $right + $left <= 0) { return $this; }
        $leftPadding = \mb_substr(str_repeat($padStr, $left), 0, $left);
        $rightPadding = \mb_substr(str_repeat($padStr, $right), 0, $right);
        $this->__str_buffer = $leftPadding . $this->__str_buffer . $rightPadding;
        return $this;
    }

    public function padLeft(int $length, string $padStr = ' '): Str
    {
        $this->applyPadding($length - \mb_strlen($this->__str_buffer), 0, $padStr);
        return $this;
    }

    public function padRight(int $length, string $padStr = ' '): Str
    {
        $this->applyPadding(0, $length - \mb_strlen($this->__str_buffer), $padStr);
        return $this;
    }

    public function insert(string $substring, int $index): Str
    {
        $this->__str_buffer = \mb_substr($this->__str_buffer, 0, $index) . $substring . \mb_substr($this->__str_buffer, $index);
        return $this;
    }

    public function removeLeft(string $substring): Str
    {
        if ('' !== $substring && 0 === \mb_strpos($this->__str_buffer, $substring)) { $this->__str_buffer = \mb_substr($this->__str_buffer, \mb_strlen($substring)); }
        return $this;
    }

    public function removeRight(string $substring): Str
    {
        if ('' !== $substring && \mb_substr($this->__str_buffer, -\mb_strlen($substring)) === $substring) { $this->__str_buffer = \mb_substr($this->__str_buffer, 0, \mb_strlen($this->__str_buffer) - \mb_strlen($substring)); }
        return $this;
    }

    public function repeat(int $multiplier): Str
    {
        $this->__str_buffer = \str_repeat($this->__str_buffer, $multiplier);
        return $this;
    }

    public function reverse(): Str
    {
        $reversed = '';
        $i = \mb_strlen($this->__str_buffer);
        while ($i--) { $reversed .= \mb_substr($this->__str_buffer, $i, 1); }
        $this->__str_buffer = $reversed;
        return $this;
    }
}
