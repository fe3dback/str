<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class CaseTogglingBench
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

    public function bench_upper_camelize_Str() {
        (new Str('some string hello'))->upperCamelize();
    }

    public function bench_upper_camelize_Stringy() {
        (new Stringy('some string hello'))->upperCamelize();
    }

    public function bench_camelize_Str() {
        (new Str('some string hello'))->camelize();
    }

    public function bench_camelize_Stringy() {
        (new Stringy('some string hello'))->camelize();
    }

    public function bench_swap_case_Str() {
        (new Str('hElLo'))->swapCase();
    }

    public function bench_swap_case_Stringy() {
        (new Stringy('hElLo'))->swapCase();
    }

    public function bench_upper_case_first_Str() {
        (new Str('hello'))->upperCaseFirst();
    }

    public function bench_upper_case_first_Stringy() {
        (new Stringy('hello'))->upperCaseFirst();
    }

    public function bench_lower_case_first_Str() {
        (new Str('HELLO'))->lowerCaseFirst();
    }

    public function bench_lower_case_first_Stringy() {
        (new Stringy('HELLO'))->lowerCaseFirst();
    }

    public function bench_to_upper_case_Str() {
        (new Str('hello'))->toUpperCase();
    }

    public function bench_to_upper_case_Stringy() {
        (new Stringy('hello'))->toUpperCase();
    }

    public function bench_to_lower_case_Str() {
        (new Str('HELLO'))->toLowerCase();
    }

    public function bench_to_lower_case_Stringy() {
        (new Stringy('HELLO'))->toLowerCase();
    }
}
