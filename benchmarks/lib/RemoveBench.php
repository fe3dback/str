<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class RemoveBench
{
    public function bench_remove_left_Str() {
        (new Str('12'))->removeLeft('1');
    }

    public function bench_remove_left_Stringy() {
        (new Stringy('12'))->removeLeft('1');
    }

    public function bench_remove_right_Str() {
        (new Str('21'))->removeRight('1');
    }

    public function bench_remove_right_Stringy()
    {
        (new Stringy('21'))->removeRight('1');
    }
}
