<?php

class ComparingLoopsBench
{
    private $arr = [];
    private $arr1 = [];

    public function __construct()
    {
        for ($i=0;$i<1000;$i++) { $this->arr1[] = \Ramsey\Uuid\Uuid::uuid4(); }
        $this->arr = $this->arr1;
    }

    public function bench_for()
    {
        for ($i=0, $iMax=count($this->arr);$i<$iMax;$i++) {
            $this->arr[$i] = substr($this->arr[$i], 0, 8);
        }
    }

    public function bench_foreach()
    {
        foreach ($this->arr1 as &$i) {
            $i = substr($i, 0, 8);
        }
        unset($i);
    }
}
