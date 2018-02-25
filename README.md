# str

_in dev, please do not use in production_

A fast string manipulation library with multibyte support. 
Based on "Stringy" library, with focus on speed.

[![Build Status](https://travis-ci.org/fe3dback/str.svg?branch=master)](https://travis-ci.org/fe3dback/str) [![Coverage Status](https://coveralls.io/repos/github/fe3dback/str/badge.svg?branch=master)](https://coveralls.io/github/fe3dback/str?branch=master)

## install

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

### Todo Stringy
- [ ] between
- [ ] camelize
- [ ] collapseWhitespace
- [ ] containsAll
- [ ] containsAny
- [ ] countSubstr
- [ ] dasherize
- [ ] delimit
- [ ] endsWith
- [ ] endsWithAny
- [ ] getEncoding
- [ ] hasLowerCase
- [ ] hasUpperCase
- [ ] htmlDecode
- [ ] htmlEncode
- [ ] humanize
- [ ] indexOf
- [ ] indexOfLast
- [ ] insert
- [ ] isAlpha
- [ ] isAlphanumeric
- [ ] isBase64
- [ ] isBlank
- [ ] isHexadecimal
- [ ] isJson
- [ ] isLowerCase
- [ ] isSerialized
- [ ] isUpperCase
- [ ] lines
- [ ] longestCommonPrefix
- [ ] longestCommonSuffix
- [ ] longestCommonSubstring
- [ ] lowerCaseFirst
- [ ] pad
- [ ] padBoth
- [ ] padLeft
- [ ] padRight
- [ ] regexReplace
- [ ] removeLeft
- [ ] removeRight
- [ ] repeat
- [ ] reverse
- [ ] safeTruncate
- [ ] shuffle
- [ ] slugify
- [ ] slice
- [ ] split
- [ ] startsWith
- [ ] startsWithAny
- [ ] stripWhitespace
- [ ] surround
- [ ] swapCase
- [ ] tidy
- [ ] titleize
- [ ] toAscii
- [ ] toBoolean
- [ ] toSpaces
- [ ] toTabs
- [ ] toTitleCase
- [ ] truncate
- [ ] underscored
- [ ] upperCamelize
- [ ] upperCaseFirst

## benchmark

Test subjects:
- FS ([str/str](https://github.com/fe3dback/str))
- Stringy ([danielstjules/Stringy](https://github.com/danielstjules/Stringy))

|  benchmark   |      subject      |    mode     | diff  |
|--------------|-------------------|-------------|-------|
| FSBench      | bench_Upper       | 202.000μs   | 1.00x |
| FSBench      | bench_EnsureRight | 305.000μs   | 1.51x |
| FSBench      | bench_EnsureLeft  | 315.000μs   | 1.56x |
| FSBench      | bench_Replace     | 328.000μs   | 1.62x |
| FSBench      | bench_TrimRight   | 336.000μs   | 1.66x |
| FSBench      | bench_Trim        | 344.000μs   | 1.70x |
| FSBench      | bench_TrimLeft    | 367.000μs   | 1.82x |
| StringyBench | bench_Trim        | 1,482.000μs | 7.34x |
| StringyBench | bench_TrimRight   | 1,497.000μs | 7.41x |
| StringyBench | bench_TrimLeft    | 1,504.000μs | 7.45x |
| StringyBench | bench_Upper       | 1,543.000μs | 7.64x |
| StringyBench | bench_EnsureRight | 1,581.000μs | 7.83x |
| StringyBench | bench_EnsureLeft  | 1,600.000μs | 7.92x |
| StringyBench | bench_Replace     | 1,988.000μs | 9.84x |
