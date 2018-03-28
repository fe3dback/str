<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class DelimitersBench
{
    public function bench_underscored_Str() {
        (new Str(' hello world '))->underscored();
    }

    public function bench_underscored_Stringy() {
        (new Stringy(' hello world '))->underscored();
    }

    public function bench_delimit_Str() {
        (new Str(' hello world '))->delimit('()');
    }

    public function bench_delimit_Stringy() {
        (new Stringy(' hello world '))->delimit('()');
    }

    public function bench_dasherize_Str() {
        (new Str(' hello world '))->dasherize();
    }

    public function bench_dasherize_Stringy() {
        (new Stringy(' hello world '))->dasherize();
    }
}
