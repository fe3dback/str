<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class EnsureBench
{
    public function bench_left_Str() {
        (new Str('2'))->ensureLeft('1');
    }

    public function bench_left_Stringy() {
        (new Stringy('2'))->ensureLeft('1');
    }

    public function bench_right_Str() {
        (new Str('2'))->ensureRight('1');
    }

    public function bench_right_Stringy() {
        (new Stringy('2'))->ensureRight('1');
    }
}