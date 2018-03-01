<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class StringMutatorsBench
{
    public function bench_underscored_Str() {
        (new Str(' hello world '))->underscored();
    }

    public function bench_underscored_Stringy() {
        (new Stringy(' hello world '))->underscored();
    }

    public function bench_tidy_Str() {
        (new Str(' hello world '))->tidy();
    }

    public function bench_tidy_Stringy() {
        (new Stringy(' hello world '))->tidy();
    }

    public function bench_to_ascii_Str() {
        (new Str(' hello world '))->toAscii();
    }

    public function bench_to_ascii_Stringy() {
        (new Stringy(' hello world '))->toAscii();
    }

    public function bench_slugify_Str() {
        (new Str(' hello world '))->slugify();
    }

    public function bench_slugify_Stringy() {
        (new Stringy(' hello world '))->slugify();
    }

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

    public function bench_humanize_Str() {
        (new Str(' hello world '))->humanize();
    }

    public function bench_humanize_Stringy() {
        (new Stringy(' hello world '))->humanize();
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

    public function bench_reverse_Str() {
        (new Str(' hello world '))->reverse();
    }

    public function bench_reverse_Stringy() {
        (new Stringy(' hello world '))->reverse();
    }

    public function bench_repeat_Str() {
        (new Str(' hello world '))->repeat(2);
    }

    public function bench_repeat_Stringy() {
        (new Stringy(' hello world '))->repeat(2);
    }

    public function bench_shuffle_Str() {
        (new Str(' hello world '))->shuffle();
    }

    public function bench_shuffle_Stringy() {
        (new Stringy(' hello world '))->shuffle();
    }
}
