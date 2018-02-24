<?php

declare(strict_types=1);

class SModifyBench
{
    public function benchFS_EnsureLeft(): void
    {
        \FS\Lib\SCommon::ensureLeft('2', '1');
    }

    public function benchStringy_EnsureLeft(): void
    {
        (\Stringy\create('2'))->ensureLeft('1');
    }

    public function benchFS_EnsureRight(): void
    {
        \FS\Lib\SCommon::ensureLeft('1', '2');
    }

    public function benchStringy_EnsureRight(): void
    {
        (\Stringy\create('1'))->ensureRight('2');
    }
}