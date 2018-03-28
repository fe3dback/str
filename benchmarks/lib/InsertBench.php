<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class InsertBench
{
    public function bench_insert_Str() {
        (new Str('226198'))->insert('1', 4);
    }

    public function bench_insert_Stringy() {
        (new Stringy('226198'))->insert('1', 4);
    }
}
