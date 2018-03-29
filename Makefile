lib-code-tests:
	./vendor/bin/phpbench run --config=bench_lib.json --report=str --iterations=10 --revs=5000

rank:
	./vendor/bin/phpbench run --config=bench_lib.json --report=str --iterations=30 --revs=1000 | php benchmarks/score.php

md:
	./vendor/bin/phpbench run --config=bench_lib.json --report=str --iterations=10 --revs=5000 -o markdown > benchmark.md

internal-tests:
	./vendor/bin/phpbench run --config=bench_internal.json --report=str --iterations=100 --revs=1000

test:
	 ./vendor/bin/phpunit
