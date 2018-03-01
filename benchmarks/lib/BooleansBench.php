<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class BooleansBench
{
    public function bench_is_serialized_Str() {
        (new Str(' hello world '))->isSerialized();
    }

    public function bench_is_serialized_Stringy() {
        (new Stringy(' hello world '))->isSerialized();
    }

    public function bench_is_json_Str() {
        (new Str(' hello world '))->isJson();
    }

    public function bench_is_json_Stringy() {
        (new Stringy(' hello world '))->isJson();
    }

    public function bench_is_hexadecimal_Str() {
        (new Str(' hello world '))->isHexadecimal();
    }

    public function bench_is_hexadecimal_Stringy() {
        (new Stringy(' hello world '))->isHexadecimal();
    }

    public function bench_is_blank_Str() {
        (new Str(' hello world '))->isBlank();
    }

    public function bench_is_blank_Stringy() {
        (new Stringy(' hello world '))->isBlank();
    }

    public function bench_is_base64_Str() {
        (new Str(' hello world '))->isBase64();
    }

    public function bench_is_base64_Stringy() {
        (new Stringy(' hello world '))->isBase64();
    }

    public function bench_is_alpha_numeric_Str() {
        (new Str(' hello world '))->isAlphanumeric();
    }

    public function bench_is_alpha_numeric_Stringy() {
        (new Stringy(' hello world '))->isAlphanumeric();
    }

    public function bench_is_alpha_Str() {
        (new Str(' hello world '))->isAlpha();
    }

    public function bench_is_alpha_Stringy() {
        (new Stringy(' hello world '))->isAlpha();
    }
}
