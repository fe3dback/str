<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ReplaceBench
{
    public function bench_Str() {
        (new Str('oink oink oink'))->replace('k', 'ky', 3);
    }

    public function bench_Stringy() {
        (new Stringy('oink oink oink'))->replace('k', 'ky');
    }
}