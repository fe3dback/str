## About

# str/str

[![Build Status](https://travis-ci.org/fe3dback/str.svg?branch=master)](https://travis-ci.org/fe3dback/str) 
[![Coverage Status](https://coveralls.io/repos/github/fe3dback/str/badge.svg?branch=master)](https://coveralls.io/github/fe3dback/str?branch=master)
[![BCH compliance](https://bettercodehub.com/edge/badge/fe3dback/str?branch=master)](https://bettercodehub.com/)

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


---------------------

## Install

__Requirements__:
- php7.1

```bash
composer require str/str
```

## Features

- [x] strongly typed
- [x] no exceptions thrown
- [x] fast
- [x] new functions

A fast string manipulation library with multi-byte support. 
Inspired by the ["Stringy"](https://github.com/danielstjules/Stringy) library, with focus on speed.

Lib uses php7 features and does not throw any 
exceptions (because all input parameters are 
strongly typed). The code is completely covered by unit tests.


---------------------

## Functions Index:

A
- <a href="#afterfirst">afterFirst</a>
- <a href="#afterlast">afterLast</a>
- <a href="#append">append</a>
- <a href="#appenduniqueidentifier">appendUniqueIdentifier</a>
- <a href="#at">at</a>

B
- <a href="#beforefirst">beforeFirst</a>
- <a href="#beforelast">beforeLast</a>
- <a href="#between">between</a>

C
- <a href="#camelize">camelize</a>
- <a href="#chars">chars</a>
- <a href="#chop">chop</a>
- <a href="#collapsewhitespace">collapseWhitespace</a>
- <a href="#contains">contains</a>
- <a href="#containsall">containsAll</a>
- <a href="#containsany">containsAny</a>
- <a href="#countsubstr">countSubstr</a>

D
- <a href="#dasherize">dasherize</a>
- <a href="#delimit">delimit</a>

E
- <a href="#endswith">endsWith</a>
- <a href="#endswithany">endsWithAny</a>
- <a href="#ensureleft">ensureLeft</a>
- <a href="#ensureright">ensureRight</a>

F
- <a href="#first">first</a>

G
- <a href="#getstring">getString</a>

H
- <a href="#haslowercase">hasLowerCase</a>
- <a href="#hasprefix">hasPrefix</a>
- <a href="#hassuffix">hasSuffix</a>
- <a href="#hasuppercase">hasUpperCase</a>
- <a href="#htmldecode">htmlDecode</a>
- <a href="#htmlencode">htmlEncode</a>
- <a href="#humanize">humanize</a>

I
- <a href="#indexof">indexOf</a>
- <a href="#indexoflast">indexOfLast</a>
- <a href="#insert">insert</a>
- <a href="#isalpha">isAlpha</a>
- <a href="#isalphanumeric">isAlphanumeric</a>
- <a href="#isbase64">isBase64</a>
- <a href="#isblank">isBlank</a>
- <a href="#isemail">isEmail</a>
- <a href="#ishexadecimal">isHexadecimal</a>
- <a href="#isipv4">isIpV4</a>
- <a href="#isipv6">isIpV6</a>
- <a href="#isjson">isJson</a>
- <a href="#islowercase">isLowerCase</a>
- <a href="#isserialized">isSerialized</a>
- <a href="#isuuidv4">isUUIDv4</a>
- <a href="#isuppercase">isUpperCase</a>

J
- <a href="#join">join</a>

L
- <a href="#last">last</a>
- <a href="#length">length</a>
- <a href="#lines">lines</a>
- <a href="#longestcommonprefix">longestCommonPrefix</a>
- <a href="#longestcommonsubstring">longestCommonSubstring</a>
- <a href="#longestcommonsuffix">longestCommonSuffix</a>
- <a href="#lowercasefirst">lowerCaseFirst</a>

M
- <a href="#make">make</a>
- <a href="#matchespattern">matchesPattern</a>
- <a href="#move">move</a>

O
- <a href="#overwrite">overwrite</a>

P
- <a href="#padboth">padBoth</a>
- <a href="#padleft">padLeft</a>
- <a href="#padright">padRight</a>
- <a href="#pop">pop</a>
- <a href="#popreversed">popReversed</a>
- <a href="#prepend">prepend</a>

Q
- <a href="#quote">quote</a>

R
- <a href="#random">random</a>
- <a href="#regexreplace">regexReplace</a>
- <a href="#removeleft">removeLeft</a>
- <a href="#removeright">removeRight</a>
- <a href="#repeat">repeat</a>
- <a href="#replace">replace</a>
- <a href="#replacewithlimit">replaceWithLimit</a>
- <a href="#reverse">reverse</a>

S
- <a href="#safetruncate">safeTruncate</a>
- <a href="#shift">shift</a>
- <a href="#shiftreversed">shiftReversed</a>
- <a href="#shuffle">shuffle</a>
- <a href="#slice">slice</a>
- <a href="#slugify">slugify</a>
- <a href="#snakeize">snakeize</a>
- <a href="#split">split</a>
- <a href="#startswith">startsWith</a>
- <a href="#startswithany">startsWithAny</a>
- <a href="#stripwhitespace">stripWhitespace</a>
- <a href="#substr">substr</a>
- <a href="#surround">surround</a>
- <a href="#swapcase">swapCase</a>

T
- <a href="#tidy">tidy</a>
- <a href="#titleize">titleize</a>
- <a href="#toascii">toAscii</a>
- <a href="#toboolean">toBoolean</a>
- <a href="#tolowercase">toLowerCase</a>
- <a href="#tospaces">toSpaces</a>
- <a href="#totabs">toTabs</a>
- <a href="#totitlecase">toTitleCase</a>
- <a href="#touppercase">toUpperCase</a>
- <a href="#trim">trim</a>
- <a href="#trimleft">trimLeft</a>
- <a href="#trimright">trimRight</a>
- <a href="#truncate">truncate</a>

U
- <a href="#underscored">underscored</a>
- <a href="#unquote">unquote</a>
- <a href="#uppercamelize">upperCamelize</a>
- <a href="#uppercasefirst">upperCaseFirst</a>

W
- <a href="#words">words</a>


## Functions List:
## afterFirst
Inserts given $substr $times into the original string after
the first occurrence of $needle.

```php
$str = new Str('foo bar baz');
echo (string)$str->afterFirst('a', 'duh', 2);
// foo baduhduhr baz
```

**Parameters:**
- string $needle 
- string $substr 
- int $times 

**Return:**
- \Str 
--------
## afterLast
Inserts given $substr $times into the original string after
the last occurrence of $needle.

```php
$str = new Str('foo bar baz');
echo (string)$str->afterLast('a', 'duh', 2);
// foo bar baduhduhz
```

**Parameters:**
- string $needle 
- string $substr 
- int $times 

**Return:**
- \Str 
--------
## append
Append $sub to the string.

```php
$str = new Str('/Acme');
echo (string)$str->append('/');
// /Acme/
```

**Parameters:**
- string $sub 

**Return:**
- \Str 
--------
## appendUniqueIdentifier
Appends a random string consisting of $possibleChars, if specified, of given $size or
random length between $size and $sizeMax to the original string.

```php
$str = new Str('foo');
echo $str->appendUniqueIdentifier(3, -1, 'foba_rz');
// foozro
```

**Parameters:**
- int $size 
- int $sizeMax 
- string $possibleChars 

**Return:**
- \Str 
--------
## at
Returns the character at $pos, with indexes starting at 0.

```php
$str = new Str('/Acme/');
echo (string)$str->at(2);
// c
```

**Parameters:**
- int $pos 

**Return:**
- \Str 
--------
## beforeFirst
Inserts given $substr $times into the original string before
the first occurrence of $needle.

```php
$str = new Str('foo bar baz');
echo (string)$str->beforeFirst('a', 'duh');
// foo bduhar baz
```

**Parameters:**
- string $needle 
- string $substr 
- int $times 

**Return:**
- \Str 
--------
## beforeLast
Inserts given $substr $times into the original string before
the last occurrence of $needle.

```php
$str = new Str('foo bar baz');
echo (string)$str->beforeLast('a', 'duh');
// foo bar bduhaz
```

**Parameters:**
- string $needle 
- string $substr 
- int $times 

**Return:**
- \Str 
--------
## between
Returns the substring between $start and $end, if found, or an empty string.
An optional $offset may be supplied from which to begin the search for the start string.

```php
$str = new Str('/Acme/');
echo (string)$str->between('/', '/');
// Acme
```

**Parameters:**
- string $start 
- string $end 
- int $offset 

**Return:**
- \Str 
--------
## camelize
Returns a camelCase version of the string. Trims surrounding spaces, capitalizes
letters following digits, spaces, dashes and underscores, and removes spaces, dashes,
as well as underscores.

```php
$str = new Str('ac me');
echo (string)$str->camelize();
// acMe
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## chars
Returns an array consisting of the characters in the string.

```php
$str = new Str('/Acme/');
echo (string)$str->chars();
// ['/', 'A', 'c', 'm', 'e', '/']
```

**Parameters:**
__nothing__

**Return:**
- array 
--------
## chop
Cuts the original string in pieces of $step size.

```php
$str = new Str('foo bar baz');
echo $str->chop(2);
// ['fo', 'o ', 'ba', 'r ', 'ba', 'z']
```

**Parameters:**
- int $step 

**Return:**
- array 
--------
## collapseWhitespace
Trims the string and replaces consecutive whitespace characters with a single space.
This includes tabs and newline characters, as well as multi-byte whitespace such as the
thin space and ideographic space.

```php
$str = new Str('foo bar baz');
echo (string)$str->collapseWhitespace();
// foo bar baz
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## contains
Check if the string contains $needle substring.

```php
$str = new Str('/Acme/');
echo $str->contains('/');
// true
$str = new Str('/Acme/');
echo $str->contains('a', false);
// true
```

**Parameters:**
- string $needle 
- bool $caseSensitive 

**Return:**
- bool 
--------
## containsAll
Returns true if the string contains all $needles, false otherwise. By default
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->containsAll(['m', 'c', '/']);
// true
```

**Parameters:**
- array $needles 
- bool $caseSensitive 

**Return:**
- bool 
--------
## containsAny
Returns true if the string contains any $needles, false otherwise. By default
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->containsAny(['foo', 'c', 'bar']);
// true
```

**Parameters:**
- array $needles 
- bool $caseSensitive 

**Return:**
- bool 
--------
## countSubstr
Returns the number of occurrences of $needle in the given string. By default
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->countSubstr('m');
// 2
```

**Parameters:**
- string $needle 
- bool $caseSensitive 

**Return:**
- int 
--------
## dasherize
Returns a lowercase and trimmed string separated by dashes. Dashes are inserted before
uppercase characters (with the exception of the first character of the string),
and in place of spaces as well as underscores.

```php
$str = new Str('Ac me');
echo (string)$str->dasherize();
// ac-me
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## delimit
Returns a lowercase and trimmed string separated by the given $delimiter. Delimiters
are inserted before uppercase characters (with the exception of the first character of the
string), and in place of spaces, dashes, and underscores. Alpha delimiters are not converted
to lowercase.

```php
$str = new Str('Ac me');
echo (string)$str->delimit('#');
// ac#me
```

**Parameters:**
- $delimiter 

**Return:**
- \Str 
--------
## endsWith
Returns true if the string ends with $substring, false otherwise. By default the comparison
is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->endsWith('e/');
// true
```

**Parameters:**
- string $substring 
- bool $caseSensitive 

**Return:**
- bool 
--------
## endsWithAny
Returns true if the string ends with any of $substrings, false otherwise. By default
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->endsWithAny(['foo', 'e/', 'bar']);
// true
```

**Parameters:**
- array $substrings 
- bool $caseSensitive 

**Return:**
- bool 
--------
## ensureLeft
Check whether $prefix exists in the string, and prepend $prefix to the string if it doesn't.

```php
$str = new Str('Acme/');
echo (string)$str->ensureLeft('/');
// /Acme/
$str = new Str('/Acme/');
echo (string)$str->ensureLeft('/');
// /Acme/
```

**Parameters:**
- string $check 

**Return:**
- \Str 
--------
## ensureRight
Check whether $suffix exists in the string, and append $suffix to the string if it doesn't.

```php
$str = new Str('/Acme');
echo (string)$str->ensureRight('/'); // /Acme/
$str = new Str('/Acme/');
echo (string)$str->ensureRight('/'); // /Acme/
```

**Parameters:**
- string $check 

**Return:**
- \Str 
--------
## first
Returns the first $length characters of the string.

```php
$str = new Str('/Acme/');
echo (string)$str->first(2);
// /A
```

**Parameters:**
- int $length 

**Return:**
- \Str 
--------
## getString


**Parameters:**
__nothing__

**Return:**
- string 
--------
## hasLowerCase
Returns true if the string contains a lower case char, false otherwise.

```php
$str = new Str('Acme');
echo $str->hasLowerCase();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## hasPrefix
Check if the string has $prefix at the start.

```php
$str = new Str('/Acme/');
echo $str->hasPrefix('/');
// true
```

**Parameters:**
- string $prefix 

**Return:**
- bool 
--------
## hasSuffix
Check if the string has $suffix at the end.

```php
$str = new Str('/Acme/');
echo $str->hasSuffix('/');
// true
```

**Parameters:**
- string $suffix 

**Return:**
- bool 
--------
## hasUpperCase
Returns true if the string contains an upper case char, false otherwise.

```php
$str = new Str('Acme');
echo $str->hasUpperCase();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## htmlDecode
Convert all HTML entities to their applicable characters. An alias of html_entity_decode.
For a list of flags, refer
to [PHP documentation](http://php.net/manual/en/function.html-entity-decode.php).

```php
$str = new Str('&lt;Acme&gt;');
echo (string)$str->htmlDecode();
// <Acme>
```

**Parameters:**
- int $flags 

**Return:**
- \Str 
--------
## htmlEncode
Convert all applicable characters to HTML entities. An alias of htmlentities.
Refer to [PHP documentation](http://php.net/manual/en/function.htmlentities.php)
for a list of flags.

```php
$str = new Str('<Acme>');
echo (string)$str->htmlEncode();
// &lt;Acme&gt;
```

**Parameters:**
- int $flags 

**Return:**
- \Str 
--------
## humanize
Capitalizes the first word of the string, replaces underscores with spaces.

```php
$str = new Str('foo_id');
echo (string)$str->humanize();
// Foo
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## indexOf
Returns the index of the first occurrence of $needle in the string, and -1 if not found.
Accepts an optional $offset from which to begin the search.

```php
$str = new Str('/Accmme/');
echo $str->indexOf('m');
// 4
```

**Parameters:**
- string $needle 
- int $offset 

**Return:**
- int 
--------
## indexOfLast
Returns the index of the last occurrence of $needle in the string, and false if not found.
Accepts an optional $offset from which to begin the search. Offsets may be negative to
count from the last character in the string.

```php
$str = new Str('/Accmme/');
echo $str->indexOfLast('m');
// 5
```

**Parameters:**
- string $needle 
- int $offset 

**Return:**
- int 
--------
## insert
Inserts $substring into the string at the $index provided.

```php
$str = new Str('/Ace/');
echo (string)$str->insert('m', 3);
// /Acme/
```

**Parameters:**
- string $substring 
- int $index 

**Return:**
- \Str 
--------
## isAlpha
Returns true if the string contains only alphabetic chars, false otherwise.

```php
$str = new Str('Acme');
echo $str->isAlpha();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isAlphanumeric
Returns true if the string contains only alphabetic and numeric chars, false otherwise.

```php
$str = new Str('Acme1');
echo $str->isAlphanumeric();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isBase64
Check if this string is valid base64 encoded
data. Function do encode(decode(s)) === s,
so this is not so fast.

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isBlank
Returns true if the string contains only whitespace chars, false otherwise.

```php
$str = new Str('Acme');
echo $str->isBlank();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isEmail
Splits the original string in pieces by '@' delimiter and returns
true in case the resulting array consists of 2 parts.

```php
$str = new Str('test@test@example.com');
echo $str->isEmail();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isHexadecimal
Returns true if the string contains only hexadecimal chars, false otherwise.

```php
$str = new Str('Acme');
echo $str->isHexadecimal();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isIpV4
Return true if this is valid ipv4 address

```php
$str = new Str('1.0.1.0');
echo $str->isIpV4();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isIpV6
Return true if this is valid ipv6 address

```php
$str = new Str('2001:cdba::3257:9652');
echo $str->isIpV6();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isJson
Returns true if the string is JSON, false otherwise. Unlike json_decode in PHP 5.x,
this method is consistent with PHP 7 and other JSON parsers, in that an empty string
is not considered valid JSON.

```php
$str = new Str('Acme');
echo $str->isJson();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isLowerCase
Returns true if the string contains only lower case chars, false otherwise.

```php
$str = new Str('Acme');
echo $str->isLowerCase();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isSerialized
Returns true if the string is serialized, false otherwise.

```php
$str = new Str('Acme');
echo $str->isSerialized();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isUUIDv4
It doesn't matter whether the given UUID has dashes.

```php
$str = new Str('76d7cac8-1bd7-11e8-accf-0ed5f89f718b');
echo $str->isUUIDv4();
// false
$str = new Str('ae815123-537f-4eb3-a9b8-35881c29e1ac');
echo $str->isUUIDv4();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## isUpperCase
Returns true if the string contains only upper case chars, false otherwise.

```php
$str = new Str('Acme');
echo $str->isUpperCase();
// false
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## join
Joins the original string with an array of other strings with the given $separator.

```php
$str = new Str('foo');
echo $str->join('*', ['bar', 'baz']);
// foo*bar*baz
```

**Parameters:**
- string $separator 
- array $otherStrings 

**Return:**
- \Str 
--------
## last
Returns the first $length characters of the string.

```php
$str = new Str('/Acme/');
echo (string)$str->last(2);
// e/
```

**Parameters:**
- int $length 

**Return:**
- \Str 
--------
## length
Returns the length of the string.

```php
$str = new Str('/Acme/');
echo $str->length();
// 6
```

**Parameters:**
__nothing__

**Return:**
- int 
--------
## lines
Splits on newlines and carriage returns, returning an array of strings
corresponding to the lines in the string.

```php
$str = new Str("Acme\r\nAcme");
echo $str->lines();
// ['Acme', 'Acme']
```

**Parameters:**
__nothing__

**Return:**
- array 
--------
## longestCommonPrefix
Returns the longest common prefix between the string and $otherStr.

```php
$str = new Str('Acme');
echo (string)$str->longestCommonPrefix('Accurate');
// Ac
```

**Parameters:**
- string $otherStr 

**Return:**
- \Str 
--------
## longestCommonSubstring
Returns the longest common substring between the string and $otherStr.
In the case of ties, it returns that which occurs first.

```php
$str = new Str('Acme');
echo (string)$str->longestCommonSubstring('meh');
// me
```

**Parameters:**
- string $otherStr 

**Return:**
- \Str 
--------
## longestCommonSuffix
Returns the longest common suffix between the string and $otherStr.

```php
$str = new Str('Acme');
echo (string)$str->longestCommonSuffix('Do believe me');
// me
```

**Parameters:**
- string $otherStr 

**Return:**
- \Str 
--------
## lowerCaseFirst
Converts the first character of the string to lower case.

```php
$str = new Str('Acme Foo');
echo (string)$str->lowerCaseFirst();
// acme Foo
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## make
Create a new Str object using static method for it.

```php
$str = Str::make('Acme');
echo (string)$str; // Acme
```

**Parameters:**
- string $str 

**Return:**
- \Str 
--------
## matchesPattern
Returns true if the string match regexp pattern

```php
$s = new Str('foo baR');
echo $str->matchesPattern('.*aR');
// true
```

**Parameters:**
- string $pattern 

**Return:**
- bool 
--------
## move
Move substring of desired $length to $destination index of the original string.
In case $destination is less than $length returns the string untouched.

```php
$str = new Str('/Acme/');
echo (string)$str->move(0, 2, 4);
// cm/Ae/
```

**Parameters:**
- int $start 
- int $length 
- int $destination 

**Return:**
- \Str 
--------
## overwrite
Replaces substring in the original string of $length with given $substr.

```php
$str = new Str('/Acme/');
echo (string)$str->overwrite(0, 2, 'BAR');
// BARcme/
```

**Parameters:**
- int $start 
- int $length 
- string $substr 

**Return:**
- \Str 
--------
## padBoth
Returns a new string of a given length such that both sides of the string are padded.

```php
$str = new Str('Acme');
echo (string)$str->padBoth(6, '/');
// /Acme/
```

**Parameters:**
- int $length 
- string $padStr 

**Return:**
- \Str 
--------
## padLeft
Returns a new string of a given length such that the beginning of the string is padded.

```php
$str = new Str('Acme/');
echo (string)$str->padLeft(6, '/');
// /Acme/
```

**Parameters:**
- int $length 
- string $padStr 

**Return:**
- \Str 
--------
## padRight
Returns a new string of a given length such that the end of the string is padded.

```php
$str = new Str('/Acme');
echo (string)$str->padRight(6, '/');
// /Acme/
```

**Parameters:**
- int $length 
- string $padStr 

**Return:**
- \Str 
--------
## pop
Returns the substring of the string from the last occurrence of $delimiter to the end.

```php
$str = new Str('Acme/foo');
echo $str->pop('/');
// foo
```

**Parameters:**
- string $delimiter 

**Return:**
- \Str 
--------
## popReversed
Returns the substring of the original string from the beginning
to the last occurrence of $delimiter.

```php
$str = new Str('Acme/foo/bar');
echo $str->popReversed('/');
// Acme/foo
```

**Parameters:**
- string $delimiter 

**Return:**
- \Str 
--------
## prepend
Prepend $sub to the string.

```php
$str = new Str('Acme/');
echo (string)$str->prepend('/');
// /Acme/
```

**Parameters:**
- string $sub 

**Return:**
- \Str 
--------
## quote
Wraps each word in the string with specified $quote.

```php
$str = new Str('foo bar baz');
echo $str->quote('*');
// *foo* *bar* *baz*
```

**Parameters:**
- string $quote 

**Return:**
- \Str 
--------
## random
Generates a random string consisting of $possibleChars, if specified, of given $size or
random length between $size and $sizeMax. If $possibleChars is not specified, the generated string
will consist of ASCII alphanumeric chars.

```php
$str = new Str('foo bar');
echo $str->random(3, -1, 'fobarz');
// zfa
$str = new Str('');
echo $str->random(3);
// 1ho
```

**Parameters:**
- int $size 
- int $sizeMax 
- string $possibleChars 

**Return:**
- \Str 
--------
## regexReplace
Replaces all occurrences of $pattern in the string by $replacement.
An alias for mb_ereg_replace(). Note that the 'i' option with multi-byte patterns in
mb_ereg_replace() requires PHP 5.6+ for correct results. This is due to a lack of support in
the bundled version of Oniguruma in PHP < 5.6, and current versions of HHVM (3.8 and below).

```php
$str = new Str('Acme Foo');
echo (string)$str->regexReplace('A', 'a');
// acme Foo
```

**Parameters:**
- string $pattern 
- string $replacement 
- string $options 

**Return:**
- \Str 
--------
## removeLeft
Returns the string with the prefix $substring removed, if present.

```php
$str = new Str('/Acme/');
echo (string)$str->removeLeft('/');
// Acme/
```

**Parameters:**
- string $substring 

**Return:**
- \Str 
--------
## removeRight
Returns the string with the suffix $substring removed, if present.

```php
$str = new Str('/Acme/');
echo (string)$str->removeRight('/');
// /Acme
```

**Parameters:**
- string $substring 

**Return:**
- \Str 
--------
## repeat
Returns a repeated string given a $multiplier. An alias for str_repeat.

```php
$str = new Str('Acme/');
echo (string)$str->repeat(2);
// Acme/Acme/
```

**Parameters:**
- int $multiplier 

**Return:**
- \Str 
--------
## replace
Replaces all occurrences of $old in the string by $new.

```php
$str = new Str('/Acme/');
echo (string)$str->replace('/', '#');
// #Acme#
```

**Parameters:**
- string $old 
- string $new 

**Return:**
- \Str 
--------
## replaceWithLimit
Replace returns a copy of the string s with the first n non-overlapping instances of
old replaced by new. If old is empty, it matches at the beginning of the string and
after each UTF-8 sequence, yielding up to k+1 replacements for a k-rune string.
If n < 0, there is no limit on the number of replacements.

```php
$str = new Str('/Acme/');
echo (string)$str->replaceWithLimit('/', '#', 1);
// #Acme/
```

**Parameters:**
- string $old 
- string $new 
- int $limit 

**Return:**
- \Str 
--------
## reverse
Returns a reversed string. A multi-byte version of strrev().

```php
$str = new Str('/Acme/');
echo (string)$str->reverse();
// /emcA/
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## safeTruncate
Truncates the string to a given $length, while ensuring that it does not split words.
If $substring is provided, and truncating occurs, the string is further truncated
so that the $substring may be appended without exceeding the desired length.

```php
$str = new Str('What are your plans today?');
echo (string)$str->safeTruncate(22, '...');
// What are your plans...
```

**Parameters:**
- int $length 
- string $substring 

**Return:**
- \Str 
--------
## shift
Returns the substring of the original string from beginning to the first occurrence
of $delimiter.

```php
$str = new Str('Acme/foo');
echo $str->shift('/');
// Acme
```

**Parameters:**
- string $delimiter 

**Return:**
- \Str 
--------
## shiftReversed
Returns the substring of the original string from the first occurrence of $delimiter to the end.

```php
$str = new Str('Acme/foo/bar');
echo $str->shiftReversed('/');
// foo/bar
```

**Parameters:**
- string $delimiter 

**Return:**
- \Str 
--------
## shuffle
A multi-byte str_shuffle() function. It returns a string with its characters in random order.

```php
$str = new Str('/Acme/');
echo (string)$str->shuffle();
// mAe//c
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## slice
Returns the substring beginning at $start, and up to, but not including the index
specified by $end. If $end is omitted, the function extracts the remaining string.
If $end is negative, it is computed from the end of the string.

```php
$str = new Str('Acme');
echo (string)$str->slice(2);
// me
```

**Parameters:**
- int $start 
- int|null $end 

**Return:**
- \Str 
--------
## slugify
Converts the string into an URL slug. This includes replacing non-ASCII characters with
their closest ASCII equivalents, removing remaining non-ASCII and non-alphanumeric characters,
and replacing whitespace with $replacement. The $replacement defaults to a single dash, and
the string is also converted to lowercase. The $language of the source string can also be
supplied for language-specific transliteration.

```php
$str = new Str('Acme foo bar!');
echo (string)$str->slugify();
// acme-foo-bar
```

**Parameters:**
- string $replacement 
- string $language 

**Return:**
- \Str 
--------
## snakeize
Returns a snake_case version of the string.

```php
$str = new Str('Foo Bar');
echo (string)$str->snakeize();
// foo_bar
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## split
Splits the string with the provided $pattern, returning an array of strings.
An optional integer $limit will truncate the results.

```php
$str = new Str('Acme#Acme');
echo $str->split('#', 1);
// ['Acme']
```

**Parameters:**
- string $pattern 
- int $limit 

**Return:**
- array 
--------
## startsWith
Returns true if the string begins with $substring, false otherwise. By default
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->startsWith('/A');
// true
```

**Parameters:**
- string $substring 
- bool $caseSensitive 

**Return:**
- bool 
--------
## startsWithAny
Returns true if the string begins with any of $substrings, false otherwise. By default
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

```php
$str = new Str('/Accmme/');
echo $str->startsWithAny(['foo', '/A', 'bar']);
// true
```

**Parameters:**
- array $substrings 
- bool $caseSensitive 

**Return:**
- bool 
--------
## stripWhitespace
Strip all whitespace characters. This includes tabs and newline characters,
as well as multi-byte whitespace such as the thin space and ideographic space.

```php
$str = new Str('Acme foo');
echo (string)$str->stripWhitespace();
// Acmefoo
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## substr
Returns the substring beginning at $start with the specified $length.
It differs from the mb_substr() function in that providing a $length of 0 will
return the rest of the string, rather than an empty string.

```php
$str = new Str('/Acme/');
echo (string)$str->substr(1, 4);
// Acme
```

**Parameters:**
- int $start 
- int $length 

**Return:**
- \Str 
--------
## surround
Surrounds the string with the given $substring.

```php
$str = new Str('Acme');
echo (string)$str->surround('/');
// /Acme/
```

**Parameters:**
- string $substring 

**Return:**
- \Str 
--------
## swapCase
Returns a case swapped version of the string.

```php
$str = new Str('foObARbAz');
echo (string)$str->swapCase();
// FOoBarBaZ
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## tidy
Returns a string with smart quotes, ellipsis characters, and dashes from Windows-1252
(commonly used in Word documents) replaced by their ASCII equivalents.

```php
$str = new Str('“I see…”');
echo (string)$str->tidy();
// "I see..."
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## titleize
Returns a trimmed string with the first letter of each word capitalized.
Also accepts an array, $ignore, allowing you to list words not to be capitalized.

```php
$str = new Str('i like to watch DVDs at home');
echo (string)$str->titleize(['at', 'to', 'the']);
// I Like to Watch Dvds at Home
```

**Parameters:**
- array $ignore 

**Return:**
- \Str 
--------
## toAscii
Returns an ASCII version of the string. A set of non-ASCII characters are replaced with
their closest ASCII counterparts, and the rest are removed by default. The $language or
locale of the source string can be supplied for language-specific transliteration in
any of the following formats: en, en_GB, or en-GB. For example, passing "de" results
in "äöü" mapping to "aeoeue" rather than "aou" as in other languages.

```php
$str = new Str('Äcmế');
echo (string)$str->toAscii();
// Acme
```

**Parameters:**
- string $language 
- bool $removeUnsupported 

**Return:**
- \Str 
--------
## toBoolean
Returns a boolean representation of the given logical string value. For example,
'true', '1', 'on' and 'yes' will return true. 'false', '0', 'off', and 'no' will
return false. In all instances, case is ignored. For other numeric strings, their
sign will determine the return value. In addition, blank strings consisting of only
whitespace will return false. For all other strings, the return value is a result of
a boolean cast.

```php
$str = new Str('yes');
echo $str->toBoolean();
// true
```

**Parameters:**
__nothing__

**Return:**
- bool 
--------
## toLowerCase
Make the string lowercase.

```php
$str = new Str('/Acme/');
echo (string)$str->toLowerCase();
// /acme/
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## toSpaces
Converts each tab in the string to some number of spaces, as defined by $tabLength.
By default, each tab is converted to 4 consecutive spaces.

```php
$str = new Str('foo    bar');
echo (string)$str->toSpaces(0);
// foobar
```

**Parameters:**
- int $tabLength 

**Return:**
- \Str 
--------
## toTabs
Converts each occurrence of some consecutive number of spaces, as defined by $tabLength,
to a tab. By default, each 4 consecutive spaces are converted to a tab.

```php
$str = new Str('foo bar');
echo (string)$str->toTabs();
// foo    bar
```

**Parameters:**
- int $tabLength 

**Return:**
- \Str 
--------
## toTitleCase
Converts the first character of each word in the string to uppercase.

```php
$str = new Str('foo bar baz');
echo (string)$str->toTitleCase();
// Foo Bar Baz
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## toUpperCase
Make the string uppercase.

```php
$str = new Str('/Acme/');
echo (string)$str->toUpperCase();
// /ACME/
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## trim
Returns a string with whitespace removed from the start and end of the string.
Supports the removal of unicode whitespace. Accepts an optional string of characters
to strip instead of the defaults.

```php
$str = new Str('/Acme/');
echo (string)$str->trim('/');
// Acme
```

**Parameters:**
- string $chars 

**Return:**
- \Str 
--------
## trimLeft
Returns a string with whitespace removed from the start of the string.
Supports the removal of unicode whitespace. Accepts an optional string of characters
to strip instead of the defaults.

```php
$str = new Str('/Acme/');
echo (string)$str->trimLeft('/');
// Acme/
```

**Parameters:**
- string $chars 

**Return:**
- \Str 
--------
## trimRight
Returns a string with whitespace removed from the end of the string.
Supports the removal of unicode whitespace. Accepts an optional string of characters
to strip instead of the defaults.

```php
$str = new Str('/Acme/');
echo (string)$str->trimRight('/');
// /Acme
```

**Parameters:**
- string $chars 

**Return:**
- \Str 
--------
## truncate
Truncates the string to a given $length. If $substring is provided, and truncating
occurs, the string is further truncated so that the substring may be appended
without exceeding the desired length.

```php
$str = new Str('What are your plans today?');
echo (string)$str->truncate(19, '...');
// What are your pl...
```

**Parameters:**
- int $length 
- string $substring 

**Return:**
- \Str 
--------
## underscored
Returns a lowercase and trimmed string separated by underscores. Underscores
are inserted before uppercase characters (with the exception of the first
character of the string), and in place of spaces as well as dashes.

```php
$str = new Str('foo Bar baz');
echo (string)$str->underscored();
// foo_bar_baz
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## unquote
Unwraps each word in the original string, deleting the specified $quote.

```php
$str = new Str('*foo* bar* ***baz*');
echo $str->unquote('*');
// foo bar baz
```

**Parameters:**
- string $quote 

**Return:**
- \Str 
--------
## upperCamelize
Returns an UpperCamelCase version of the string. It trims surrounding spaces,
capitalizes letters following digits, spaces, dashes and underscores,
and removes spaces, dashes, underscores.

```php
$str = new Str('foo bar baz');
echo (string)$str->upperCamelize();
// FooBarBaz
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## upperCaseFirst
Converts the first character of the string to upper case.

```php
$str = new Str('acme foo');
echo (string)$str->upperCaseFirst();
// Acme foo
```

**Parameters:**
__nothing__

**Return:**
- \Str 
--------
## words
Splits on whitespace, returning an array of strings corresponding to the words in the string.

```php
$str = new Str('foo bar baz');
echo $str->words();
// ['foo', 'bar', 'baz']
```

**Parameters:**
__nothing__

**Return:**
- array 
--------

---------------------

## Benchmark

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


## Development

Please use php cs fixer before commit:
https://github.com/FriendsOfPHP/PHP-CS-Fixer

you can add watcher in any IDE for automatic fix code
style on save.