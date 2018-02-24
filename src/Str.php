<?php

declare(strict_types=1);

namespace FS;

use \FS\Lib\SCommon;

class Str
{
    /** @var string */
    private $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * @return string
     */
    public function getString(): string
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
     * @param $prefix
     * @return bool
     */
    public function hasPrefix($prefix): bool
    {
        return SCommon::hasPrefix($this->str, $prefix);
    }

    /**
     * @param $suffix
     * @return bool
     */
    public function hasSuffix($suffix): bool
    {
        return SCommon::hasSuffix($this->str, $suffix);
    }

    /**
     * @param $check
     * @return $this
     */
    public function ensureLeft($check): Str
    {
        $this->str = SCommon::ensureLeft($this->str, $check);
        return $this;
    }

    /**
     * @param $check
     * @return $this
     */
    public function ensureRight($check): Str
    {
        $this->str = SCommon::ensureRight($this->str, $check);
        return $this;
    }
}