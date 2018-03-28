<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class TruncateBench
{
    public function bench_truncate_Str() {
        (new Str(' hello world '))->truncate(2, 'duh');
    }

    public function bench_truncate_Stringy() {
        (new Stringy(' hello world '))->truncate(2, 'duh');
    }

    public function bench_safe_truncate_Str() {
        (new Str(' hello world '))->safeTruncate(2, 'duh');
    }

    public function bench_safe_truncate_Stringy() {
        (new Stringy(' hello world '))->safeTruncate(2, 'duh');
    }
}
