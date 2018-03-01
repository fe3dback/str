<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ToBooleanBench
{
    public function bench_to_boolean_Str() {
        (new Str('yes'))->toBoolean();
    }

    public function bench_to_boolean_Stringy() {
        (new Stringy('yes'))->toBoolean();
    }
}
