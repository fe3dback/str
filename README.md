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

## features

- [x] strongly typed
- [x] no exceptions thrown
- [x] fast
- [x] new functions

A fast string manipulation library with multi-byte support. 
Inspired by the ["Stringy"](https://github.com/danielstjules/Stringy) library, with focus on speed.

Lib uses php7 features and does not throw any 
exceptions (because all input parameters are 
strongly typed). The code is completely covered by unit tests.

## install

__Requirements__:
- php7.0

```bash
composer require str/str
```

# Documentation with examples

### make
Create a new Str object using static method for it.
 
- __param__ *string* $str
- __return__ *Str*

__Example:__
```php
$str = Str::make('Acme');
echo (string)$str;
// Acme
```
-----

## Supported Stringy functions

### ensureLeft
Check whether $prefix exists in the string, and prepend $prefix to the string if it doesn't.
 
- __param__ *string* $prefix
- __return__ *Str*

__Example:__
```php
$str = new Str('Acme/');
echo (string)$str->ensureLeft('/');
// /Acme/

$str = new Str('/Acme/');
echo (string)$str->ensureLeft('/');
// /Acme/
```
-----
### ensureRight
Check whether $suffix exists in the string, and append $suffix to the string if it doesn't.
 
- __param__ *string* $suffix
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme');
echo (string)$str->ensureRight('/');
// /Acme/

$str = new Str('/Acme/');
echo (string)$str->ensureRight('/');
// /Acme/
```
-----
### contains
Check if the string contains $needle substring.
 
- __param__ *string* $needle
- __param__ *bool* $caseSensitive Defaults to true.
- __return__ *bool*

__Example:__
```php
$str = new Str('/Acme/');
echo $str->contains('/');
// true

$str = new Str('/Acme/');
echo $str->contains('a', false);
// true
```
-----
### replace
Replaces all occurrences of $old in the string by $new.
 
- __param__ *string* $old
- __param__ *string* $new
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->replace('/', '#');
// #Acme#
```
-----
### toLowerCase
Make the string lowercase.
 
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->toLowerCase();
// /acme/
```
-----
### toUpperCase
Make the string uppercase.
 
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->toUpperCase();
// /ACME/
```
-----
### trim
Returns a string with whitespace removed from the start and end of the string. 
Supports the removal of unicode whitespace. Accepts an optional string of characters 
to strip instead of the defaults.
 
- __param__ *string* $chars Optional string of characters to strip.
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->trim('/');
// Acme
```
-----
### trimLeft
Returns a string with whitespace removed from the start of the string. 
Supports the removal of unicode whitespace. Accepts an optional string of characters 
to strip instead of the defaults.
 
- __param__ *string* $chars Optional string of characters to strip.
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->trimLeft('/');
// Acme/
```
-----
### trimRight
Returns a string with whitespace removed from the end of the string. 
Supports the removal of unicode whitespace. Accepts an optional string of characters 
to strip instead of the defaults.
 
- __param__ *string* $chars Optional string of characters to strip.
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->trimRight('/');
// /Acme
```
-----
### append
Append $sub to the string.
 
- __param__ *string* $sub
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme');
echo (string)$str->append('/');
// /Acme/
```
-----
### prepend
Prepend $sub to the string.
 
- __param__ *string* $sub
- __return__ *Str*

__Example:__
```php
$str = new Str('Acme/');
echo (string)$str->prepend('/');
// /Acme/
```
-----
### at
Returns the character at $pos, with indexes starting at 0.
 
- __param__ *int* $pos
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->at(2);
// c
```
-----
### substr
Returns the substring beginning at $start with the specified $length. 
It differs from the mb_substr() function in that providing a $length of 0 will 
return the rest of the string, rather than an empty string.
 
- __param__ *int* $start Position of the first character to use.
- __param__ *int* $length Maximum number of characters used.
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->substr(1, 4);
// Acme
```
----- 
### chars
Returns an array consisting of the characters in the string.

- __return__ *array* An array of string chars.

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->chars();
// ['/', 'A', 'c', 'm', 'e', '/']
```
----- 
### first
Returns the first $length characters of the string.
 
- __param__ *int* $length Number of characters to retrieve from the start. Defaults to 1.
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->first(2);
// /A
```
-----
### last
Returns the first $length characters of the string.
 
- __param__ *int* $length Number of characters to retrieve from the start. Defaults to 1.
- __return__ *Str*

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->last(2);
// e/
```
-----
### length
Returns the length of the string.

- __return__ *int*

__Example:__
```php
$str = new Str('/Acme/');
echo $str->length();
// 6
```
-----
### indexOf
Returns the index of the first occurrence of $needle in the string, and -1 if not found. 
Accepts an optional $offset from which to begin the search.

- __param__ *string* $needle Substring to look for.
- __param__ *int* $offset Offset from which to search. Defaults to 0.
- __return__ *int* The occurrence's index if found, otherwise -1.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->indexOf('m');
// 4
```
-----
### indexOfLast
Returns the index of the last occurrence of $needle in the string, and false if not found. 
Accepts an optional $offset from which to begin the search. Offsets may be negative to 
count from the last character in the string.

- __param__ *string* $needle Substring to look for.
- __param__ *int* $offset Offset from which to search. Defaults to 0.
- __return__ *int* The occurrence's index if found, otherwise -1.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->indexOfLast('m');
// 5
```
-----
### countSubstr
Returns the number of occurrences of $needle in the given string. By default 
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *string* $needle Substring to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *int* The number of $needle occurrences.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->countSubstr('m');
// 2
```
-----
### containsAll
Returns true if the string contains all $needles, false otherwise. By default 
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *array* $needles Substrings to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *bool* Whether or not the string contains all $needles.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->containsAll(['m', 'c', '/']);
// true
```
-----
### containsAny
Returns true if the string contains any $needles, false otherwise. By default 
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *array* $needles Substrings to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *bool* Whether or not the string contains any $needles.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->containsAny(['foo', 'c', 'bar']);
// true
```
-----
### startsWith
Returns true if the string begins with $substring, false otherwise. By default 
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *string* $substring Substring to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *bool* Whether or not the string contains any $needles.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->startsWith('/A');
// true
```
-----
### startsWithAny
Returns true if the string begins with any of $substrings, false otherwise. By default 
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *array* $substrings Substrings to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *bool* Whether or not the string contains any $needles.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->startsWithAny(['foo', '/A', 'bar']);
// true
```
-----
### endsWith
Returns true if the string ends with $substring, false otherwise. By default the comparison 
is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *string* $substring Substring to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *bool* Whether or not the string contains any $needles.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->endsWith('e/');
// true
```
-----
### endsWithAny
Returns true if the string ends with any of $substrings, false otherwise. By default 
the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.

- __param__ *array* $substrings Substrings to look for.
- __param__ *bool* $caseSensitive Whether or not to enforce case-sensitivity. Defaults to true.
- __return__ *bool* Whether or not the string contains any $needles.

__Example:__
```php
$str = new Str('/Accmme/');
echo $str->endsWithAny(['foo', 'e/', 'bar']);
// true
```
-----
### padBoth
Returns a new string of a given length such that both sides of the string are padded.

- __param__ *int* $length Desired string length after padding.
- __param__ *string* $padStr String used to pad, defaults to space.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme');
echo (string)$str->padBoth(6, '/');
// /Acme/
```
-----
### padLeft
Returns a new string of a given length such that the beginning of the string is padded.

- __param__ *int* $length Desired string length after padding.
- __param__ *string* $padStr String used to pad, defaults to space.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme/');
echo (string)$str->padLeft(6, '/');
// /Acme/
```
-----
### padRight
Returns a new string of a given length such that the end of the string is padded.

- __param__ *int* $length Desired string length after padding.
- __param__ *string* $padStr String used to pad, defaults to space.
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme');
echo (string)$str->padRight(6, '/');
// /Acme/
```
-----
### insert
Inserts $substring into the string at the $index provided.

- __param__ *string* $substring String to be inserted.
- __param__ *int* $index The index at which to insert the substring.
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Ace/');
echo (string)$str->insert('m', 3);
// /Acme/
```
-----
### removeLeft
Returns the string with the prefix $substring removed, if present.

- __param__ *string* $substring The prefix to remove.
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->removeLeft('/');
// Acme/
```
-----
### removeRight
Returns the string with the suffix $substring removed, if present.

- __param__ *string* $substring The suffix to remove.
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->removeRight('/');
// /Acme
```
-----
### repeat
Returns a repeated string given a $multiplier. An alias for str_repeat.

- __param__ *int* $multiplier The number of times to repeat the string.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme/');
echo (string)$str->repeat(2);
// Acme/Acme/
```
-----
### reverse
Returns a reversed string. A multi-byte version of strrev().

- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->reverse();
// /emcA/
```
-----
### shuffle
A multi-byte str_shuffle() function. It returns a string with its characters in random order.

- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->shuffle();
// mAe//c
```
-----
### between
Returns the substring between $start and $end, if found, or an empty string. 
An optional $offset may be supplied from which to begin the search for the start string.

- __param__ *string* $start Delimiter marking the start of the substring.
- __param__ *string* $end Delimiter marking the end of the substring.
- __param__ *int* $offset Index from which to begin the search. Defaults to 0.
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->between('/', '/');
// Acme
```
-----
### camelize
Returns a camelCase version of the string. Trims surrounding spaces, capitalizes 
letters following digits, spaces, dashes and underscores, and removes spaces, dashes, 
as well as underscores.

- __return__ *Str* 

__Example:__
```php
$str = new Str('ac me');
echo (string)$str->camelize();
// acMe
```
-----
### collapseWhitespace
Trims the string and replaces consecutive whitespace characters with a single space. 
This includes tabs and newline characters, as well as multi-byte whitespace such as the 
thin space and ideographic space.

- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->collapseWhitespace();
// foo bar baz
```
-----
### dasherize
Returns a lowercase and trimmed string separated by dashes. Dashes are inserted before 
uppercase characters (with the exception of the first character of the string), 
and in place of spaces as well as underscores.

- __return__ *Str* 

__Example:__
```php
$str = new Str('Ac me');
echo (string)$str->dasherize();
// ac-me
```
-----
### delimit
Returns a lowercase and trimmed string separated by the given $delimiter. Delimiters 
are inserted before uppercase characters (with the exception of the first character of the 
string), and in place of spaces, dashes, and underscores. Alpha delimiters are not converted 
to lowercase.

- __param__ *string* $delimiter Sequence used to separate parts of the string.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Ac me');
echo (string)$str->delimit('#');
// ac#me
```
-----
### lowerCaseFirst
Converts the first character of the string to lower case.

- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme Foo');
echo (string)$str->lowerCaseFirst();
// acme Foo
```
-----
### upperCaseFirst
Converts the first character of the string to upper case.

- __return__ *Str* 

__Example:__
```php
$str = new Str('acme foo');
echo (string)$str->upperCaseFirst();
// Acme foo
```
-----
### regexReplace
Replaces all occurrences of $pattern in the string by $replacement. 
An alias for mb_ereg_replace(). Note that the 'i' option with multi-byte patterns in 
mb_ereg_replace() requires PHP 5.6+ for correct results. This is due to a lack of support in 
the bundled version of Oniguruma in PHP < 5.6, and current versions of HHVM (3.8 and below).

- __param__ *string* $pattern The regular expression pattern.
- __param__ *string* $replacement The string to replace with.
- __param__ *string* $options Matching conditions to be used. Defaults to 'msr'.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme Foo');
echo (string)$str->regexReplace('A', 'a');
// acme Foo
```
-----
### hasLowerCase
Returns true if the string contains a lower case char, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->hasLowerCase();
// true
```
-----
### hasUpperCase
Returns true if the string contains an upper case char, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->hasUpperCase();
// true
```
-----
### htmlDecode
Convert all HTML entities to their applicable characters. An alias of html_entity_decode. 
For a list of flags, refer 
to [PHP documentation](http://php.net/manual/en/function.html-entity-decode.php).

- __param__ *int* $flags Optional flags. Defaults to ENT_COMPAT.
- __return__ *Str* 

__Example:__
```php
$str = new Str('&lt;Acme&gt;');
echo (string)$str->htmlDecode();
// <Acme>
```
-----
### htmlEncode
Convert all applicable characters to HTML entities. An alias of htmlentities. 
Refer to [PHP documentation](http://php.net/manual/en/function.htmlentities.php) 
for a list of flags. 

- __param__ *int* $flags Optional flags. Defaults to ENT_COMPAT.
- __return__ *Str* 

__Example:__
```php
$str = new Str('<Acme>');
echo (string)$str->htmlEncode();
// &lt;Acme&gt;
```
-----
### humanize
Capitalizes the first word of the string, replaces underscores with spaces.

- __return__ *Str* 

__Example:__
```php
$str = new Str('foo_id');
echo (string)$str->humanize();
// Foo
```
-----
### isAlpha
Returns true if the string contains only alphabetic chars, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isAlpha();
// true
```
-----
### isAlphanumeric
Returns true if the string contains only alphabetic and numeric chars, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme1');
echo $str->isAlphanumeric();
// true
```
-----
### isBase64
Returns true if the string is base64 encoded, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isBase64();
// false
```
-----
### isBlank
Returns true if the string contains only whitespace chars, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isBlank();
// false
```
-----
### isHexadecimal
Returns true if the string contains only hexadecimal chars, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isHexadecimal();
// false
```
-----
### isJson
Returns true if the string is JSON, false otherwise. Unlike json_decode in PHP 5.x, 
this method is consistent with PHP 7 and other JSON parsers, in that an empty string 
is not considered valid JSON.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isJson();
// false
```
-----
### isLowerCase
Returns true if the string contains only lower case chars, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isLowerCase();
// false
```
-----
### isUpperCase
Returns true if the string contains only upper case chars, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isUpperCase();
// false
```
-----
### isSerialized
Returns true if the string is serialized, false otherwise.

- __return__ *bool* 

__Example:__
```php
$str = new Str('Acme');
echo $str->isSerialized();
// false
```
-----
### lines
Splits on newlines and carriage returns, returning an array of strings 
corresponding to the lines in the string.

- __return__ *array* 

__Example:__
```php
$str = new Str("Acme\r\nAcme");
echo $str->lines();
// ['Acme', 'Acme']
```
-----
### split
Splits the string with the provided $pattern, returning an array of strings. 
An optional integer $limit will truncate the results.

- __param__ *string* $pattern The pattern with which to split the string.
- __param__ *int* $limit Optional maximum number of results to return.
- __return__ *array* 

__Example:__
```php
$str = new Str('Acme#Acme');
echo $str->split('#', 1);
// ['Acme']
```
-----
### longestCommonPrefix
Returns the longest common prefix between the string and $otherStr.

- __param__ *string* $otherStr Second string for comparison.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme');
echo (string)$str->longestCommonPrefix('Accurate');
// Ac
```
-----
### longestCommonSuffix
Returns the longest common suffix between the string and $otherStr.

- __param__ *string* $otherStr Second string for comparison.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme');
echo (string)$str->longestCommonSuffix('Do believe me');
// me
```
-----
### longestCommonSubstring
Returns the longest common substring between the string and $otherStr. 
In the case of ties, it returns that which occurs first.

- __param__ *string* $otherStr Second string for comparison.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme');
echo (string)$str->longestCommonSubstring('meh');
// me
```
-----
### safeTruncate
Truncates the string to a given $length, while ensuring that it does not split words. 
If $substring is provided, and truncating occurs, the string is further truncated 
so that the $substring may be appended without exceeding the desired length.

- __param__ *int* $length Desired length of the truncated string.
- __param__ *string* $substring The substring to append if it can fit.
- __return__ *Str* 

__Example:__
```php
$str = new Str('What are your plans today?');
echo (string)$str->safeTruncate(22, '...');
// What are your plans...
```
-----
### slugify
Converts the string into an URL slug. This includes replacing non-ASCII characters with 
their closest ASCII equivalents, removing remaining non-ASCII and non-alphanumeric characters, 
and replacing whitespace with $replacement. The $replacement defaults to a single dash, and 
the string is also converted to lowercase. The $language of the source string can also be 
supplied for language-specific transliteration.

- __param__ *string* $replacement The string used to replace whitespace. Defaults to '-'.
- __param__ *string* $language Language of the source string. Defaults to 'en'.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme foo bar!');
echo (string)$str->slugify();
// acme-foo-bar
```
-----
### toAscii
Returns an ASCII version of the string. A set of non-ASCII characters are replaced with 
their closest ASCII counterparts, and the rest are removed by default. The $language or 
locale of the source string can be supplied for language-specific transliteration in 
any of the following formats: en, en_GB, or en-GB. For example, passing "de" results 
in "äöü" mapping to "aeoeue" rather than "aou" as in other languages.

- __param__ *string* $language Language of the source string. Defaults to 'en'.
- __param__ *bool* $removeUnsupported Whether or not to remove the unsupported characters.
Defaults to true.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Äcmế');
echo (string)$str->toAscii();
// Acme
```
-----
### slice
Returns the substring beginning at $start, and up to, but not including the index 
specified by $end. If $end is omitted, the function extracts the remaining string. 
If $end is negative, it is computed from the end of the string.

- __param__ *int* $start Initial index from which to begin extraction.
- __param__ *int* $end Optional index at which to end extraction. Optional.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme');
echo (string)$str->slice(2);
// me
```
-----
### stripWhitespace
Strip all whitespace characters. This includes tabs and newline characters, 
as well as multi-byte whitespace such as the thin space and ideographic space.

- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme foo');
echo (string)$str->stripWhitespace();
// Acmefoo
```
-----
### truncate
Truncates the string to a given $length. If $substring is provided, and truncating 
occurs, the string is further truncated so that the substring may be appended 
without exceeding the desired length.

- __param__ *int* $length Desired length of the truncated string.
- __param__ *string* $end $substring The substring to append if it can fit. Defaults to empty
string.
- __return__ *Str* 

__Example:__
```php
$str = new Str('What are your plans today?');
echo (string)$str->truncate(19, '...');
// What are your pl...
```
-----
### upperCamelize
Returns an UpperCamelCase version of the string. It trims surrounding spaces, 
capitalizes letters following digits, spaces, dashes and underscores, 
and removes spaces, dashes, underscores.

- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->upperCamelize();
// FooBarBaz
```
-----
### surround
Surrounds the string with the given $substring.

- __param__ *string* $substring The substring to add to both sides.
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme');
echo (string)$str->surround('/');
// /Acme/
```
-----
### swapCase
Returns a case swapped version of the string.

- __return__ *Str* 

__Example:__
```php
$str = new Str('foObARbAz');
echo (string)$str->swapCase();
// FOoBarBaZ
```
-----
### tidy
Returns a string with smart quotes, ellipsis characters, and dashes from Windows-1252 
(commonly used in Word documents) replaced by their ASCII equivalents.

- __return__ *Str* 

__Example:__
```php
$str = new Str('“I see…”');
echo (string)$str->tidy();
// "I see..."
```
-----
### titleize
Returns a trimmed string with the first letter of each word capitalized. 
Also accepts an array, $ignore, allowing you to list words not to be capitalized.

- __param__ *array* $ignore An array of words not to capitalize. Defaults to empty array.
- __return__ *Str* 

__Example:__
```php
$str = new Str('i like to watch DVDs at home');
echo (string)$str->titleize(['at', 'to', 'the']);
// I Like to Watch Dvds at Home
```
-----
### toBoolean
Returns a boolean representation of the given logical string value. For example, 
'true', '1', 'on' and 'yes' will return true. 'false', '0', 'off', and 'no' will 
return false. In all instances, case is ignored. For other numeric strings, their 
sign will determine the return value. In addition, blank strings consisting of only 
whitespace will return false. For all other strings, the return value is a result of 
a boolean cast.

- __return__ *bool* 

__Example:__
```php
$str = new Str('yes');
echo $str->toBoolean();
// true
```
-----
### toSpaces
Converts each tab in the string to some number of spaces, as defined by $tabLength. 
By default, each tab is converted to 4 consecutive spaces.

- __param__ *int* $tabLength Number of spaces to replace each tab with. Defaults to 4.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo	bar');
echo (string)$str->toSpaces(0);
// foobar
```
-----
### toTabs
Converts each occurrence of some consecutive number of spaces, as defined by $tabLength, 
to a tab. By default, each 4 consecutive spaces are converted to a tab.

- __param__ *int* $tabLength Number of spaces to replace each tab with. Defaults to 4.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar');
echo (string)$str->toTabs();
// foo	bar
```
-----
### toTitleCase
Converts the first character of each word in the string to uppercase.

- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->toTitleCase();
// Foo Bar Baz
```
-----
### underscored
Returns a lowercase and trimmed string separated by underscores. Underscores 
are inserted before uppercase characters (with the exception of the first 
character of the string), and in place of spaces as well as dashes.

- __return__ *Str* 

__Example:__
```php
$str = new Str('foo Bar baz');
echo (string)$str->underscored();
// foo_bar_baz
```
-----

## new

### hasPrefix
Check if the string has $prefix at the start.
 
- __param__ *string* $prefix
- __return__ *bool*

__Example:__
```php
$str = new Str('/Acme/');
echo $str->hasPrefix('/');
// true
```
-----
### hasSuffix
Check if the string has $suffix at the end.
 
- __param__ *string* $suffix
- __return__ *bool*

__Example:__
```php
$str = new Str('/Acme/');
echo $str->hasSuffix('/');
// true
```
-----
### replaceWithLimit
Replace returns a copy of the string s with the first n non-overlapping instances of 
old replaced by new. If old is empty, it matches at the beginning of the string and 
after each UTF-8 sequence, yielding up to k+1 replacements for a k-rune string. 
If n < 0, there is no limit on the number of replacements.

- __param__ *string* $old
- __param__ *string* $new
- __param__ *int* $times Defaults to -1, providing unlimited replacement.
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->replaceWithLimit('/', '#', 1);
// #Acme/
```
-----
### move
Move substring of desired $length to $destination index of the original string. 
In case $destination is less than $length returns the string untouched.

- __param__ *int* $start
- __param__ *int* $length
- __param__ *int* $destination
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->move(0, 2, 4);
// cm/Ae/
```
-----
### overwrite
Replaces substring in the original string of $length with given $substr.

- __param__ *int* $start
- __param__ *int* $length
- __param__ *string* $substr
- __return__ *Str* 

__Example:__
```php
$str = new Str('/Acme/');
echo (string)$str->overwrite(0, 2, 'BAR');
// BARcme/
```
-----
### snakeize
Returns a snake_case version of the string.

- __return__ *Str* 

__Example:__
```php
$str = new Str('Foo Bar');
echo (string)$str->snakeize();
// foo_bar
```
-----
### afterFirst
Inserts given $substr $times into the original string after 
the first occurrence of $needle.

- __param__ *string* $needle
- __param__ *string* $substr
- __param__ *int* $times Defaults to 1.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->afterFirst('a', 'duh', 2);
// foo baduhduhr baz
```
-----
### beforeFirst
Inserts given $substr $times into the original string before 
the first occurrence of $needle.

- __param__ *string* $needle
- __param__ *string* $substr
- __param__ *int* $times Defaults to 1.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->beforeFirst('a', 'duh');
// foo bduhar baz
```
-----
### afterLast
Inserts given $substr $times into the original string after 
the last occurrence of $needle.

- __param__ *string* $needle
- __param__ *string* $substr
- __param__ *int* $times Defaults to 1.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->afterLast('a', 'duh', 2);
// foo bar baduhduhz
```
-----
### beforeLast
Inserts given $substr $times into the original string before 
the last occurrence of $needle.

- __param__ *string* $needle
- __param__ *string* $substr
- __param__ *int* $times Defaults to 1.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo (string)$str->beforeLast('a', 'duh');
// foo bar bduhaz
```
-----
### isEmail
Splits the original string in pieces by '@' delimiter and returns 
true in case the resulting array consists of 2 parts.

- __return__ *bool* 

__Example:__
```php
$str = new Str('test@test@example.com');
echo $str->isEmail();
// false
```
-----
### isIpV4
Checks whether the string is a valid ip v4.

- __return__ *bool* 

__Example:__
```php
$str = new Str('192.168.1.1');
echo $str->isIpV4();
// true
```
-----
### isIpV6
Checks whether the string is a valid ip v6.

- __return__ *bool* 

__Example:__
```php
$str = new Str('1200::AB00:1234::2552:7777:1313');
echo $str->isIpV6();
// false
```
-----
### isUUIDv4
Checks if the given string is a valid UUID v.4. 
It doesn't matter whether the given UUID has dashes.

- __return__ *bool* 

__Example:__
```php
$str = new Str('76d7cac8-1bd7-11e8-accf-0ed5f89f718b');
echo $str->isUUIDv4();
// false

$str = new Str('ae815123-537f-4eb3-a9b8-35881c29e1ac');
echo $str->isUUIDv4();
// true
```
-----
### random
Generates a random string consisting of $possibleChars, if specified, of given $size or
random length between $size and $sizeMax. If $possibleChars is not specified, the generated string
will consist of ASCII alphanumeric chars.

- __param__ *int* $size The desired length of the string.
- __param__ *int* $sizeMax If given and is > $size, the generated string will have random length 
between $size and $sizeMax. Defaults to -1.
- __param__ *string* $possibleChars If given, specifies allowed characters to make the string of. 
Defaults to ASCII alphanumeric chars.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar');
echo $str->random(3, -1, 'fobarz');
// zfa

$str = new Str('');
echo $str->random(3);
// 1ho
```
-----
### appendUniqueIdentifier
Appends a random string consisting of $possibleChars, if specified, of given $size or
random length between $size and $sizeMax to the original string.

- __param__ *int* $size The desired length of the string. Defaults to 4.
- __param__ *int* $sizeMax If given and is > $size, the generated string will have random length 
between $size and $sizeMax. Defaults to -1.
- __param__ *string* $possibleChars If given, specifies allowed characters to make the string of. 
Defaults to ASCII alphanumeric chars.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo');
echo $str->appendUniqueIdentifier(3, -1, 'foba_rz');
// foozro
```
-----
### quote
Wraps each word in the string with specified $quote.

- __param__ *string* $quote Defaults to ".
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo bar baz');
echo $str->quote('*');
// *foo* *bar* *baz*
```
-----
### unquote
Unwraps each word in the original string, deleting the specified $quote.

- __param__ *string* $quote Defaults to ".
- __return__ *Str* 

__Example:__
```php
$str = new Str('*foo* bar* ***baz*');
echo $str->unquote('*');
// foo bar baz
```
-----
### words
Splits on whitespace, returning an array of strings corresponding to the words in the string.

- __return__ *array* 

__Example:__
```php
$str = new Str('foo bar baz');
echo $str->words();
// ['foo', 'bar', 'baz']
```
-----
### chop
Cuts the original string in pieces of $step size.

- __param__ *int* $step
- __return__ *array* 

__Example:__
```php
$str = new Str('foo bar baz');
echo $str->chop(2);
// ['fo', 'o ', 'ba', 'r ', 'ba', 'z']
```
-----
### join
Joins the original string with an array of other strings with the given $separator.

- __param__ *string* $separator
- __param__ *array* $otherStrings Defaults to empty array.
- __return__ *Str* 

__Example:__
```php
$str = new Str('foo');
echo $str->join('*', ['bar', 'baz']);
// foo*bar*baz
```
-----
### pop
Returns the substring of the string from the last occurrence of $delimiter to the end.

- __param__ *string* $delimiter
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme/foo');
echo $str->pop('/');
// foo
```
-----
### shift
Returns the substring of the original string from beginning to the first occurrence 
of $delimiter.

- __param__ *string* $delimiter
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme/foo');
echo $str->shift('/');
// Acme
```
-----
### shiftReversed
Returns the substring of the original string from the first occurrence of $delimiter to the end.

- __param__ *string* $delimiter
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme/foo/bar');
echo $str->shiftReversed('/');
// foo/bar
```
-----
### popReversed
Returns the substring of the original string from the beginning
to the last occurrence of $delimiter.

- __param__ *string* $delimiter
- __return__ *Str* 

__Example:__
```php
$str = new Str('Acme/foo/bar');
echo $str->popReversed('/');
// Acme/foo
```
-----

## benchmark

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

##### [see all other benchmark results](https://github.com/fe3dback/str/blob/master/benchmark.md)

## Development

Please use php cs fixer before commit:
https://github.com/FriendsOfPHP/PHP-CS-Fixer

you can add watcher in any IDE for automatic fix code
style on save.