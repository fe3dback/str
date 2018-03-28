<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class TitleCaseBench
{
    public function bench_to_title_case_Str() {
        (new Str('some string hello'))->toTitleCase();
    }

    public function bench_to_title_case_Stringy() {
        (new Stringy('some string hello'))->toTitleCase();
    }

    public function bench_titleize_Str() {
        (new Str('some string hello'))->titleize();
    }

    public function bench_titleize_Stringy() {
        (new Stringy('some string hello'))->titleize();
    }
}
