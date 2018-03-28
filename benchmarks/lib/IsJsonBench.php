<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsJsonBench
{
    public function bench_is_json_Str() {
        (new Str(' hello world '))->isJson();
    }

    public function bench_is_json_Stringy() {
        (new Stringy(' hello world '))->isJson();
    }
}
