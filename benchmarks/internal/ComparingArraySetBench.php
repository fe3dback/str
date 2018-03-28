<?php

class ComparingArraySetBench
{
    public function bench_access()
    {
        $s = [];
        $s[] = 1;
        $s[] = 1;
    }

    public function bench_unshift()
    {
        $s = [];
        array_unshift($s, 1);
        array_unshift($s, 1);
    }

    public function bench_push()
    {
        $s = [];
        array_push($s, 1);
        array_push($s, 1);
    }
}
