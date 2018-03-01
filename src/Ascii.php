<?php

declare(strict_types=1);

namespace Str;

class Ascii
{
    /**
     * @param  string $s
     * @return bool
     */
    final public static function checkWithRegex(string $s): bool
    {
        return !(bool)\preg_match('/[^\x20-\x7f]/', $s);
    }

    /**
     * @param  string $s
     * @return bool
     */
    final public static function checkWithMb(string $s): bool
    {
        return (bool)\mb_detect_encoding($s, 'ASCII', true);
    }

    /**
     * @param  string $s
     * @return bool
     */
    final public static function checkWithCType(string $s): bool
    {
        return \ctype_print($s);
    }
}
