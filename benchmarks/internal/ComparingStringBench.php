<?php

class ComparingStringBench
{
    public function bench_empty()
    {
        $s = '';
        return empty($s);
    }

    public function bench_literal_comparison()
    {
        $s = '';
        return '' !== $s;
    }

    public function bench_null_comparison()
    {
        $s = '';
        return null !== $s;
    }

    public function bench_bool_comparison()
    {
        $s = '';
        return (bool)$s;
    }

    public function bench_native_bool_comparison(): bool
    {
        $s = '';
        return $s;
    }
}
