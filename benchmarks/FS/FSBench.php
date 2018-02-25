<?php

declare(strict_types=1);

namespace Benchmark\FS;

use FS\Str;

class FSBench
{
    public function bench_EnsureLeft(): void
    {
        (new Str('2'))->ensureLeft('1');
    }

    public function bench_EnsureRight(): void
    {
        (new Str('1'))->ensureRight('2');
    }

    public function bench_Replace(): void
    {
        (new Str('oink oink oink'))->replace('k', 'ky', 2);
    }

    public function bench_Upper(): void
    {
        (new Str('hello'))->toUpperCase();
    }

    public function bench_Trim(): void
    {
        (new Str(' hello world '))->trim();
    }

    public function bench_TrimLeft(): void
    {
        (new Str('  hello world '))->trimLeft();
    }

    public function bench_TrimRight(): void
    {
        (new Str(' hello world  '))->trimRight();
    }

    public function bench_Length(): void
    {
        (new Str('Hello world'))->length();
    }

    public function bench_First(): void
    {
        (new Str('Hello world'))->first(6);
        (new Str('Hello world'))->first(-6);
    }

    public function bench_Last(): void
    {
        (new Str('Hello world'))->first(6);
        (new Str('Hello world'))->first(-6);
    }

    public function chars(): void
    {
        (new Str('Hello world'))->chars();
    }
}