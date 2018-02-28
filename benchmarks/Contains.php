<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class Contains
{
    public function bench_contains_Str() {
        (new Str(' hello world '))->contains('test');
    }

    public function bench_contains_Stringy() {
        (new Stringy(' hello world '))->contains('test');
    }

    public function bench_all_Str() {
        (new Str(' hello world '))->containsAll(['test', 'foo', 'bar']);
    }

    public function bench_all_Stringy() {
        (new Stringy(' hello world '))->containsAll(['test', 'foo', 'bar']);
    }

    public function bench_any_Str() {
        (new Str(' hello world '))->containsAny(['test', 'foo', 'bar']);
    }

    public function bench_any_Stringy() {
        (new Stringy(' hello world '))->containsAny(['test', 'foo', 'bar']);
    }
}