<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class SwapCaseBench
{
    public function bench_swap_case_Str() {
        (new Str('hElLo'))->swapCase();
    }

    public function bench_swap_case_Stringy() {
        (new Stringy('hElLo'))->swapCase();
    }
}
