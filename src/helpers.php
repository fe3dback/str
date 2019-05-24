<?php declare(strict_types=1);

use \Str\Str;

/*
 * This file contains string helpers for Str/Str.
 * For the documentation see the the readme on github.
 *
 * @see https://github.com/fe3dback/str
 */

function str_after_first(string $str, string $needle, string $substr, int $times = 1) : string
{
    return Str::make($str)->afterFirst($needle, $substr, $times)->getString();
}

function str_after_last(string $str, string $needle, string $substr, int $times = 1) : string
{
    return Str::make($str)->afterLast($needle, $substr, $times)->getString();
}

function str_append(string $str, string $sub) : string
{
    return Str::make($str)->append($sub)->getString();
}

function str_append_unique_identifier(string $str, int $size = 4, int $sizeMax = -1, string $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') : string
{
    return Str::make($str)->appendUniqueIdentifier($size, $sizeMax, $possibleChars)->getString();
}

function str_before_first(string $str, string $needle, string $substr, int $times = 1) : string
{
    return Str::make($str)->beforeFirst($needle, $substr, $times)->getString();
}

function str_before_last(string $str, string $needle, string $substr, int $times = 1) : string
{
    return Str::make($str)->beforeLast($needle, $substr, $times)->getString();
}

function str_between(string $str, string $start, string $end, int $offset = 0) : string
{
    return Str::make($str)->between($start, $end, $offset)->getString();
}

function str_camelize(string $str) : string
{
    return Str::make($str)->camelize()->getString();
}

function str_chars(string $str) : array
{
    return Str::make($str)->chars();
}

function str_chop(string $str, int $step) : array
{
    return Str::make($str)->chop($step);
}

function str_collapse_whitespace(string $str) : string
{
    return Str::make($str)->collapseWhitespace()->getString();
}

function str_contains_all(string $str, array $needles, bool $caseSensitive = true) : bool
{
    return Str::make($str)->containsAll($needles, $caseSensitive);
}

function str_contains_any(string $str, array $needles, bool $caseSensitive = true) : bool
{
    return Str::make($str)->containsAny($needles, $caseSensitive);
}

function str_count_substr(string $str, string $needle, bool $caseSensitive = true): int
{
    return Str::make($str)->countSubstr($needle, $caseSensitive);
}

function str_dasherize(string $str) : string
{
    return Str::make($str)->dasherize()->getString();
}

function str_delimit(string $str, $delimiter) : string
{
    return Str::make($str)->delimit($delimiter)->getString();
}

function str_ends_with(string $str, string $substring, bool $caseSensitive = true) : bool
{
    return Str::make($str)->endsWith($substring, $caseSensitive);
}

function str_ends_with_any(string $str, array $substrings, bool $caseSensitive = true): bool
{
    return Str::make($str)->endsWithAny($substrings, $caseSensitive);
}

function str_ensure_left(string $str, string $check) : string
{
    return Str::make($str)->ensureLeft($check)->getString();
}

function str_ensure_right(string $str, string $check) : string
{
    return Str::make($str)->ensureRight($check)->getString();
}

function str_first(string $str, int $length = 1) : string
{
    return Str::make($str)->first($length)->getString();
}

function str_has_lower_case(string $str) : bool
{
    return Str::make($str)->hasLowerCase();
}

function str_has_upper_case(string $str) : bool
{
    return Str::make($str)->hasUpperCase();
}

function str_html_decode(string $str, int $flags = ENT_COMPAT) : string
{
    return Str::make($str)->htmlDecode($flags)->getString();
}

function str_html_encode(string $str, int $flags = ENT_COMPAT) : string
{
    return Str::make($str)->htmlEncode($flags)->getString();
}

function str_humanize(string $str) : string
{
    return Str::make($str)->humanize()->getString();
}

function str_index_of(string $str, string $needle, int $offset = 0) : int
{
    return Str::make($str)->indexOf($needle, $offset);
}

function str_index_of_last(string $str, string $needle, int $offset = 0) : int
{
    return Str::make($str)->indexOfLast($needle, $offset);
}

function str_insert(string $str, string $substring, int $index) : string
{
    return Str::make($str)->insert($substring, $index)->getString();
}

function str_is_alpha(string $str) : bool
{
    return Str::make($str)->isAlpha();
}

function str_is_alphanumeric(string $str) : bool
{
    return Str::make($str)->isAlphanumeric();
}

function str_is_base64(string $str) : bool
{
    return Str::make($str)->isBase64();
}

function str_is_blank(string $str) : bool
{
    return Str::make($str)->isBlank();
}

function str_is_email(string $str) : bool
{
    return Str::make($str)->isEmail();
}

function str_is_hexadecimal(string $str) : bool
{
    return Str::make($str)->isHexadecimal();
}

function str_is_ipv4(string $str) : bool
{
    return Str::make($str)->isIpV4();
}

function str_is_ipv6(string $str) : bool
{
    return Str::make($str)->isIpV6();
}

function str_is_json(string $str) : bool
{
    return Str::make($str)->isJson();
}

function str_is_lower_case(string $str) : bool
{
    return Str::make($str)->isLowerCase();
}

function str_is_serialized(string $str) : bool
{
    return Str::make($str)->isSerialized();
}

function str_is_UUIDv4(string $str) : bool
{
    return Str::make($str)->isUUIDv4();
}

function str_is_upper_case(string $str) : bool
{
    return Str::make($str)->isUpperCase();
}

function str_join(string $str, string $separator, array $otherStrings = []) : string
{
    return Str::make($str)->join($separator, $otherStrings)->getString();
}

function str_last(string $str, int $length = 1) : string
{
    return Str::make($str)->last($length)->getString();
}

function str_length(string $str) : int
{
    return Str::make($str)->length();
}

function str_lines(string $str) : array
{
    return Str::make($str)->lines();
}

function str_longest_common_prefix(string $str, string $otherStr) : string
{
    return Str::make($str)->longestCommonPrefix($otherStr)->getString();
}

function str_longest_common_substr(string $str, string $otherStr) : string
{
    return Str::make($str)->longestCommonSubstring($otherStr)->getString();
}

function str_longest_common_suffix(string $str, string $otherStr) : string
{
    return Str::make($str)->longestCommonSuffix($otherStr)->getString();
}

function str_lower_case_first(string $str) : string
{
    return Str::make($str)->lowerCaseFirst()->getString();
}

function str_matches_pattern(string $str, string $pattern): bool
{
    return Str::make($str)->matchesPattern($pattern);
}

function str_move(string $str, int $start, int $length, int $destination) : string
{
    return Str::make($str)->move($start, $length, $destination)->getString();
}

function str_overwrite(string $str, int $start, int $length, string $substr) : string
{
    return Str::make($str)->overwrite($start, $length, $substr)->getString();
}

function str_pad_both(string $str, int $length, string $padStr = ' ') : string
{
    return Str::make($str)->padBoth($length, $padStr)->getString();
}

function str_pad_left(string $str, int $length, string $padStr = ' ') : string
{
    return Str::make($str)->padLeft($length, $padStr)->getString();
}

function str_pad_right(string $str, int $length, string $padStr = ' ') : string
{
    return Str::make($str)->padRight($length, $padStr)->getString();
}

function str_pop(string $str, string $delimiter) : string
{
    return Str::make($str)->pop($delimiter)->getString();
}

function str_pop_reversed(string $str, string $delimiter) : string
{
    return Str::make($str)->popReversed($delimiter)->getString();
}

function str_prepend(string $str, string $sub) : string
{
    return Str::make($str)->prepend($sub)->getString();
}

function str_quote(string $str, string $quote = '"') : string
{
    return Str::make($str)->quote($quote)->getString();
}

function str_random(string $str, int $size, int $sizeMax = -1, string $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') : string
{
    return Str::make($str)->random($size, $sizeMax, $possibleChars)->getString();
}

function str_regex_replace(string $str, string $pattern, string $replacement, string $options = 'msr') : string
{
    return Str::make($str)->regexReplace($pattern, $replacement, $options)->getString();
}

function str_remove_left(string $str, string $substring) : string
{
    return Str::make($str)->removeLeft($substring)->getString();
}

function str_remove_right(string $str, string $substring) : string
{
    return Str::make($str)->removeRight($substring)->getString();
}

function str_replace_with_limit(string $str, string $old, string $new, int $limit = -1) : string
{
    return Str::make($str)->replaceWithLimit($old, $new, $limit)->getString();
}

function str_reverse(string $str) : string
{
    return Str::make($str)->reverse()->getString();
}

function str_safeTruncate(string $str, int $length, string $substring = '') : string
{
    return Str::make($str)->safeTruncate($length, $substring)->getString();
}

function str_shift(string $str, string $delimiter) : string
{
    return Str::make($str)->shift($delimiter)->getString();
}

function str_shift_reversed(string $str, string $delimiter) : string
{
    return Str::make($str)->shiftReversed($delimiter)->getString();
}

function str_shuffle(string $str) : string
{
    return Str::make($str)->shuffle()->getString();
}

function str_slice(string $str, int $start, int $end = null) : string
{
    return Str::make($str)->slice($start, $end)->getString();
}

function str_slugify(string $str, string $replacement = '-', string $language = 'en') : string
{
    return Str::make($str)->slugify($replacement, $language)->getString();
}

function str_snakeize(string $str) : string
{
    return Str::make($str)->snakeize()->getString();
}

function str_split(string $str, string $pattern, int $limit = -1): array
{
    return Str::make($str)->split($pattern, $limit);
}

function str_starts_with(string $str, string $substring, bool $caseSensitive = true): bool
{
    return Str::make($str)->startsWith($substring, $caseSensitive);
}

function str_starts_with_any(string $str, array $substrings, bool $caseSensitive = true): bool
{
    return Str::make($str)->startsWithAny($substrings, $caseSensitive);
}

function str_strip_whitespace(string $str) : string
{
    return Str::make($str)->stripWhitespace()->getString();
}

function str_substr(string $str, int $start = 0, int $length = 0) : string
{
    return Str::make($str)->substr($start, $length)->getString();
}

function str_surround(string $str, string $substring) : string
{
    return Str::make($str)->surround($substring)->getString();
}

function str_swap_case(string $str) : string
{
    return Str::make($str)->swapCase()->getString();
}

function str_tidy(string $str) : string
{
    return Str::make($str)->tidy()->getString();
}

function str_titleize(string $str) : string
{
    return Str::make($str)->titleize()->getString();
}

function str_to_ascii(string $str) : string
{
    return Str::make($str)->toAscii()->getString();
}

function str_to_bool(string $str) : bool
{
    return Str::make($str)->toBoolean();
}

function str_to_lower_case(string $str) : string
{
    return Str::make($str)->toLowerCase()->getString();
}

function str_tabs_to_spaces(string $str, int $tabLength = 4) : string
{
    return Str::make($str)->toSpaces($tabLength)->getString();
}

function str_spaces_to_tabs(string $str, int $tabLength = 4) : string
{
    return Str::make($str)->toTabs($tabLength)->getString();
}

function str_to_title_case(string $str) : string
{
    return Str::make($str)->toTitleCase()->getString();
}

function str_to_upper_case(string $str) : string
{
    return Str::make($str)->toUpperCase()->getString();
}

function str_trim(string $str, string $chars = '') : string
{
    return Str::make($str)->trim($chars)->getString();
}

function str_trim_left(string $str, string $chars = '') : string
{
    return Str::make($str)->trimLeft($chars)->getString();
}

function str_trim_right(string $str, string $chars = '') : string
{
    return Str::make($str)->trimRight($chars)->getString();
}

function str_truncate(string $str, int $length, string $substring = '') : string
{
    return Str::make($str)->truncate($length, $substring)->getString();
}

function str_underscored(string $str) : string
{
    return Str::make($str)->underscored()->getString();
}

function str_unquote(string $str, string $quote = '"') : string
{
    return Str::make($str)->unquote($quote)->getString();
}

function str_upper_camelize(string $str) : string
{
    return Str::make($str)->upperCamelize()->getString();
}

function str_upper_case_first(string $str) : string
{
    return Str::make($str)->upperCaseFirst()->getString();
}

function str_words(string $str) : array
{
    return Str::make($str)->words();
}
