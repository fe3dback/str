<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class HumanizeAndSlugifyBench
{
    public function bench_slugify_Str() {
        (new Str(' hello world '))->slugify();
    }

    public function bench_slugify_Stringy() {
        (new Stringy(' hello world '))->slugify();
    }

    public function bench_humanize_Str() {
        (new Str(' hello world '))->humanize();
    }

    public function bench_humanize_Stringy() {
        (new Stringy(' hello world '))->humanize();
    }
}
