<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class HTMLRelatedBench
{
    public function bench_html_decode_Str() {
        (new Str(' hello world '))->htmlDecode();
    }

    public function bench_html_decode_Stringy() {
        (new Stringy(' hello world '))->htmlDecode();
    }

    public function bench_html_encode_Str() {
        (new Str(' hello world '))->htmlEncode();
    }

    public function bench_html_encode_Stringy() {
        (new Stringy(' hello world '))->htmlEncode();
    }
}
