<?php

class IntCastingBench
{
    public function bench_int()
    {
        $s = "4dfgsdgf4";
        return (int)$s;
    }

    public function bench_add_plus()
    {
        $s = "4dfgsdgf4";
        return $s+0;
    }

    public function bench_intval()
    {
        $s = "4dfgsdgf4";
        return intval($s);
    }

    public function bench_settype()
    {
        $s = "4dfgsdgf4";
        return settype($s, 'integer');
    }
}
