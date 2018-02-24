<?php

declare(strict_types=1);

namespace FS\Lib;

class SCommon
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
}