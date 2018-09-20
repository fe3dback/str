[![Build Status](https://travis-ci.org/fe3dback/str.svg?branch=master)](https://travis-ci.org/fe3dback/str) 
[![Coverage Status](https://coveralls.io/repos/github/fe3dback/str/badge.svg?branch=master)](https://coveralls.io/github/fe3dback/str?branch=master)
[![BCH compliance](https://bettercodehub.com/edge/badge/fe3dback/str?branch=master)](https://bettercodehub.com/)

# str/str

```php
$str = new Str('Hello, 世界');
$str->last(2); // 世界
$str->chars(); // ['世', '界']

$str
    ->ensureLeft('Hello, ') // Hello, 世界
    ->ensureRight('!!!') // Hello, 世界!!!
    ->trimRight('!') // Hello, 世界
    ->prepend('Str say - '); // Str say - Hello, 世界

$send = function (string $s) {};
$send((string)$str); // same
$send($str->getString()); // same
```