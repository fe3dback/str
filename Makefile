internal-tests:
	./vendor/bin/phpbench run --config=bench_internal.json --report=str

lib-code-tests:
	./vendor/bin/phpbench run --config=bench_lib.json --report=str

rank:
	./vendor/bin/phpbench run --config=bench_lib.json --report=str | php benchmarks/score.php

md:
	./vendor/bin/phpbench run --config=bench_lib.json --report=str -o markdown > benchmark.md
