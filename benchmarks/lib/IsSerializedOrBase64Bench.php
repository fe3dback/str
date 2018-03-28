<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsSerializedOrBase64Bench
{
    public function bench_is_serialized_Str() {
        (new Str(' hello world '))->isSerialized();
    }

    public function bench_is_serialized_Stringy() {
        (new Stringy(' hello world '))->isSerialized();
    }

    public function bench_is_base64_Str() {
        (new Str(' hello world '))->isBase64();
    }

    public function bench_is_base64_Stringy() {
        (new Stringy(' hello world '))->isBase64();
    }
}
