<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class AppendAndPrependBench
{
//    public function bench_ensure_left_Str() {
//        (new Str('2'))->ensureLeft('1');
//    }
//
//    public function bench_ensure_left_Stringy() {
//        (new Stringy('2'))->ensureLeft('1');
//    }
//
//    public function bench_ensure_right_Str() {
//        (new Str('2'))->ensureRight('1');
//    }
//
//    public function bench_ensure_right_Stringy() {
//        (new Stringy('2'))->ensureRight('1');
//    }

//    public function bench_append_Str() {
//        (new Str('2'))->append('1');
//    }
//
//    public function bench_append_Stringy() {
//        (new Stringy('2'))->append('1');
//    }
//
//    public function bench_prepend_Str() {
//        (new Str('2'))->prepend('1');
//    }
//
//    public function bench_prepend_Stringy() {
//        (new Stringy('2'))->prepend('1');
//    }
//
    public function bench_remove_left_Str() {
        (new Str('12'))->removeLeft('1');
    }

    public function bench_remove_left_Stringy() {
        (new Stringy('12'))->removeLeft('1');
    }

    public function bench_remove_right_Str() {
        (new Str('21'))->removeRight('1');
    }

    public function bench_remove_right_Stringy()
    {
        (new Stringy('21'))->removeRight('1');
    }
//
//    public function bench_insert_Str() {
//        (new Str('226198'))->insert('1', 4);
//    }
//
//    public function bench_insert_Stringy() {
//        (new Stringy('226198'))->insert('1', 4);
//    }
//
//    public function bench_surround_Str() {
//        (new Str('2'))->surround('1');
//    }
//
//    public function bench_surround_Stringy() {
//        (new Stringy('2'))->surround('1');
//    }
}
