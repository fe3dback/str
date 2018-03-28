<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class LongestCommonSubstrBench
{
    public function bench_longest_common_substring_Str() {
        (new Str(' hello world '))->longestCommonSubstring(' helloworld');
    }

    public function bench_longest_common_substring_Stringy() {
        (new Stringy(' hello world '))->longestCommonSubstring(' helloworld');
    }

    public function bench_longest_common_suffix_Str() {
        (new Str(' hello world '))->longestCommonSuffix(' hello');
    }

    public function bench_longest_common_suffix_Stringy() {
        (new Stringy(' hello world '))->longestCommonSuffix(' hello');
    }

    public function bench_longest_common_prefix_Str() {
        (new Str(' hello world '))->longestCommonPrefix(' hello');
    }

    public function bench_longest_common_prefix_Stringy() {
        (new Stringy(' hello world '))->longestCommonPrefix(' hello');
    }
}
