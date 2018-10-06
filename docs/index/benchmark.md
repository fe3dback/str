lib code tests (versus):
```bash
make lib-code-tests
```

how to get total RANK:
```bash
make rank
```

generate md:
```bash
make md
```

run tests:
```bash
make test
```

Test subjects:
- FS ([str/str](https://github.com/fe3dback/str))
- Stringy ([danielstjules/Stringy](https://github.com/danielstjules/Stringy))

----

RANK (sum time of all benchmarks): 
__smaller - is better!__

Target  | Total Time | Diff
---     | ---        | ---
Str     | 5.505 s.   | 1x
Stringy | 10.840 s.  | 2.0x

----

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_common_Str | 811.098μs | 1,929,728b | 1.00x
bench_common_Stringy | 5,310.290μs | 1,879,272b | 6.55x

##### [see all other benchmark results](https://github.com/fe3dback/str/blob/master/docs/benchmark.md)
