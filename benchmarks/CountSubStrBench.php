<?php

namespace Benchmark;

use Str\Lib\StrCommonMB;
use Str\Str;
use Stringy\StaticStringy;
use Stringy\Stringy;

class CountSubStrBench
{
    public function bench_Str() {
        (new Str('HelLo wOrld'))->countSubstr('l', false);
    }

    public function bench_StrStatic() {
        StrCommonMB::countSubstr('HelLo wOrld', '1', false);
    }

    public function bench_Stringy() {
        (new Stringy('HelLo wOrld'))->countSubstr('l', false);
    }

    public function bench_StringyStatic() {
        StaticStringy::countSubstr('HelLo wOrld', '1', false);
    }
}