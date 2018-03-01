<?php

declare(strict_types=1);

namespace Str\Lib;

class StrCommonMB
{
    /**
     * Returns language-specific replacements for the toAscii() method.
     * For example, German will map 'ä' to 'ae', while other languages
     * will simply return 'a'.
     *
     * @param  string $language Language of the source string.
     * @return array  An array of replacements.
     */
    final public static function langSpecificCharsArray(string $language = 'en'): array
    {
        $split = preg_split('/[-_]/', $language);
        $language = strtolower($split[0]);

        static $charsArray;
        if (isset($charsArray[$language])) {
            return $charsArray[$language];
        }

        $languageSpecific = [
            'de' => [
                ['ä',  'ö',  'ü',  'Ä',  'Ö',  'Ü' ],
                ['ae', 'oe', 'ue', 'AE', 'OE', 'UE'],
            ],
            'bg' => [
                ['х', 'Х', 'щ', 'Щ', 'ъ', 'Ъ', 'ь', 'Ь'],
                ['h', 'H', 'sht', 'SHT', 'a', 'А', 'y', 'Y']
            ]
        ];

        if (isset($languageSpecific[$language])) {
            $charsArray[$language] = $languageSpecific[$language];
        } else {
            $charsArray[$language] = [];
        }

        return $charsArray[$language];
    }

    /**
     * Returns the replacements for the toAscii() method.
     *
     * @return array An array of replacements.
     */
    final public static function charsArray(): array
    {
        static $charsArray;
        if (null !== $charsArray) { return $charsArray; }

        /** @noinspection UselessReturnInspection */
        return $charsArray = [
            '0'     => ['°', '₀', '۰', '０'],
            '1'     => ['¹', '₁', '۱', '１'],
            '2'     => ['²', '₂', '۲', '２'],
            '3'     => ['³', '₃', '۳', '３'],
            '4'     => ['⁴', '₄', '۴', '٤', '４'],
            '5'     => ['⁵', '₅', '۵', '٥', '５'],
            '6'     => ['⁶', '₆', '۶', '٦', '６'],
            '7'     => ['⁷', '₇', '۷', '７'],
            '8'     => ['⁸', '₈', '۸', '８'],
            '9'     => ['⁹', '₉', '۹', '９'],
            'a'     => ['à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ',
                'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ā', 'ą', 'å',
                'α', 'ά', 'ἀ', 'ἁ', 'ἂ', 'ἃ', 'ἄ', 'ἅ', 'ἆ', 'ἇ',
                'ᾀ', 'ᾁ', 'ᾂ', 'ᾃ', 'ᾄ', 'ᾅ', 'ᾆ', 'ᾇ', 'ὰ', 'ά',
                'ᾰ', 'ᾱ', 'ᾲ', 'ᾳ', 'ᾴ', 'ᾶ', 'ᾷ', 'а', 'أ', 'အ',
                'ာ', 'ါ', 'ǻ', 'ǎ', 'ª', 'ა', 'अ', 'ا', 'ａ', 'ä'],
            'b'     => ['б', 'β', 'ب', 'ဗ', 'ბ', 'ｂ'],
            'c'     => ['ç', 'ć', 'č', 'ĉ', 'ċ', 'ｃ'],
            'd'     => ['ď', 'ð', 'đ', 'ƌ', 'ȡ', 'ɖ', 'ɗ', 'ᵭ', 'ᶁ', 'ᶑ',
                'д', 'δ', 'د', 'ض', 'ဍ', 'ဒ', 'დ', 'ｄ'],
            'e'     => ['é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ',
                'ệ', 'ë', 'ē', 'ę', 'ě', 'ĕ', 'ė', 'ε', 'έ', 'ἐ',
                'ἑ', 'ἒ', 'ἓ', 'ἔ', 'ἕ', 'ὲ', 'έ', 'е', 'ё', 'э',
                'є', 'ə', 'ဧ', 'ေ', 'ဲ', 'ე', 'ए', 'إ', 'ئ', 'ｅ'],
            'f'     => ['ф', 'φ', 'ف', 'ƒ', 'ფ', 'ｆ'],
            'g'     => ['ĝ', 'ğ', 'ġ', 'ģ', 'г', 'ґ', 'γ', 'ဂ', 'გ', 'گ',
                'ｇ'],
            'h'     => ['ĥ', 'ħ', 'η', 'ή', 'ح', 'ه', 'ဟ', 'ှ', 'ჰ', 'ｈ'],
            'i'     => ['í', 'ì', 'ỉ', 'ĩ', 'ị', 'î', 'ï', 'ī', 'ĭ', 'į',
                'ı', 'ι', 'ί', 'ϊ', 'ΐ', 'ἰ', 'ἱ', 'ἲ', 'ἳ', 'ἴ',
                'ἵ', 'ἶ', 'ἷ', 'ὶ', 'ί', 'ῐ', 'ῑ', 'ῒ', 'ΐ', 'ῖ',
                'ῗ', 'і', 'ї', 'и', 'ဣ', 'ိ', 'ီ', 'ည်', 'ǐ', 'ი',
                'इ', 'ی', 'ｉ'],
            'j'     => ['ĵ', 'ј', 'Ј', 'ჯ', 'ج', 'ｊ'],
            'k'     => ['ķ', 'ĸ', 'к', 'κ', 'Ķ', 'ق', 'ك', 'က', 'კ', 'ქ',
                'ک', 'ｋ'],
            'l'     => ['ł', 'ľ', 'ĺ', 'ļ', 'ŀ', 'л', 'λ', 'ل', 'လ', 'ლ',
                'ｌ'],
            'm'     => ['м', 'μ', 'م', 'မ', 'მ', 'ｍ'],
            'n'     => ['ñ', 'ń', 'ň', 'ņ', 'ŉ', 'ŋ', 'ν', 'н', 'ن', 'န',
                'ნ', 'ｎ'],
            'o'     => ['ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ',
                'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ø', 'ō', 'ő',
                'ŏ', 'ο', 'ὀ', 'ὁ', 'ὂ', 'ὃ', 'ὄ', 'ὅ', 'ὸ', 'ό',
                'о', 'و', 'θ', 'ို', 'ǒ', 'ǿ', 'º', 'ო', 'ओ', 'ｏ',
                'ö'],
            'p'     => ['п', 'π', 'ပ', 'პ', 'پ', 'ｐ'],
            'q'     => ['ყ', 'ｑ'],
            'r'     => ['ŕ', 'ř', 'ŗ', 'р', 'ρ', 'ر', 'რ', 'ｒ'],
            's'     => ['ś', 'š', 'ş', 'с', 'σ', 'ș', 'ς', 'س', 'ص', 'စ',
                'ſ', 'ს', 'ｓ'],
            't'     => ['ť', 'ţ', 'т', 'τ', 'ț', 'ت', 'ط', 'ဋ', 'တ', 'ŧ',
                'თ', 'ტ', 'ｔ'],
            'u'     => ['ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ',
                'ự', 'û', 'ū', 'ů', 'ű', 'ŭ', 'ų', 'µ', 'у', 'ဉ',
                'ု', 'ူ', 'ǔ', 'ǖ', 'ǘ', 'ǚ', 'ǜ', 'უ', 'उ', 'ｕ',
                'ў', 'ü'],
            'v'     => ['в', 'ვ', 'ϐ', 'ｖ'],
            'w'     => ['ŵ', 'ω', 'ώ', 'ဝ', 'ွ', 'ｗ'],
            'x'     => ['χ', 'ξ', 'ｘ'],
            'y'     => ['ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'ÿ', 'ŷ', 'й', 'ы', 'υ',
                'ϋ', 'ύ', 'ΰ', 'ي', 'ယ', 'ｙ'],
            'z'     => ['ź', 'ž', 'ż', 'з', 'ζ', 'ز', 'ဇ', 'ზ', 'ｚ'],
            'aa'    => ['ع', 'आ', 'آ'],
            'ae'    => ['æ', 'ǽ'],
            'ai'    => ['ऐ'],
            'ch'    => ['ч', 'ჩ', 'ჭ', 'چ'],
            'dj'    => ['ђ', 'đ'],
            'dz'    => ['џ', 'ძ'],
            'ei'    => ['ऍ'],
            'gh'    => ['غ', 'ღ'],
            'ii'    => ['ई'],
            'ij'    => ['ĳ'],
            'kh'    => ['х', 'خ', 'ხ'],
            'lj'    => ['љ'],
            'nj'    => ['њ'],
            'oe'    => ['œ', 'ؤ'],
            'oi'    => ['ऑ'],
            'oii'   => ['ऒ'],
            'ps'    => ['ψ'],
            'sh'    => ['ш', 'შ', 'ش'],
            'shch'  => ['щ'],
            'ss'    => ['ß'],
            'sx'    => ['ŝ'],
            'th'    => ['þ', 'ϑ', 'ث', 'ذ', 'ظ'],
            'ts'    => ['ц', 'ც', 'წ'],
            'uu'    => ['ऊ'],
            'ya'    => ['я'],
            'yu'    => ['ю'],
            'zh'    => ['ж', 'ჟ', 'ژ'],
            '(c)'   => ['©'],
            'A'     => ['Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ',
                'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Å', 'Ā', 'Ą',
                'Α', 'Ά', 'Ἀ', 'Ἁ', 'Ἂ', 'Ἃ', 'Ἄ', 'Ἅ', 'Ἆ', 'Ἇ',
                'ᾈ', 'ᾉ', 'ᾊ', 'ᾋ', 'ᾌ', 'ᾍ', 'ᾎ', 'ᾏ', 'Ᾰ', 'Ᾱ',
                'Ὰ', 'Ά', 'ᾼ', 'А', 'Ǻ', 'Ǎ', 'Ａ', 'Ä'],
            'B'     => ['Б', 'Β', 'ब', 'Ｂ'],
            'C'     => ['Ç','Ć', 'Č', 'Ĉ', 'Ċ', 'Ｃ'],
            'D'     => ['Ď', 'Ð', 'Đ', 'Ɖ', 'Ɗ', 'Ƌ', 'ᴅ', 'ᴆ', 'Д', 'Δ',
                'Ｄ'],
            'E'     => ['É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ',
                'Ệ', 'Ë', 'Ē', 'Ę', 'Ě', 'Ĕ', 'Ė', 'Ε', 'Έ', 'Ἐ',
                'Ἑ', 'Ἒ', 'Ἓ', 'Ἔ', 'Ἕ', 'Έ', 'Ὲ', 'Е', 'Ё', 'Э',
                'Є', 'Ə', 'Ｅ'],
            'F'     => ['Ф', 'Φ', 'Ｆ'],
            'G'     => ['Ğ', 'Ġ', 'Ģ', 'Г', 'Ґ', 'Γ', 'Ｇ'],
            'H'     => ['Η', 'Ή', 'Ħ', 'Ｈ'],
            'I'     => ['Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Î', 'Ï', 'Ī', 'Ĭ', 'Į',
                'İ', 'Ι', 'Ί', 'Ϊ', 'Ἰ', 'Ἱ', 'Ἳ', 'Ἴ', 'Ἵ', 'Ἶ',
                'Ἷ', 'Ῐ', 'Ῑ', 'Ὶ', 'Ί', 'И', 'І', 'Ї', 'Ǐ', 'ϒ',
                'Ｉ'],
            'J'     => ['Ｊ'],
            'K'     => ['К', 'Κ', 'Ｋ'],
            'L'     => ['Ĺ', 'Ł', 'Л', 'Λ', 'Ļ', 'Ľ', 'Ŀ', 'ल', 'Ｌ'],
            'M'     => ['М', 'Μ', 'Ｍ'],
            'N'     => ['Ń', 'Ñ', 'Ň', 'Ņ', 'Ŋ', 'Н', 'Ν', 'Ｎ'],
            'O'     => ['Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ',
                'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ø', 'Ō', 'Ő',
                'Ŏ', 'Ο', 'Ό', 'Ὀ', 'Ὁ', 'Ὂ', 'Ὃ', 'Ὄ', 'Ὅ', 'Ὸ',
                'Ό', 'О', 'Θ', 'Ө', 'Ǒ', 'Ǿ', 'Ｏ', 'Ö'],
            'P'     => ['П', 'Π', 'Ｐ'],
            'Q'     => ['Ｑ'],
            'R'     => ['Ř', 'Ŕ', 'Р', 'Ρ', 'Ŗ', 'Ｒ'],
            'S'     => ['Ş', 'Ŝ', 'Ș', 'Š', 'Ś', 'С', 'Σ', 'Ｓ'],
            'T'     => ['Ť', 'Ţ', 'Ŧ', 'Ț', 'Т', 'Τ', 'Ｔ'],
            'U'     => ['Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ',
                'Ự', 'Û', 'Ū', 'Ů', 'Ű', 'Ŭ', 'Ų', 'У', 'Ǔ', 'Ǖ',
                'Ǘ', 'Ǚ', 'Ǜ', 'Ｕ', 'Ў', 'Ü'],
            'V'     => ['В', 'Ｖ'],
            'W'     => ['Ω', 'Ώ', 'Ŵ', 'Ｗ'],
            'X'     => ['Χ', 'Ξ', 'Ｘ'],
            'Y'     => ['Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ', 'Ÿ', 'Ῠ', 'Ῡ', 'Ὺ', 'Ύ',
                'Ы', 'Й', 'Υ', 'Ϋ', 'Ŷ', 'Ｙ'],
            'Z'     => ['Ź', 'Ž', 'Ż', 'З', 'Ζ', 'Ｚ'],
            'AE'    => ['Æ', 'Ǽ'],
            'Ch'    => ['Ч'],
            'Dj'    => ['Ђ'],
            'Dz'    => ['Џ'],
            'Gx'    => ['Ĝ'],
            'Hx'    => ['Ĥ'],
            'Ij'    => ['Ĳ'],
            'Jx'    => ['Ĵ'],
            'Kh'    => ['Х'],
            'Lj'    => ['Љ'],
            'Nj'    => ['Њ'],
            'Oe'    => ['Œ'],
            'Ps'    => ['Ψ'],
            'Sh'    => ['Ш'],
            'Shch'  => ['Щ'],
            'Ss'    => ['ẞ'],
            'Th'    => ['Þ'],
            'Ts'    => ['Ц'],
            'Ya'    => ['Я'],
            'Yu'    => ['Ю'],
            'Zh'    => ['Ж'],
            ' '     => ["\xC2\xA0", "\xE2\x80\x80", "\xE2\x80\x81",
                "\xE2\x80\x82", "\xE2\x80\x83", "\xE2\x80\x84",
                "\xE2\x80\x85", "\xE2\x80\x86", "\xE2\x80\x87",
                "\xE2\x80\x88", "\xE2\x80\x89", "\xE2\x80\x8A",
                "\xE2\x80\xAF", "\xE2\x81\x9F", "\xE3\x80\x80",
                "\xEF\xBE\xA0"],
        ];
    }

    /**
     * Check if the string has $prefix at the start
     *
     * @param  string $s
     * @param  string $prefix
     * @return bool
     */
    final public static function hasPrefix(string $s, string $prefix): bool
    {
        if ($s === '' || $prefix === '') { return false; }

        return (0 === \mb_strpos($s, $prefix));
    }

    /**
     * Check if the string has $suffix at the end
     *
     * @param  string $s
     * @param  string $suffix
     * @return bool
     */
    final public static function hasSuffix(string $s, string $suffix): bool
    {
        if ($s === '' || $suffix === '') { return false; }

        return \mb_substr($s, -\mb_strlen($suffix)) === $suffix;
    }

    /**
     * Return string length
     *
     * @param  string $str
     * @return int
     */
    final public static function length(string $str): int
    {
        return \mb_strlen($str);
    }

    /**
     * Check if $haystack contains $needle substring
     *
     * @param  string $haystack
     * @param  string $needle
     * @param  bool $caseSensitive
     * @return bool
     */
    final public static function contains(string $haystack, string $needle, bool $caseSensitive = true): bool
    {
        if ($haystack === '' || $needle === '') { return true; }

        if ($caseSensitive) {
            return false !== \mb_strpos($haystack, $needle);
        }

        return (false !== \mb_stripos($haystack, $needle));
    }

    /**
     * Returns the index of the first occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search.
     *
     * @param  string $haystack
     * @param  string $needle Substring to look for
     * @param  int $offset Offset from which to search
     * @return int The occurrence's index if found, otherwise -1
     */
    final public static function indexOf(string $haystack, string $needle, int $offset = 0): int
    {
        if ($needle === '' || $haystack === '')  { return -1; }

        $maxLen = \mb_strlen($haystack);

        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }

        if ($offset > $maxLen)  { return -1; }

        if ($offset < 0)  { return -1; }

        $pos = \mb_strpos($haystack, $needle, $offset);

        return false === $pos ? -1 : $pos;
    }

    /**
     * Returns the index of the last occurrence of $needle in the string,
     * and false if not found. Accepts an optional offset from which to begin
     * the search. Offsets may be negative to count from the last character
     * in the string.
     *
     * @param  string $haystack
     * @param  string $needle Substring to look for
     * @param  int $offset Offset from which to search
     * @return int The last occurrence's index if found, otherwise -1
     */
    final public static function indexOfLast(string $haystack, string $needle, int $offset = 0): int
    {
        if ($needle === '' || $haystack === '') { return -1; }

        $maxLen = \mb_strlen($haystack);

        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }

        if ($offset > $maxLen) { return -1; }

        if ($offset < 0) { return -1; }

        $pos = \mb_strrpos($haystack, $needle, $offset) ?: -1;

        return false === $pos ? -1 : $pos;
    }

    /**
     * Returns the number of occurrences of $substring in the given string.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $haystack
     * @param  string $needle The substring to search for
     * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
     * @return int The number of $substring occurrences
     */
    final public static function countSubstr(string $haystack, string $needle, bool $caseSensitive = true): int
    {
        if ($caseSensitive) {
            return \mb_substr_count($haystack, $needle);
        }

        $haystack = (string)\mb_strtoupper($haystack);
        $needle = (string)\mb_strtoupper($needle);

        return \mb_substr_count($haystack, $needle);
    }

    /**
     * Returns true if the string contains all $needles, false otherwise. By
     * default the comparison is case-sensitive, but can be made insensitive by
     * setting $caseSensitive to false.
     *
     * @param  string $str
     * @param  string[] $needles Substrings to look for
     * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool Whether or not $str contains $needle
     */
    final public static function containsAll(string $str, array $needles, bool $caseSensitive = true): bool
    {
        if (empty($needles)) { return false; }

        foreach ($needles as $needle) {
            if (!self::contains($str, $needle, $caseSensitive)) { return false; }
        }

        return true;
    }

    /**
     * Returns true if the string contains any $needles, false otherwise. By
     * default the comparison is case-sensitive, but can be made insensitive by
     * setting $caseSensitive to false.
     *
     * @param  string $str
     * @param  string[] $needles Substrings to look for
     * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool Whether or not $str contains $needle
     */
    final public static function containsAny(string $str, array $needles, bool $caseSensitive = true): bool
    {
        if (empty($needles)) { return false; }

        foreach ($needles as $needle) {
            if (self::contains($str, $needle, $caseSensitive)) { return true; }
        }

        return false;
    }

    /**
     * Returns true if the string begins with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $str
     * @param  string $substring The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool   Whether or not $str starts with $substring
     */
    final public static function startsWith(string $str, string $substring, bool $caseSensitive = true): bool
    {
        if ('' === $str && '' !== $substring) { return false; }

        $substringLength = \mb_strlen($substring);
        $startOfStr = \mb_substr($str, 0, $substringLength);

        if (!$caseSensitive) {
            $substring = (string)\mb_strtolower($substring);
            $startOfStr = \mb_strtolower($startOfStr);
        }

        return $substring === $startOfStr;
    }

    /**
     * Returns true if the string begins with any of $substrings, false
     * otherwise. By default the comparison is case-sensitive, but can be made
     * insensitive by setting $caseSensitive to false.
     *
     * @param  string   $str
     * @param  string[] $substrings Substrings to look for
     * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool     Whether or not $str starts with $substring
     */
    final public static function startsWithAny(string $str, array $substrings, bool $caseSensitive = true): bool
    {
        if (empty($substrings)) { return false; }

        foreach ($substrings as $substring) {
            if (self::startsWith($str, $substring, $caseSensitive)) { return true; }
        }

        return false;
    }

    /**
     * Returns true if the string ends with $substring, false otherwise. By
     * default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string $str
     * @param  string $substring The substring to look for
     * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool   Whether or not $str ends with $substring
     */
    final public static function endsWith(string $str, string $substring, bool $caseSensitive = true): bool
    {
        $substringLength = \mb_strlen($substring);
        $strLength = \mb_strlen($str);

        $endOfStr = \mb_substr($str, $strLength - $substringLength, $substringLength);

        if (!$caseSensitive) {
            $substring = (string)\mb_strtolower($substring);
            $endOfStr = \mb_strtolower($endOfStr);
        }

        return $substring === $endOfStr;
    }

    /**
     * Returns true if the string ends with any of $substrings, false otherwise.
     * By default, the comparison is case-sensitive, but can be made insensitive
     * by setting $caseSensitive to false.
     *
     * @param  string   $str
     * @param  string[] $substrings Substrings to look for
     * @param  bool     $caseSensitive Whether or not to enforce case-sensitivity
     * @return bool     Whether or not $str ends with $substring
     */
    final public static function endsWithAny(string $str, array $substrings, bool $caseSensitive = true): bool
    {
        if (empty($substrings)) { return false; }

        foreach ($substrings as $substring) {
            if (self::endsWith($str, $substring, $caseSensitive)) { return true; }
        }

        return false;
    }

    /**
     * Checks if the given string is a valid UUID v.4.
     * It doesn't matter whether the given UUID has dashes.
     *
     * @param  string $str
     * @return bool
     */
    final public static function isUUIDv4(string $str): bool
    {
        $l = '[a-f0-9]';
        $pattern = "/^{$l}{8}-?{$l}{4}-?4{$l}{3}-?[89ab]{$l}{3}-?{$l}{12}\Z/";

        return (bool) \preg_match($pattern, $str);
    }

    /**
     * Returns true if the string contains a lower case char, false
     * otherwise.
     *
     * @param  string $str
     * @return bool
     */
    final public static function hasLowerCase(string $str): bool
    {
        return self::matchesPattern($str, '.*[[:lower:]]');
    }

    /**
     * Returns true if the string contains an upper case char, false
     * otherwise.
     *
     * @param  string $str
     * @return bool
     */
    final public static function hasUpperCase(string $str): bool
    {
        return self::matchesPattern($str, '.*[[:upper:]]');
    }

    /**
     * Returns true if $str matches the supplied pattern, false otherwise.
     *
     * @param  string $str
     * @param  string $pattern Regex pattern to match against
     * @return bool   Whether or not $str matches the pattern
     */
    final public static function matchesPattern(string $str, string $pattern): bool
    {
        return \mb_ereg_match($pattern, $str);
    }

    /**
     * Returns true if the string contains only alphabetic chars, false
     * otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str contains only alphabetic chars
     */
    final public static function isAlpha(string $str): bool
    {
        return self::matchesPattern($str,'^[[:alpha:]]*$');
    }

    /**
     * Returns true if the string contains only alphabetic and numeric chars,
     * false otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str contains only alphanumeric chars
     */
    final public static function isAlphanumeric(string $str): bool
    {
        return self::matchesPattern($str,'^[[:alnum:]]*$');
    }

    /**
     * Returns true if the string is base64 encoded, false otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str is base64 encoded
     */
    final public static function isBase64(string $str): bool
    {
        return (base64_encode(base64_decode($str)) === $str);
    }

    /**
     * Returns true if the string contains only whitespace chars, false
     * otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str contains only whitespace characters
     */
    final public static function isBlank(string $str): bool
    {
        return self::matchesPattern($str,'^[[:space:]]*$');
    }

    /**
     * Returns true if the string contains only hexadecimal chars, false
     * otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str contains only hexadecimal chars
     */
    final public static function isHexadecimal(string $str): bool
    {
        return self::matchesPattern($str,'^[[:xdigit:]]*$');
    }

    /**
     * Returns true if the string is JSON, false otherwise. Unlike json_decode
     * in PHP 5.x, this method is consistent with PHP 7 and other JSON parsers,
     * in that an empty string is not considered valid JSON.
     *
     * @param  string $str
     * @return bool   Whether or not $str is JSON
     */
    final public static function isJson(string $str): bool
    {
        if ('' === $str) { return false; }

        json_decode($str);

        return (json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * Returns true if the string contains only lower case chars, false
     * otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str contains only lower case characters
     */
    final public static function isLowerCase(string $str): bool
    {
        return self::matchesPattern($str, '^[[:lower:]]*$');
    }

    /**
     * Returns true if the string is serialized, false otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str is serialized
     */
    final public static function isSerialized(string $str): bool
    {
        return $str === 'b:0;' || @unserialize($str, []) !== false;
    }

    /**
     * Returns true if the string contains only lower case chars, false
     * otherwise.
     *
     * @param  string $str
     * @return bool   Whether or not $str contains only lower case characters
     */
    final public static function isUpperCase(string $str): bool
    {
        return self::matchesPattern($str,'^[[:upper:]]*$');
    }

    /**
     * Returns a boolean representation of the given logical string value.
     * For example, 'true', '1', 'on' and 'yes' will return true. 'false', '0',
     * 'off', and 'no' will return false. In all instances, case is ignored.
     * For other numeric strings, their sign will determine the return value.
     * In addition, blank strings consisting of only whitespace will return
     * false. For all other strings, the return value is a result of a
     * boolean cast.
     *
     * @param  string $str
     * @return bool   A boolean value for the string
     */
    final public static function toBoolean(string $str): bool
    {
        $innerStr = $str;
        $key = $str;
        $key = StrModifiersMB::toLowerCase($key);

        $map = [
            'true'  => true,
            '1'     => true,
            'on'    => true,
            'yes'   => true,
            'false' => false,
            '0'     => false,
            'off'   => false,
            'no'    => false
        ];

        if (\array_key_exists($key, $map)) {
            return $map[$key];
        }
        /** @noinspection RedundantElseClauseInspection */
        elseif (\is_numeric($innerStr)) {
            return ((int)$innerStr > 0);
        }

        return (bool) StrModifiersMB::regexReplace($innerStr,'[[:space:]]', '');
    }
}
