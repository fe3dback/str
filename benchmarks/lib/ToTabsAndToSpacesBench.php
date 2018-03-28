<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ToTabsAndToSpacesBench
{
    public function bench_to_tabs_Str() {
        (new Str(' hello world '))->toTabs();
    }

    public function bench_to_tabs_Stringy() {
        (new Stringy(' hello world '))->toTabs();
    }

    public function bench_to_spaces_Str() {
        (new Str(' hello world '))->toSpaces();
    }

    public function bench_to_spaces_Stringy() {
        (new Stringy(' hello world '))->toSpaces();
    }
}
