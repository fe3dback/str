<?php

declare(strict_types=1);

class StrBench
{
    public function benchFS_EnsureLeft(): void
    {
        (new \FS\Str('2'))->ensureLeft('1');
    }

    public function benchStringy_EnsureLeft(): void
    {
        (new Stringy\Stringy('2'))->ensureLeft('1');
    }

    public function benchFS_EnsureRight(): void
    {
        (new \FS\Str('1'))->ensureRight('2');
    }

    public function benchStringy_EnsureRight(): void
    {
        (new Stringy\Stringy('1'))->ensureRight('1');
    }
}