<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class SuffixesBooleansBench
{
    public function bench_ends_with_any_Str() {
        (new Str(' hello world '))->endsWithAny(['he', 'lo']);
    }

    public function bench_ends_with_any_Stringy() {
        (new Stringy(' hello world '))->endsWithAny(['he', 'lo']);
    }

    public function bench_ends_with_Str() {
        (new Str(' hello world '))->endsWith('he');
    }

    public function bench_ends_with_Stringy() {
        (new Stringy(' hello world '))->endsWith('he');
    }
}
