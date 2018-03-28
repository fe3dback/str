<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class CountAndLengthBench
{
    public function bench_length_Str() {
        (new Str('Hello world'))->length();
    }

    public function bench_length_Stringy() {
        (new Stringy('Hello world'))->length();
    }

    public function bench_indexOf_Str() {
        (new Str('Hello world'))->indexOf('l');
    }

    public function bench_indexOf_Stringy() {
        (new Stringy('Hello world'))->indexOf('l');
    }

    public function bench_indexOfLast_Str() {
        (new Str('Hello world'))->indexOfLast('l');
    }

    public function bench_indexOfLast_Stringy() {
        (new Stringy('Hello world'))->indexOfLast('l');
    }

    public function bench_count_Str() {
        (new Str('HelLo wOrld'))->countSubstr('l', false);
    }

    public function bench_count_Stringy() {
        (new Stringy('HelLo wOrld'))->countSubstr('l', false);
    }
}
