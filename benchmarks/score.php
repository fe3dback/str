<?php

$input = '';
while (false !== ($line = fgets(STDIN))) { $input .= $line . "\r"; }

if ($input === '') { die("No input given\r\n"); }

$matches = [];
$findStr = preg_match_all('/\|\s+bench\_.*(Str[a-z]*)\s+\|\s+([\d\.\,]+)([\S]+)\s+\|/', $input, $matches);

$spendByLib = [];

foreach (array_shift($matches) as $key => $_v) {
    $libName = $matches[0][$key];
    $time = (int)str_replace(['.', ','], '', $matches[1][$key]);
    if (!array_key_exists($libName, $spendByLib)) { $spendByLib[$libName] = 0; }
    $spendByLib[$libName] += $time;
}

$fastTime = 0;
$fastestLib = false;
foreach ($spendByLib as $libName => $totalTime) {
    if ($fastTime === 0 || $totalTime < $fastTime) {
        $fastTime = $totalTime;
        $fastestLib = $libName;
    }
}

echo "RANK (sum time of all benchmarks): \n__smaller - is better!__\n\n";
echo "Target | Total Time | Diff\n--- | --- | ---\n";
foreach ($spendByLib as $libName => $totalTime) {
    print_r(vsprintf("%s | %s s. | %sx\n", [
        $libName,
        number_format($totalTime / 1000 / 1000, 3),
        $fastestLib === $libName ? '1' : number_format($totalTime / $fastTime, 1)
    ]));
}
