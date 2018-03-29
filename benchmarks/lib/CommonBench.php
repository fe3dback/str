<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class CommonBench
{
    public function bench_common_Str() {
        for ($i=0;$i<100;$i++) {
            $str = new Str('Hello, 世界');
            $str->last(2); // 世界
            $str->chars(); // ['世', '界']

            $str
                ->ensureLeft('Hello, ')// Hello, 世界
                ->ensureRight('!!!')// Hello, 世界!!!
                ->trimRight('!')// Hello, 世界
                ->prepend('Str say - '); // Str say - Hello, 世界
        }
    }

    public function bench_common_Stringy() {
        for ($i=0;$i<100;$i++) {
            $str = new Stringy('Hello, 世界');
            $str->last(2); // 世界
            $str->chars(); // ['世', '界']

            $str
                ->ensureLeft('Hello, ')// Hello, 世界
                ->ensureRight('!!!')// Hello, 世界!!!
                ->trimRight('!')// Hello, 世界
                ->prepend('Str say - '); // Str say - Hello, 世界
        }
    }
}
