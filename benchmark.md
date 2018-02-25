
Benchmark string libs
---------------------

### benchmark: CountSubStrBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_StrStatic | 239.000μs | 1,328,496b | 1.00x
bench_Str | 482.000μs | 1,355,320b | 2.02x
bench_Stringy | 1,479.000μs | 1,872,552b | 6.19x
bench_StringyStatic | 1,790.000μs | 1,894,024b | 7.49x

### benchmark: EnsureBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_right_Str | 487.000μs | 1,368,360b | 1.00x
bench_left_Str | 490.000μs | 1,368,360b | 1.01x
bench_left_Stringy | 1,413.000μs | 1,872,296b | 2.90x
bench_right_Stringy | 1,568.000μs | 1,872,296b | 3.22x

### benchmark: GetBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_last_Str | 378.000μs | 1,357,312b | 1.00x
bench_first_Str | 384.000μs | 1,357,312b | 1.02x
bench_last_Stringy | 1,419.000μs | 1,874,416b | 3.75x
bench_first_Stringy | 1,501.000μs | 1,874,416b | 3.97x

### benchmark: GetCharsBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_Str | 396.000μs | 1,353,768b | 1.00x
bench_Stringy | 1,491.000μs | 1,870,864b | 3.77x

### benchmark: LengthBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_Str | 198.000μs | 1,334,256b | 1.00x
bench_Stringy | 1,439.000μs | 1,870,824b | 7.27x

### benchmark: ReplaceBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_Str | 362.000μs | 1,345,016b | 1.00x
bench_Stringy | 1,547.000μs | 1,871,112b | 4.27x

### benchmark: ToUpperCaseBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_Str | 208.000μs | 1,334,312b | 1.00x
bench_Stringy | 1,507.000μs | 1,870,880b | 7.25x

### benchmark: TrimBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_right_Str | 361.000μs | 1,347,352b | 1.00x
bench_left_Str | 368.000μs | 1,347,352b | 1.02x
bench_both_Str | 431.000μs | 1,347,352b | 1.19x
bench_both_Stringy | 1,474.000μs | 1,873,536b | 4.08x
bench_left_Stringy | 1,479.000μs | 1,873,536b | 4.10x
bench_right_Stringy | 1,729.000μs | 1,873,536b | 4.79x