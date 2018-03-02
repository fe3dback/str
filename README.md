[![Build Status](https://travis-ci.org/fe3dback/str.svg?branch=master)](https://travis-ci.org/fe3dback/str) 
[![Coverage Status](https://coveralls.io/repos/github/fe3dback/str/badge.svg?branch=master)](https://coveralls.io/github/fe3dback/str?branch=master)
[![BCH compliance](https://bettercodehub.com/edge/badge/fe3dback/str?branch=master)](https://bettercodehub.com/)

_in dev, please do not use in production_

# str/str

```php
$s = new Str('Hello, 世界');
$s->last(2); // 世界
$s->chars(); // ['H','e','l','l','o',',',' ','世','界']

$s
    ->ensureLeft('H') // Hello, 世界
    ->ensureRight('!!!') // Hello, 世界!!!
    ->trimRight('!') // Hello, 世界
    ->append('Str say - '); // Str say - Hello, 世界

$send = function (string $s) {};
$send((string)$s); // same
$send($s->toString()); // same
$send($s->getString()); // same
```

A fast string manipulation library with multi-byte support. 
Based on "Stringy" library, with focus on speed.

Lib uses php7 features and does not throw any 
exceptions (because all input parameters are 
strongly typed). The code is completely covered by unit tests.

## install

__Requirements__:
- php7.0

```bash
composer require str/str
```

## support List

### Done
- [x] ensureLeft
- [x] ensureRight
- [x] hasPrefix
- [x] hasSuffix
- [x] contains
- [x] replace - add limit param
- [x] toLowerCase
- [x] toUpperCase
- [x] trim
- [x] trimLeft
- [x] trimRight
- [x] append
- [x] prepend
- [x] at
- [x] substr
- [x] chars
- [x] first
- [x] last
- [x] length
- [x] indexOf
- [x] indexOfLast
- [x] countSubstr
- [x] containsAll
- [x] containsAny
- [x] startsWith
- [x] startsWithAny
- [x] endsWith
- [x] endsWithAny
- [x] pad
- [x] padBoth
- [x] padLeft
- [x] padRight
- [x] insert
- [x] removeLeft
- [x] removeRight
- [x] repeat
- [x] reverse
- [x] shuffle
- [x] between
- [x] camelize
- [x] collapseWhitespace
- [x] dasherize
- [x] delimit
- [x] lowerCaseFirst
- [x] regexReplace
- [x] upperCaseFirst
- [x] isUUIDv4
- [x] hasLowerCase
- [x] hasUpperCase
- [x] htmlDecode
- [x] htmlEncode
- [x] humanize
- [x] isAlpha
- [x] isAlphanumeric
- [x] isBase64
- [x] isBlank
- [x] isHexadecimal
- [x] isJson
- [x] isLowerCase
- [x] isSerialized
- [x] isUpperCase
- [x] lines
- [x] split
- [x] longestCommonPrefix
- [x] longestCommonSuffix
- [x] longestCommonSubstring
- [x] safeTruncate
- [x] slugify
- [x] toAscii
- [x] slice
- [x] stripWhitespace
- [x] truncate
- [x] upperCamelize
- [x] surround
- [x] swapCase
- [x] tidy
- [x] titleize
- [x] toBoolean
- [x] toSpaces
- [x] toTabs
- [x] toTitleCase
- [x] underscored
- [x] move
- [x] overwrite

### Todo New
- [ ] snakeize
- [ ] appendUniqueIdentifier
- [ ] afterFirst
- [ ] beforeFirst
- [ ] afterLast
- [ ] beforeLast
- [ ] ord
- [ ] quote
- [ ] unquote
- [ ] words
- [ ] formatNumber
- [ ] toNumber
- [ ] toInt
- [ ] toFloat
- [ ] join
- [ ] chop
- [ ] random
- [ ] pop
- [ ] shift
- [ ] shiftReversed
- [ ] popReversed
- [ ] isEmail
- [ ] isUrl
- [ ] isIp

## Optimization

After each mutation set, we can check string for ASCII range,
and save this to bool flag.

if flag is ON, we can use default ASCII functions, if not
we can use UTF-8 multi-byte functions.

#### benchmark: AsciiBench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_CType | 81.000μs | 1,324,128b | 1.00x
bench_MbDetectEncoding | 103.000μs | 1,324,136b | 1.27x
bench_Regex | 153.000μs | 1,324,128b | 1.89x

#### benchmark: UTF8Bench

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_ASCII | 15.000μs | 1,311,000b | 1.00x
bench_UTF8 | 197.000μs | 1,326,232b | 13.13x
bench_UTF8_ForceEncoding | 224.000μs | 1,326,248b | 14.93x
bench_UTF8_DefaultEncoding | 229.000μs | 1,326,248b | 15.27x

## benchmark

internal tests:
```bash
./vendor/bin/phpbench run --config=bench_internal.json --report=str
```

lib code tests (versus):
```bash
./vendor/bin/phpbench run --config=bench_lib.json --report=str
```

generate md:
```bash
./vendor/bin/phpbench run -o markdown --report=str
```

Test subjects:
- FS ([str/str](https://github.com/fe3dback/str))
- Stringy ([danielstjules/Stringy](https://github.com/danielstjules/Stringy))

----

subject | mode | mem_peak | diff
 --- | --- | --- | --- 
bench_StrStatic | 239.000μs | 1,328,496b | 1.00x
bench_Str | 482.000μs | 1,355,320b | 2.02x
bench_Stringy | 1,479.000μs | 1,872,552b | 6.19x
bench_StringyStatic | 1,790.000μs | 1,894,024b | 7.49x

##### [see all other benchmark results](https://github.com/fe3dback/str/blob/master/benchmark.md)
