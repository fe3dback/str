<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class SuffixesAnsPrefixesBooleansBench
{
    public function bench_ends_with_any_Str() {
        (new Str(' hello world '))->endsWithAny(['he', 'lo']);
    }

    public function bench_ends_with_any_Stringy() {
        (new Stringy(' hello world '))->endsWithAny(['he', 'lo']);
    }

    public function bench_starts_with_any_Str() {
        (new Str(' hello world '))->startsWithAny(['he', 'lo']);
    }

    public function bench_starts_with_any_Stringy() {
        (new Stringy(' hello world '))->startsWithAny(['he', 'lo']);
    }

    public function bench_ends_with_Str() {
        (new Str(' hello world '))->endsWith('he');
    }

    public function bench_ends_with_Stringy() {
        (new Stringy(' hello world '))->endsWith('he');
    }

    public function bench_starts_with_Str() {
        (new Str(' hello world '))->startsWith('he');
    }

    public function bench_starts_with_Stringy() {
        (new Stringy(' hello world '))->startsWith('he');
    }
}
