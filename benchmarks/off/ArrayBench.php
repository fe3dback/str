<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ArrayBench
{
    public function bench_chars_Str() {
        (new Str('Hello world'))->chars();
    }

    public function bench_chars_Stringy() {
        (new Stringy('Hello world'))->chars();
    }

//    public function bench_lines_Str() {
//        (new Str('Hello world'))->lines();
//    }
//
//    public function bench_lines_Stringy() {
//        (new Stringy('Hello world'))->lines();
//    }
//
//    public function bench_split_Str() {
//        (new Str('Hello world'))->split(' ');
//    }
//
//    public function bench_split_Stringy() {
//        (new Stringy('Hello world'))->split(' ');
//    }
}
