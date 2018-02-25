# str

_in dev, please do not use in production_

PHP fast string manipulation library

[![Build Status](https://travis-ci.org/fe3dback/str.svg?branch=master)](https://travis-ci.org/fe3dback/str) [![Coverage Status](https://coveralls.io/repos/github/fe3dback/str/badge.svg?branch=master)](https://coveralls.io/github/fe3dback/str?branch=master)

## install

```bash
composer require str/str
```

## benchmark

Test subjects:
- FS ([str/str](https://github.com/fe3dback/str))
- Stringy ([danielstjules/Stringy](https://github.com/danielstjules/Stringy))

|         subject          |    mode     |  diff  |
|--------------------------|-------------|--------|
| benchFS_EnsureRight      | 105.000μs   | 1.00x  |
| benchFS_EnsureLeft       | 125.000μs   | 1.19x  |
| benchStringy_EnsureLeft  | 1,367.000μs | 13.02x |
| benchStringy_EnsureRight | 1,405.000μs | 13.38x |
