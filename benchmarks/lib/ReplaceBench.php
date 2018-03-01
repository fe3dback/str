<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ReplaceBench
{
    public function bench_replace_Str() {
        (new Str('oink oink oink'))->replace('k', 'ky', 3);
    }

    public function bench_replace_Stringy() {
        (new Stringy('oink oink oink'))->replace('k', 'ky');
    }

    public function bench_regex_replace_Str() {
        (new Str('oink oink oink'))->regexReplace('k', 'ky');
    }

    public function bench_regex_replace_Stringy() {
        (new Stringy('oink oink oink'))->regexReplace('k', 'ky');
    }
}
