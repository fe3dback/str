<?php

declare(strict_types=1);

namespace Benchmark\Stringy;

use Stringy\Stringy;

class StringyBench
{
    public function bench_EnsureLeft(): void
    {
        (new Stringy('2'))->ensureLeft('1');
    }

    public function bench_EnsureRight(): void
    {
        (new Stringy('1'))->ensureRight('1');
    }

    public function bench_Replace(): void
    {
        (new Stringy('oink oink oink'))->replace('k', 'ky');
    }

    public function bench_Upper(): void
    {
        (new Stringy('hello'))->toUpperCase();
    }

    public function bench_Trim(): void
    {
        (new Stringy(' hello world '))->trim();
    }

    public function bench_TrimLeft(): void
    {
        (new Stringy('  hello world '))->trimLeft();
    }

    public function bench_TrimRight(): void
    {
        (new Stringy(' hello world  '))->trimRight();
    }
}