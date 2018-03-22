<?php

declare(strict_types=1);

use function Str\Lib\libstr_replace;

class UTF8Bench
{
    const ASCII_STR = 'Hello world, this some kind of valid ascii string. 1239450 $#(%)...';

    public function bench_ASCII()
    {
        strlen($a = strtolower(strtoupper(self::ASCII_STR)));
        strpos($a, '#');
        strrpos($a, 'old');
        str_replace('valid', 'invalid', $a);
        str_replace('##UNKNOWN##', 'ABC', $a);
    }

    public function bench_UTF8()
    {
        mb_strlen($a = mb_strtolower(mb_strtoupper(self::ASCII_STR)));
        mb_strpos($a, '#');
        mb_strrpos($a, 'old');
        libstr_replace($a, 'valid', 'invalid');
        libstr_replace($a, '##UNKNOWN##', 'ABC');
    }

    public function bench_UTF8_ForceEncoding()
    {
        mb_strlen($a = mb_strtolower(mb_strtoupper(self::ASCII_STR)));
        mb_strpos($a, '#', 0);
        mb_strrpos($a, 'old');
        libstr_replace($a, 'valid', 'invalid');
        libstr_replace($a, '##UNKNOWN##', 'ABC');
    }

    public function bench_UTF8_DefaultEncoding()
    {
        mb_internal_encoding('UTF-8');
        mb_strlen($a = mb_strtolower(mb_strtoupper(self::ASCII_STR)));
        mb_strpos($a, '#');
        mb_strrpos($a, 'old');
        libstr_replace($a, 'valid', 'invalid');
        libstr_replace($a, '##UNKNOWN##', 'ABC');
    }
}