<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

namespace Str;

class Str
{
    private $s;

    const CHARS_ARRAY = [
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
        'g'     => ['ĝ', 'ğ', 'ġ', 'ģ', 'г', 'ґ', 'γ', 'ဂ', 'გ', 'گ', 'ｇ'],
        'h'     => ['ĥ', 'ħ', 'η', 'ή', 'ح', 'ه', 'ဟ', 'ှ', 'ჰ', 'ｈ'],
        'i'     => ['í', 'ì', 'ỉ', 'ĩ', 'ị', 'î', 'ï', 'ī', 'ĭ', 'į',
                    'ı', 'ι', 'ί', 'ϊ', 'ΐ', 'ἰ', 'ἱ', 'ἲ', 'ἳ', 'ἴ',
                    'ἵ', 'ἶ', 'ἷ', 'ὶ', 'ί', 'ῐ', 'ῑ', 'ῒ', 'ΐ', 'ῖ',
                    'ῗ', 'і', 'ї', 'и', 'ဣ', 'ိ', 'ီ', 'ည်', 'ǐ', 'ი',
                    'इ', 'ی', 'ｉ'],
        'j'     => ['ĵ', 'ј', 'Ј', 'ჯ', 'ج', 'ｊ'],
        'k'     => ['ķ', 'ĸ', 'к', 'κ', 'Ķ', 'ق', 'ك', 'က', 'კ', 'ქ',
                    'ک', 'ｋ'],
        'l'     => ['ł', 'ľ', 'ĺ', 'ļ', 'ŀ', 'л', 'λ', 'ل', 'လ', 'ლ', 'ｌ'],
        'm'     => ['м', 'μ', 'م', 'မ', 'მ', 'ｍ'],
        'n'     => ['ñ', 'ń', 'ň', 'ņ', 'ŉ', 'ŋ', 'ν', 'н', 'ن', 'န', 'ნ', 'ｎ'],
        'o'     => ['ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ',
                    'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ø', 'ō', 'ő',
                    'ŏ', 'ο', 'ὀ', 'ὁ', 'ὂ', 'ὃ', 'ὄ', 'ὅ', 'ὸ', 'ό',
                    'о', 'و', 'θ', 'ို', 'ǒ', 'ǿ', 'º', 'ო', 'ओ', 'ｏ',
                    'ö'],
        'p'     => ['п', 'π', 'ပ', 'პ', 'پ', 'ｐ'],
        'q'     => ['ყ', 'ｑ'],
        'r'     => ['ŕ', 'ř', 'ŗ', 'р', 'ρ', 'ر', 'რ', 'ｒ'],
        's'     => ['ś', 'š', 'ş', 'с', 'σ', 'ș', 'ς', 'س', 'ص', 'စ', 'ſ', 'ს', 'ｓ'],
        't'     => ['ť', 'ţ', 'т', 'τ', 'ț', 'ت', 'ط', 'ဋ', 'တ', 'ŧ', 'თ', 'ტ', 'ｔ'],
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
        'D'     => ['Ď', 'Ð', 'Đ', 'Ɖ', 'Ɗ', 'Ƌ', 'ᴅ', 'ᴆ', 'Д', 'Δ', 'Ｄ'],
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

    /**
     * Make new instance of Str class
     * @param string $str
     *
     * @since 1.0.0
     */
    public function __construct(string $str)
    {
        $this->s = $str;
    }

    /**
     * Convert Str object ot base `string` type
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->s;
    }

    /**
     * Convert Str object ot base `string` type
     *
     * @return string
     */
    public function getString(): string
    {
        return $this->s;
    }

    /**
     * make
     *
     * Create a new Str object using static method for it.
     *
     * ```php
     * $str = Str::make('Acme');
     * echo (string)$str; // Acme
     * ```
     *
     * @param string $str
     * @return Str
     */
    public static function make(string $str): Str
    {
        return new self($str);
    }

    /**
     * substr
     *
     * Returns the substring beginning at $start with the specified $length.
     * It differs from the mb_substr() function in that providing a $length of 0 will
     * return the rest of the string, rather than an empty string.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->substr(1, 4);
     * // Acme
     * ```
     *
     * @since 1.0.0
     * @param int $start
     * @param int $length
     * @return Str
     */
    public function substr(int $start = 0, int $length = 0): Str
    {
        $this->s = \mb_substr($this->s, $start, $length !== 0 ? $length : \mb_strlen($this->s));
        return $this;
    }

    /**
     * hasPrefix
     *
     * Check if the string has $prefix at the start.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo $str->hasPrefix('/');
     * // true
     * ```
     *
     * @since 1.0.0
     * @param string $prefix
     * @deprecated use startsWith instead
     * @return bool
     */
    public function hasPrefix(string $prefix): bool
    {
        return $this->startsWith($prefix);
    }

    /**
     * hasSuffix
     *
     * Check if the string has $suffix at the end.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo $str->hasSuffix('/');
     * // true
     * ```
     *
     * @since 1.0.0
     * @param string $suffix
     * @deprecated use endsWith instead
     * @return bool
     */
    public function hasSuffix(string $suffix): bool
    {
        return $this->endsWith($suffix);
    }

    /**
     * ensureLeft
     *
     * Check whether $prefix exists in the string, and prepend $prefix to the string if it doesn't.
     *
     * ```php
     * $str = new Str('Acme/');
     * echo (string)$str->ensureLeft('/');
     * // /Acme/
     * $str = new Str('/Acme/');
     * echo (string)$str->ensureLeft('/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $check
     * @return Str
     */
    public function ensureLeft(string $check): Str
    {
        if ('' !== $check && 0 === \mb_strpos($this->s, $check)) {
            return $this;
        }
        $this->s = $check . $this->s;
        return $this;
    }

    /**
     * ensureRight
     *
     * Check whether $suffix exists in the string, and append $suffix to the string if it doesn't.
     *
     * ```php
     * $str = new Str('/Acme');
     * echo (string)$str->ensureRight('/'); // /Acme/
     * $str = new Str('/Acme/');
     * echo (string)$str->ensureRight('/'); // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $check
     * @return Str
     */
    public function ensureRight(string $check): Str
    {
        if ('' !== $check && \mb_substr($this->s, -\mb_strlen($check)) === $check) {
            return $this;
        }
        $this->s .= $check;
        return $this;
    }

    /**
     * contains
     *
     * Check if the string contains $needle substring.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo $str->contains('/');
     * // true
     * $str = new Str('/Acme/');
     * echo $str->contains('a', false);
     * // true
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param bool $caseSensitive
     * @return bool
     */
    public function contains(string $needle, bool $caseSensitive = true): bool
    {
        if ($this->s === '' || $needle === '') {
            return false;
        }
        return $caseSensitive ? (false !== \mb_strpos($this->s, $needle)) : (false !== \mb_stripos($this->s, $needle));
    }

    /**
     * replace
     *
     * Replaces all occurrences of $old in the string by $new.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->replace('/', '#');
     * // #Acme#
     * ```
     *
     * @since 1.0.0
     * @param string $old
     * @param string $new
     * @return Str
     */
    public function replace(string $old, string $new): Str
    {
        $this->s = (string) \mb_ereg_replace(\preg_quote($old, '/'), $new, $this->s);
        return $this;
    }

    /**
     * replaceWithLimit
     *
     * Replace returns a copy of the string s with the first n non-overlapping instances of
     * old replaced by new. If old is empty, it matches at the beginning of the string and
     * after each UTF-8 sequence, yielding up to k+1 replacements for a k-rune string.
     * If n < 0, there is no limit on the number of replacements.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->replaceWithLimit('/', '#', 1);
     * // #Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $old
     * @param string $new
     * @param int $limit
     * @return Str
     */
    public function replaceWithLimit(string $old, string $new, int $limit = -1): Str
    {
        if ($old === $new || $limit === 0) {
            return $this;
        }
        $strLower = \mb_strtolower($this->s);
        $oldLower = \mb_strtolower($old);
        $oldCount = \mb_substr_count($strLower, $oldLower);
        if ($oldCount === 0) {
            return $this;
        }
        if ($limit < 0 || $oldCount < $limit) {
            $limit = $oldCount;
        }
        $offset = 0;
        while ($limit--) {
            $pos = \mb_strpos($this->s, $old, $offset);
            $offset = $pos + \mb_strlen($old);
            $this->s = \mb_substr($this->s, 0, $pos) . $new . \mb_substr($this->s, $offset);
        }
        return $this;
    }

    /**
     * toLowerCase
     *
     * Make the string lowercase.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->toLowerCase();
     * // /acme/
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function toLowerCase(): Str
    {
        $this->s = \mb_strtolower($this->s);
        return $this;
    }

    /**
     * toUpperCase
     *
     * Make the string uppercase.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->toUpperCase();
     * // /ACME/
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function toUpperCase(): Str
    {
        $this->s = \mb_strtoupper($this->s);
        return $this;
    }

    /**
     * trim
     *
     * Returns a string with whitespace removed from the start and end of the string.
     * Supports the removal of unicode whitespace. Accepts an optional string of characters
     * to strip instead of the defaults.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->trim('/');
     * // Acme
     * ```
     *
     * @since 1.0.0
     * @param string $chars
     * @return Str
     */
    public function trim(string $chars = ''): Str
    {
        $chars = '' === $chars ? '\s' : \preg_quote($chars, '/');
        $this->s = (string) \mb_ereg_replace("^[$chars]+|[$chars]+\$", '', $this->s);
        return $this;
    }

    /**
     * trimLeft
     *
     * Returns a string with whitespace removed from the start of the string.
     * Supports the removal of unicode whitespace. Accepts an optional string of characters
     * to strip instead of the defaults.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->trimLeft('/');
     * // Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $chars
     * @return Str
     */
    public function trimLeft(string $chars = ''): Str
    {
        $chars = '' === $chars ? '\s' : \preg_quote($chars, '/');
        $this->s = (string) \mb_ereg_replace("^[$chars]+", '', $this->s);
        return $this;
    }


    /**
     * trimRight
     *
     * Returns a string with whitespace removed from the end of the string.
     * Supports the removal of unicode whitespace. Accepts an optional string of characters
     * to strip instead of the defaults.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->trimRight('/');
     * // /Acme
     * ```
     *
     * @since 1.0.0
     * @param string $chars
     * @return Str
     */
    public function trimRight(string $chars = ''): Str
    {
        $chars = '' === $chars ? '\s' : \preg_quote($chars, '/');
        $this->s = (string) \mb_ereg_replace("[$chars]+\$", '', $this->s);
        return $this;
    }

    /**
     * append
     *
     * Append $sub to the string.
     *
     * ```php
     * $str = new Str('/Acme');
     * echo (string)$str->append('/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $sub
     * @return Str
     */
    public function append(string $sub): Str
    {
        $this->s .= $sub;
        return $this;
    }

    /**
     * prepend
     *
     * Prepend $sub to the string.
     *
     * ```php
     * $str = new Str('Acme/');
     * echo (string)$str->prepend('/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $sub
     * @return Str
     */
    public function prepend(string $sub): Str
    {
        $this->s = $sub . $this->s;
        return $this;
    }

    /**
     * at
     *
     * Returns the character at $pos, with indexes starting at 0.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->at(2);
     * // c
     * ```
     *
     * @since 1.0.0
     * @param int $pos
     * @return Str
     */
    public function at(int $pos): Str
    {
        $this->s = \mb_substr($this->s, $pos, 1);
        return $this;
    }

    /**
     * chars
     *
     * Returns an array consisting of the characters in the string.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->chars();
     * // ['/', 'A', 'c', 'm', 'e', '/']
     * ```
     *
     * @since 1.0.0
     * @return array
     */
    public function chars(): array
    {
        if ($this->s === '') {
            return [];
        }
        $chars = [];
        for ($i = 0, $iMax = \mb_strlen($this->s); $i < $iMax; $i++) {
            $chars[] = \mb_substr($this->s, $i, 1);
        }
        return $chars;
    }

    /**
     * length
     *
     * Returns the length of the string.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo $str->length();
     * // 6
     * ```
     *
     * @since 1.0.0
     * @return int
     */
    public function length(): int
    {
        return \mb_strlen($this->s);
    }

    /**
     * first
     *
     * Returns the first $length characters of the string.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->first(2);
     * // /A
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @return Str
     */
    public function first(int $length = 1): Str
    {
        if ($length <= 0) {
            $this->s = '';
            return $this;
        }
        $this->s = \mb_substr($this->s, 0, $length);
        return $this;
    }

    /**
     * last
     *
     * Returns the first $length characters of the string.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->last(2);
     * // e/
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @return Str
     */
    public function last(int $length = 1): Str
    {
        if ($length <= 0) {
            $this->s = '';
            return $this;
        }
        $this->s = \mb_substr($this->s, -$length);
        return $this;
    }

    /**
     * indexOf
     *
     * Returns the index of the first occurrence of $needle in the string, and -1 if not found.
     * Accepts an optional $offset from which to begin the search.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->indexOf('m');
     * // 4
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param int $offset
     * @return int
     */
    public function indexOf(string $needle, int $offset = 0): int
    {
        if ($needle === '' || $this->s === '') {
            return -1;
        }
        $pos = \mb_strpos($this->s, $needle, $offset);
        return false === $pos ? -1 : $pos;
    }

    /**
     * indexOfLast
     *
     * Returns the index of the last occurrence of $needle in the string, and false if not found.
     * Accepts an optional $offset from which to begin the search. Offsets may be negative to
     * count from the last character in the string.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->indexOfLast('m');
     * // 5
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param int $offset
     * @return int
     */
    public function indexOfLast(string $needle, int $offset = 0): int
    {
        if ($needle === '' || $this->s === '') {
            return -1;
        }
        $maxLen = \mb_strlen($this->s);
        if ($offset < 0) {
            $offset = $maxLen - (int)abs($offset);
        }
        if ($offset > $maxLen || $offset < 0) {
            return -1;
        }
        $pos = \mb_strrpos($this->s, $needle, $offset);
        return false === $pos ? -1 : $pos;
    }

    /**
     * countSubstr
     *
     * Returns the number of occurrences of $needle in the given string. By default
     * the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->countSubstr('m');
     * // 2
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param bool $caseSensitive
     * @return int
     */
    public function countSubstr(string $needle, bool $caseSensitive = true): int
    {
        if ($caseSensitive) {
            return \mb_substr_count($this->s, $needle);
        }
        return \mb_substr_count(\mb_strtolower($this->s), \mb_strtolower($needle));
    }

    /**
     * containsAll
     *
     * Returns true if the string contains all $needles, false otherwise. By default
     * the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->containsAll(['m', 'c', '/']);
     * // true
     * ```
     *
     * @since 1.0.0
     * @param array $needles
     * @param bool $caseSensitive
     * @return bool
     */
    public function containsAll(array $needles, bool $caseSensitive = true): bool
    {
        if ([] === $needles) {
            return false;
        }
        foreach ($needles as $needle) {
            if (!$this->contains($needle, $caseSensitive)) {
                return false;
            }
        }
        return true;
    }

    /**
     * containsAny
     *
     * Returns true if the string contains any $needles, false otherwise. By default
     * the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->containsAny(['foo', 'c', 'bar']);
     * // true
     * ```
     *
     * @since 1.0.0
     * @param array $needles
     * @param bool $caseSensitive
     * @return bool
     */
    public function containsAny(array $needles, bool $caseSensitive = true): bool
    {
        foreach ($needles as $needle) {
            if ($this->contains($needle, $caseSensitive)) {
                return true;
            }
        }
        return false;
    }

    /**
     * startsWith
     *
     * Returns true if the string begins with $substring, false otherwise. By default
     * the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->startsWith('/A');
     * // true
     * ```
     *
     * @since 1.0.0
     * @param string $substring
     * @param bool $caseSensitive
     * @return bool
     */
    public function startsWith(string $substring, bool $caseSensitive = true): bool
    {
        if ('' === $this->s || '' === $substring) {
            return false;
        }

        if ($caseSensitive) {
            return 0 === \mb_strpos($this->s, $substring);
        }

        return 0 === \mb_stripos($this->s, $substring);
    }

    /**
     * startsWithAny
     *
     * Returns true if the string begins with any of $substrings, false otherwise. By default
     * the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->startsWithAny(['foo', '/A', 'bar']);
     * // true
     * ```
     *
     * @since 1.0.0
     * @param array $substrings
     * @param bool $caseSensitive
     * @return bool
     */
    public function startsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        foreach ($substrings as $substring) {
            if ($this->startsWith($substring, $caseSensitive)) {
                return true;
            }
        }
        return false;
    }

    /**
     * endsWith
     *
     * Returns true if the string ends with $substring, false otherwise. By default the comparison
     * is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->endsWith('e/');
     * // true
     * ```
     *
     * @since 1.0.0
     * @param string $substring
     * @param bool $caseSensitive
     * @return bool
     */
    public function endsWith(string $substring, bool $caseSensitive = true): bool
    {
        if ('' === $this->s || '' === $substring) {
            return false;
        }

        if ($caseSensitive) {
            return \mb_substr($this->s, -\mb_strlen($substring)) === $substring;
        }

        return (($r = \mb_strripos($this->s, $substring)) !== -1) && $r !== false;
    }

    /**
     * endsWithAny
     *
     * Returns true if the string ends with any of $substrings, false otherwise. By default
     * the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
     *
     * ```php
     * $str = new Str('/Accmme/');
     * echo $str->endsWithAny(['foo', 'e/', 'bar']);
     * // true
     * ```
     *
     * @since 1.0.0
     * @param array $substrings
     * @param bool $caseSensitive
     * @return bool
     */
    public function endsWithAny(array $substrings, bool $caseSensitive = true): bool
    {
        foreach ($substrings as $substring) {
            if ($this->endsWith($substring, $caseSensitive)) {
                return true;
            }
        }
        return false;
    }

    /**
     * padBoth
     *
     * Returns a new string of a given length such that both sides of the string are padded.
     *
     * ```php
     * $str = new Str('Acme');
     * echo (string)$str->padBoth(6, '/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @param string $padStr
     * @return Str
     */
    public function padBoth(int $length, string $padStr = ' '): Str
    {
        $padding = $length - \mb_strlen($this->s);
        $this->applyPadding((int)floor($padding / 2), (int)ceil($padding / 2), $padStr);
        return $this;
    }

    /**
     * applyPadding
     *
     * @since 1.0.0
     * @param int $left
     * @param int $right
     * @param string $padStr
     * @return Str
     */
    private function applyPadding(int $left = 0, int $right = 0, string $padStr = ' '): Str
    {
        if ('' === $padStr || $right + $left <= 0) {
            return $this;
        }
        $leftPadding = \mb_substr(str_repeat($padStr, $left), 0, $left);
        $rightPadding = \mb_substr(str_repeat($padStr, $right), 0, $right);
        $this->s = $leftPadding . $this->s . $rightPadding;
        return $this;
    }

    /**
     * padLeft
     *
     * Returns a new string of a given length such that the beginning of the string is padded.
     *
     * ```php
     * $str = new Str('Acme/');
     * echo (string)$str->padLeft(6, '/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @param string $padStr
     * @return Str
     */
    public function padLeft(int $length, string $padStr = ' '): Str
    {
        $this->applyPadding($length - \mb_strlen($this->s), 0, $padStr);
        return $this;
    }

    /**
     * padRight
     *
     * Returns a new string of a given length such that the end of the string is padded.
     *
     * ```php
     * $str = new Str('/Acme');
     * echo (string)$str->padRight(6, '/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @param string $padStr
     * @return Str
     */
    public function padRight(int $length, string $padStr = ' '): Str
    {
        $this->applyPadding(0, $length - \mb_strlen($this->s), $padStr);
        return $this;
    }

    /**
     * insert
     *
     * Inserts $substring into the string at the $index provided.
     *
     * ```php
     * $str = new Str('/Ace/');
     * echo (string)$str->insert('m', 3);
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $substring
     * @param int $index
     * @return Str
     */
    public function insert(string $substring, int $index): Str
    {
        $this->s = \mb_substr($this->s, 0, $index) . $substring . \mb_substr($this->s, $index);
        return $this;
    }

    /**
     * removeLeft
     *
     * Returns the string with the prefix $substring removed, if present.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->removeLeft('/');
     * // Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $substring
     * @return Str
     */
    public function removeLeft(string $substring): Str
    {
        if ('' !== $substring && 0 === \mb_strpos($this->s, $substring)) {
            $this->s = \mb_substr($this->s, \mb_strlen($substring));
        }
        return $this;
    }

    /**
     * removeRight
     *
     * Returns the string with the suffix $substring removed, if present.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->removeRight('/');
     * // /Acme
     * ```
     *
     * @since 1.0.0
     * @param string $substring
     * @return Str
     */
    public function removeRight(string $substring): Str
    {
        if ('' !== $substring && \mb_substr($this->s, -\mb_strlen($substring)) === $substring) {
            $this->s = \mb_substr($this->s, 0, \mb_strlen($this->s) - \mb_strlen($substring));
        }
        return $this;
    }

    /**
     * repeat
     *
     * Returns a repeated string given a $multiplier. An alias for str_repeat.
     *
     * ```php
     * $str = new Str('Acme/');
     * echo (string)$str->repeat(2);
     * // Acme/Acme/
     * ```
     *
     * @since 1.0.0
     * @param int $multiplier
     * @return Str
     */
    public function repeat(int $multiplier): Str
    {
        $this->s = \str_repeat($this->s, $multiplier);
        return $this;
    }

    /**
     * reverse
     *
     * Returns a reversed string. A multi-byte version of strrev().
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->reverse();
     * // /emcA/
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function reverse(): Str
    {
        $reversed = '';
        $i = \mb_strlen($this->s);
        while ($i--) {
            $reversed .= \mb_substr($this->s, $i, 1);
        }
        $this->s = $reversed;
        return $this;
    }

    /**
     * shuffle
     *
     * A multi-byte str_shuffle() function. It returns a string with its characters in random order.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->shuffle();
     * // mAe//c
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function shuffle(): Str
    {
        $indexes = \range(0, \mb_strlen($this->s) - 1);
        \shuffle($indexes);
        $shuffledStr = '';
        foreach ($indexes as $i) {
            $shuffledStr .= \mb_substr($this->s, $i, 1);
        }
        $this->s = $shuffledStr;
        return $this;
    }

    /**
     * between
     *
     * Returns the substring between $start and $end, if found, or an empty string.
     * An optional $offset may be supplied from which to begin the search for the start string.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->between('/', '/');
     * // Acme
     * ```
     *
     * @since 1.0.0
     * @param string $start
     * @param string $end
     * @param int $offset
     * @return Str
     */
    public function between(string $start, string $end, int $offset = 0): Str
    {
        $posStart = \mb_strpos($this->s, $start, $offset);
        if ($posStart === false) {
            $this->s = '';
            return $this;
        }
        $substrIndex = $posStart + \mb_strlen($start);
        $posEnd = \mb_strpos($this->s, $end, $substrIndex);
        if ($posEnd === false || $posEnd === $substrIndex) {
            $this->s = '';
            return $this;
        }
        $this->s = \mb_substr($this->s, $substrIndex, $posEnd - $substrIndex);
        return $this;
    }

    /**
     * camelize
     *
     * Returns a camelCase version of the string. Trims surrounding spaces, capitalizes
     * letters following digits, spaces, dashes and underscores, and removes spaces, dashes,
     * as well as underscores.
     *
     * ```php
     * $str = new Str('ac me');
     * echo (string)$str->camelize();
     * // acMe
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function camelize(): Str
    {
        $this->s = (string) \mb_ereg_replace("^['\s']+|['\s']+\$", '', $this->s);
        $this->s = \mb_strtolower(\mb_substr($this->s, 0, 1)) . \mb_substr($this->s, 1);
        $this->s = (string) \preg_replace('/^[-_]+/', '', $this->s);
        $this->s = (string) \preg_replace_callback('/[-_\s]+(.)?/u', function ($match) {
            if (isset($match[1])) {
                return \mb_strtoupper($match[1]);
            }
            return '';
        }, $this->s);
        $this->s = (string) \preg_replace_callback('/[\d]+(.)?/u', function ($match) {
            return \mb_strtoupper($match[0]);
        }, $this->s);
        return $this;
    }

    /**
     * lowerCaseFirst
     *
     * Converts the first character of the string to lower case.
     *
     * ```php
     * $str = new Str('Acme Foo');
     * echo (string)$str->lowerCaseFirst();
     * // acme Foo
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function lowerCaseFirst(): Str
    {
        $this->s = \mb_strtolower(\mb_substr($this->s, 0, 1)) . \mb_substr($this->s, 1);
        return $this;
    }

    /**
     * upperCaseFirst
     *
     * Converts the first character of the string to upper case.
     *
     * ```php
     * $str = new Str('acme foo');
     * echo (string)$str->upperCaseFirst();
     * // Acme foo
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function upperCaseFirst(): Str
    {
        $this->s = \mb_strtoupper(\mb_substr($this->s, 0, 1)) . \mb_substr($this->s, 1);
        return $this;
    }

    /**
     * collapseWhitespace
     *
     * Trims the string and replaces consecutive whitespace characters with a single space.
     * This includes tabs and newline characters, as well as multi-byte whitespace such as the
     * thin space and ideographic space.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->collapseWhitespace();
     * // foo bar baz
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function collapseWhitespace(): Str
    {
        $this->s = (string) \mb_ereg_replace('[[:space:]]+', ' ', $this->s);
        $this->s = (string) \mb_ereg_replace("^['\s']+|['\s']+\$", '', $this->s);
        return $this;
    }

    /**
     * regexReplace
     *
     * Replaces all occurrences of $pattern in the string by $replacement.
     * An alias for mb_ereg_replace(). Note that the 'i' option with multi-byte patterns in
     * mb_ereg_replace() requires PHP 5.6+ for correct results. This is due to a lack of support in
     * the bundled version of Oniguruma in PHP < 5.6, and current versions of HHVM (3.8 and below).
     *
     * ```php
     * $str = new Str('Acme Foo');
     * echo (string)$str->regexReplace('A', 'a');
     * // acme Foo
     * ```
     *
     * @since 1.0.0
     * @param string $pattern
     * @param string $replacement
     * @param string $options
     * @return Str
     */
    public function regexReplace(string $pattern, string $replacement, string $options = 'msr'): Str
    {
        $this->s = (string) \mb_ereg_replace($pattern, $replacement, $this->s, $options);
        return $this;
    }

    /**
     * dasherize
     *
     * Returns a lowercase and trimmed string separated by dashes. Dashes are inserted before
     * uppercase characters (with the exception of the first character of the string),
     * and in place of spaces as well as underscores.
     *
     * ```php
     * $str = new Str('Ac me');
     * echo (string)$str->dasherize();
     * // ac-me
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function dasherize(): Str
    {
        $this->s = (string) \mb_ereg_replace("^['\s']+|['\s']+\$", '', $this->s);
        $this->s = \mb_strtolower((string) \mb_ereg_replace('\B([A-Z])', '-\1', $this->s));
        $this->s = (string) \mb_ereg_replace('[-_\s]+', '-', $this->s);
        return $this;
    }

    /**
     * delimit
     *
     * Returns a lowercase and trimmed string separated by the given $delimiter. Delimiters
     * are inserted before uppercase characters (with the exception of the first character of the
     * string), and in place of spaces, dashes, and underscores. Alpha delimiters are not converted
     * to lowercase.
     *
     * ```php
     * $str = new Str('Ac me');
     * echo (string)$str->delimit('#');
     * // ac#me
     * ```
     *
     * @since 1.0.0
     * @param $delimiter
     * @return Str
     */
    public function delimit($delimiter): Str
    {
        $this->s = (string) \mb_ereg_replace("^['\s']+|['\s']+\$", '', $this->s);
        $this->s = \mb_strtolower((string) \mb_ereg_replace('\B([A-Z])', '-\1', $this->s));
        $this->s = (string) \mb_ereg_replace('[-_\s]+', $delimiter, $this->s);
        return $this;
    }

    /**
     *
     * ### isUUIDv4
     * Checks if the given string is a valid UUID v.4.
     * It doesn't matter whether the given UUID has dashes.
     *
     * ```php
     * $str = new Str('76d7cac8-1bd7-11e8-accf-0ed5f89f718b');
     * echo $str->isUUIDv4();
     * // false
     * $str = new Str('ae815123-537f-4eb3-a9b8-35881c29e1ac');
     * echo $str->isUUIDv4();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isUUIDv4(): bool
    {
        return (bool)\preg_match("/^[a-f0-9]{8}-?[a-f0-9]{4}-?4[a-f0-9]{3}-?[89ab][a-f0-9]{3}-?[a-f0-9]{12}\Z/", $this->s);
    }

    /**
     * hasLowerCase
     *
     * Returns true if the string contains a lower case char, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->hasLowerCase();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function hasLowerCase(): bool
    {
        return \mb_ereg_match('.*[[:lower:]]', $this->s);
    }

    /**
     * hasUpperCase
     *
     * Returns true if the string contains an upper case char, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->hasUpperCase();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function hasUpperCase(): bool
    {
        return \mb_ereg_match('.*[[:upper:]]', $this->s);
    }

    /**
     * matchesPattern
     *
     * Returns true if the string match regexp pattern
     *
     * ```php
     * $s = new Str('foo baR');
     * echo $str->matchesPattern('.*aR');
     * // true
     * ```
     *
     * @since 1.0.0
     * @param string $pattern
     * @return bool
     */
    public function matchesPattern(string $pattern): bool
    {
        return \mb_ereg_match($pattern, $this->s);
    }

    /**
     * htmlDecode
     *
     * Convert all HTML entities to their applicable characters. An alias of html_entity_decode.
     * For a list of flags, refer
     * to [PHP documentation](http://php.net/manual/en/function.html-entity-decode.php).
     *
     * ```php
     * $str = new Str('&lt;Acme&gt;');
     * echo (string)$str->htmlDecode();
     * // <Acme>
     * ```
     *
     * @since 1.0.0
     * @param int $flags
     * @return Str
     */
    public function htmlDecode(int $flags = ENT_COMPAT): Str
    {
        $this->s = \html_entity_decode($this->s, $flags);
        return $this;
    }

    /**
     * htmlEncode
     *
     * Convert all applicable characters to HTML entities. An alias of htmlentities.
     * Refer to [PHP documentation](http://php.net/manual/en/function.htmlentities.php)
     * for a list of flags.
     *
     * ```php
     * $str = new Str('<Acme>');
     * echo (string)$str->htmlEncode();
     * // &lt;Acme&gt;
     * ```
     *
     * @since 1.0.0
     * @param int $flags
     * @return Str
     */
    public function htmlEncode(int $flags = ENT_COMPAT): Str
    {
        $this->s = \htmlentities($this->s, $flags);
        return $this;
    }

    /**
     * humanize
     *
     * Capitalizes the first word of the string, replaces underscores with spaces.
     *
     * ```php
     * $str = new Str('foo_id');
     * echo (string)$str->humanize();
     * // Foo
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function humanize(): Str
    {
        $this->s = \str_replace('_', ' ', $this->s);
        $this->s = (string) \mb_ereg_replace("^['\s']+|['\s']+\$", '', $this->s);
        $this->s = \mb_strtoupper(\mb_substr($this->s, 0, 1)) . \mb_substr($this->s, 1);
        return $this;
    }

    /**
     * isAlpha
     *
     * Returns true if the string contains only alphabetic chars, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isAlpha();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isAlpha(): bool
    {
        return \mb_ereg_match('^[[:alpha:]]*$', $this->s);
    }

    /**
     * isAlphanumeric
     *
     * Returns true if the string contains only alphabetic and numeric chars, false otherwise.
     *
     * ```php
     * $str = new Str('Acme1');
     * echo $str->isAlphanumeric();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isAlphanumeric(): bool
    {
        return \mb_ereg_match('^[[:alnum:]]*$', $this->s);
    }

    /**
     * isBase64
     *
     * Check if this string is valid base64 encoded
     * data. Function do encode(decode(s)) === s,
     * so this is not so fast.
     *
     * @since 1.0.0
     * @return bool
     */
    public function isBase64(): bool
    {
        return (base64_encode(base64_decode($this->s)) === $this->s);
    }

    /**
     * isBlank
     *
     * Returns true if the string contains only whitespace chars, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isBlank();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isBlank(): bool
    {
        return \mb_ereg_match('^[[:space:]]*$', $this->s);
    }

    /**
     * isHexadecimal
     *
     * Returns true if the string contains only hexadecimal chars, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isHexadecimal();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isHexadecimal(): bool
    {
        return \mb_ereg_match('^[[:xdigit:]]*$', $this->s);
    }

    /**
     * isJson
     *
     * Returns true if the string is JSON, false otherwise. Unlike json_decode in PHP 5.x,
     * this method is consistent with PHP 7 and other JSON parsers, in that an empty string
     * is not considered valid JSON.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isJson();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isJson(): bool
    {
        json_decode($this->s);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * isLowerCase
     *
     * Returns true if the string contains only lower case chars, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isLowerCase();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isLowerCase(): bool
    {
        return \mb_ereg_match('^[[:lower:]]*$', $this->s);
    }

    /**
     * isSerialized
     *
     * Returns true if the string is serialized, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isSerialized();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isSerialized(): bool
    {
        return ($this->s === 'b:0;') || (@unserialize($this->s, ['allowed_classes' => false]) !== false);
    }

    /**
     * isUpperCase
     *
     * Returns true if the string contains only upper case chars, false otherwise.
     *
     * ```php
     * $str = new Str('Acme');
     * echo $str->isUpperCase();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isUpperCase(): bool
    {
        return \mb_ereg_match('^[[:upper:]]*$', $this->s);
    }

    /**
     * lines
     *
     * Splits on newlines and carriage returns, returning an array of strings
     * corresponding to the lines in the string.
     *
     * ```php
     * $str = new Str("Acme\r\nAcme");
     * echo $str->lines();
     * // ['Acme', 'Acme']
     * ```
     *
     * @since 1.0.0
     * @return array
     */
    public function lines(): array
    {
        if ('' === $this->s) {
            return [];
        }
        return \mb_split('[\r\n]{1,2}', $this->s);
    }

    /**
     * split
     *
     * Splits the string with the provided $pattern, returning an array of strings.
     * An optional integer $limit will truncate the results.
     *
     * ```php
     * $str = new Str('Acme#Acme');
     * echo $str->split('#', 1);
     * // ['Acme']
     * ```
     *
     * @since 1.0.0
     * @param string $pattern
     * @param int $limit
     * @return array
     */
    public function split(string $pattern, int $limit = -1): array
    {
        if ($limit === 0) {
            return [];
        }
        if ($pattern === '') {
            return [$this->s];
        }
        if ($limit >= 0) {
            return array_filter(\mb_split($pattern, $this->s), function () use (&$limit) {
                return --$limit >= 0;
            });
        }
        return \mb_split($pattern, $this->s);
    }

    /**
     * longestCommonPrefix
     *
     * Returns the longest common prefix between the string and $otherStr.
     *
     * ```php
     * $str = new Str('Acme');
     * echo (string)$str->longestCommonPrefix('Accurate');
     * // Ac
     * ```
     *
     * @since 1.0.0
     * @param string $otherStr
     * @return Str
     */
    public function longestCommonPrefix(string $otherStr): Str
    {
        $maxLength = min(\mb_strlen($this->s), \mb_strlen($otherStr));
        $longestCommonPrefix = '';
        for ($i = 0; $i < $maxLength; $i++) {
            $char = \mb_substr($this->s, $i, 1);
            if ($char === \mb_substr($otherStr, $i, 1)) {
                $longestCommonPrefix .= $char;
            } else {
                break;
            }
        }
        $this->s = $longestCommonPrefix;
        return $this;
    }

    /**
     * longestCommonSuffix
     *
     * Returns the longest common suffix between the string and $otherStr.
     *
     * ```php
     * $str = new Str('Acme');
     * echo (string)$str->longestCommonSuffix('Do believe me');
     * // me
     * ```
     *
     * @since 1.0.0
     * @param string $otherStr
     * @return Str
     */
    public function longestCommonSuffix(string $otherStr): Str
    {
        $maxLength = min(\mb_strlen($this->s), \mb_strlen($otherStr));
        $longestCommonSuffix = '';
        for ($i = 1; $i <= $maxLength; $i++) {
            $char = \mb_substr($this->s, -$i, 1);
            if ($char === \mb_substr($otherStr, -$i, 1)) {
                $longestCommonSuffix = $char . $longestCommonSuffix;
            } else {
                break;
            }
        }
        $this->s = $longestCommonSuffix;
        return $this;
    }

    /**
     * longestCommonSubstring
     *
     * Returns the longest common substring between the string and $otherStr.
     * In the case of ties, it returns that which occurs first.
     *
     * ```php
     * $str = new Str('Acme');
     * echo (string)$str->longestCommonSubstring('meh');
     * // me
     * ```
     *
     * @since 1.0.0
     * @param string $otherStr
     * @return Str
     */
    public function longestCommonSubstring(string $otherStr): Str
    {
        $strLength = \mb_strlen($this->s);
        $otherLength = \mb_strlen($otherStr);
        $len = 0;
        $end = 0;
        $table = \array_fill(0, $strLength, \array_fill(0, $otherLength, 0));
        for ($i = 1; $i <= $strLength; $i++) {
            for ($j = 1; $j <= $otherLength; $j++) {
                $strChar = \mb_substr($this->s, $i - 1, 1);
                $otherChar = \mb_substr($otherStr, $j - 1, 1);
                if ($strChar === $otherChar) {
                    $table[$i][$j] = $table[$i - 1][$j - 1] + 1;
                    if ($table[$i][$j] > $len) {
                        $len = $table[$i][$j];
                        $end = $i;
                    }
                } else {
                    $table[$i][$j] = 0;
                }
            }
        }
        $this->s = \mb_substr($this->s, $end - $len, $len);
        return $this;
    }

    /**
     * safeTruncate
     *
     * Truncates the string to a given $length, while ensuring that it does not split words.
     * If $substring is provided, and truncating occurs, the string is further truncated
     * so that the $substring may be appended without exceeding the desired length.
     *
     * ```php
     * $str = new Str('What are your plans today?');
     * echo (string)$str->safeTruncate(22, '...');
     * // What are your plans...
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @param string $substring
     * @return Str
     */
    public function safeTruncate(int $length, string $substring = ''): Str
    {
        if ($length >= \mb_strlen($this->s)) {
            return $this;
        }
        $length -= \mb_strlen($substring);
        $truncated = \mb_substr($this->s, 0, $length);
        if (\mb_strpos($this->s, ' ', $length - 1) !== $length) {
            $lastPos = \mb_strrpos($truncated, ' ', 0);
            if ($lastPos !== false) {
                $truncated = \mb_substr($truncated, 0, $lastPos);
            }
        }
        $this->s = $truncated . $substring;
        return $this;
    }

    /**
     * slugify
     *
     * Converts the string into an URL slug. This includes replacing non-ASCII characters with
     * their closest ASCII equivalents, removing remaining non-ASCII and non-alphanumeric characters,
     * and replacing whitespace with $replacement. The $replacement defaults to a single dash, and
     * the string is also converted to lowercase. The $language of the source string can also be
     * supplied for language-specific transliteration.
     *
     * ```php
     * $str = new Str('Acme foo bar!');
     * echo (string)$str->slugify();
     * // acme-foo-bar
     * ```
     *
     * @since 1.0.0
     * @param string $replacement
     * @param string $language
     * @return Str
     */
    public function slugify(string $replacement = '-', string $language = 'en'): Str
    {
        $split = \preg_split('/[-_]/', $language);
        $language = \strtolower($split[0]);
        $languageSpecific = ['de' => [['ä',  'ö',  'ü',  'Ä',  'Ö',  'Ü' ], ['ae', 'oe', 'ue', 'AE', 'OE', 'UE']], 'bg' => [['х', 'Х', 'щ', 'Щ', 'ъ', 'Ъ', 'ь', 'Ь'], ['h', 'H', 'sht', 'SHT', 'a', 'А', 'y', 'Y']]];
        if (!empty($languageSpecific[$language])) {
            $this->s = \str_replace($languageSpecific[$language][0], $languageSpecific[$language][1], $this->s);
        }
        foreach (self::CHARS_ARRAY as $key => $value) {
            $this->s = \str_replace($value, (string)$key, $this->s);
        }
        $this->s = \str_replace('@', $replacement, $this->s);
        $quotedReplacement = \preg_quote($replacement, '/');
        $pattern = "/[^-_a-zA-Z\d\s$quotedReplacement]/u";
        $this->s = (string) \preg_replace($pattern, '', $this->s);
        $this->s = \strtolower($this->s);
        $this->s = (string) \preg_replace("/^['\s']+|['\s']+\$/", '', $this->s);
        $this->s = (string) \preg_replace('/\B([A-Z])/', '/-\1/', $this->s);
        $this->s = (string) \preg_replace('/[-_\s]+/', $replacement, $this->s);
        $l = \strlen($replacement);
        if (0 === \strpos($this->s, $replacement)) {
            $this->s = \substr($this->s, $l);
        }
        if (\substr($this->s, -$l) === $replacement) {
            $this->s = \substr($this->s, 0, \strlen($this->s) - $l);
        }
        return $this;
    }

    /**
     * toAscii
     *
     * Returns an ASCII version of the string. A set of non-ASCII characters are replaced with
     * their closest ASCII counterparts, and the rest are removed by default. The $language or
     * locale of the source string can be supplied for language-specific transliteration in
     * any of the following formats: en, en_GB, or en-GB. For example, passing "de" results
     * in "äöü" mapping to "aeoeue" rather than "aou" as in other languages.
     *
     * ```php
     * $str = new Str('Äcmế');
     * echo (string)$str->toAscii();
     * // Acme
     * ```
     *
     * @since 1.0.0
     * @param string $language
     * @param bool $removeUnsupported
     * @return Str
     */
    public function toAscii(string $language = 'en', bool $removeUnsupported = true): Str
    {
        $split = \preg_split('/[-_]/', $language);
        $language = \strtolower($split[0]);
        $languageSpecific = ['de' => [['ä',  'ö',  'ü',  'Ä',  'Ö',  'Ü' ], ['ae', 'oe', 'ue', 'AE', 'OE', 'UE']], 'bg' => [['х', 'Х', 'щ', 'Щ', 'ъ', 'Ъ', 'ь', 'Ь'], ['h', 'H', 'sht', 'SHT', 'a', 'А', 'y', 'Y']]];
        if (!empty($languageSpecific[$language])) {
            $this->s = \str_replace($languageSpecific[$language][0], $languageSpecific[$language][1], $this->s);
        }
        foreach (self::CHARS_ARRAY as $key => $value) {
            $this->s = \str_replace($value, (string)$key, $this->s);
        }
        if ($removeUnsupported) {
            $this->s = (string) \preg_replace('/[^\x20-\x7E]/', '', $this->s);
        }
        return $this;
    }

    /**
     * slice
     *
     * Returns the substring beginning at $start, and up to, but not including the index
     * specified by $end. If $end is omitted, the function extracts the remaining string.
     * If $end is negative, it is computed from the end of the string.
     *
     * ```php
     * $str = new Str('Acme');
     * echo (string)$str->slice(2);
     * // me
     * ```
     *
     * @since 1.0.0
     * @param int $start
     * @param int|null $end
     * @return Str
     */
    public function slice(int $start, int $end = null): Str
    {
        if ($end === null) {
            $length = \mb_strlen($this->s);
        } elseif ($end >= 0 && $end <= $start) {
            $this->s = '';
            return $this;
        } elseif ($end < 0) {
            $length = \mb_strlen($this->s) + $end - $start;
        } else {
            $length = $end - $start;
        }
        $this->s = \mb_substr($this->s, $start, $length);
        return $this;
    }

    /**
     * stripWhitespace
     *
     * Strip all whitespace characters. This includes tabs and newline characters,
     * as well as multi-byte whitespace such as the thin space and ideographic space.
     *
     * ```php
     * $str = new Str('Acme foo');
     * echo (string)$str->stripWhitespace();
     * // Acmefoo
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function stripWhitespace(): Str
    {
        $this->s = (string) \mb_ereg_replace('[[:space:]]+', '', $this->s);
        return $this;
    }

    /**
     * truncate
     *
     * Truncates the string to a given $length. If $substring is provided, and truncating
     * occurs, the string is further truncated so that the substring may be appended
     * without exceeding the desired length.
     *
     * ```php
     * $str = new Str('What are your plans today?');
     * echo (string)$str->truncate(19, '...');
     * // What are your pl...
     * ```
     *
     * @since 1.0.0
     * @param int $length
     * @param string $substring
     * @return Str
     */
    public function truncate(int $length, string $substring = ''): Str
    {
        if ($length >= \mb_strlen($this->s)) {
            return $this;
        }
        $this->s = \mb_substr($this->s, 0, $length - \mb_strlen($substring)) . $substring;
        return $this;
    }

    /**
     * upperCamelize
     *
     * Returns an UpperCamelCase version of the string. It trims surrounding spaces,
     * capitalizes letters following digits, spaces, dashes and underscores,
     * and removes spaces, dashes, underscores.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->upperCamelize();
     * // FooBarBaz
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function upperCamelize(): Str
    {
        $this->s = (string) \mb_ereg_replace("^[\s]+|[\s]+\$", '', $this->s);
        $this->s = (string) \preg_replace('/^[-_]+/', '', $this->s);
        $this->s = (string) \preg_replace_callback('/[-_\s]+(.)?/u', function ($match) {
            return (string)\mb_strtoupper($match[1]);
        }, $this->s);
        $this->s = (string) \preg_replace_callback('/[\d]+(.)?/u', function ($match) {
            return \mb_strtoupper($match[0]);
        }, $this->s);
        $this->s = \mb_strtoupper(\mb_substr($this->s, 0, 1)) . \mb_substr($this->s, 1);
        return $this;
    }

    /**
     * surround
     *
     * Surrounds the string with the given $substring.
     *
     * ```php
     * $str = new Str('Acme');
     * echo (string)$str->surround('/');
     * // /Acme/
     * ```
     *
     * @since 1.0.0
     * @param string $substring
     * @return Str
     */
    public function surround(string $substring): Str
    {
        $this->s = $substring . $this->s . $substring;
        return $this;
    }

    /**
     * swapCase
     *
     * Returns a case swapped version of the string.
     *
     * ```php
     * $str = new Str('foObARbAz');
     * echo (string)$str->swapCase();
     * // FOoBarBaZ
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function swapCase(): Str
    {
        $this->s = \mb_strtolower($this->s) ^ \mb_strtoupper($this->s) ^ $this->s;
        return $this;
    }

    /**
     * tidy
     *
     * Returns a string with smart quotes, ellipsis characters, and dashes from Windows-1252
     * (commonly used in Word documents) replaced by their ASCII equivalents.
     *
     * ```php
     * $str = new Str('“I see…”');
     * echo (string)$str->tidy();
     * // "I see..."
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function tidy(): Str
    {
        $this->s = (string) \preg_replace(['/\x{2026}/u', '/[\x{201C}\x{201D}]/u', '/[\x{2018}\x{2019}]/u', '/[\x{2013}\x{2014}]/u'], ['...', '"', "'", '-'], $this->s);
        return $this;
    }

    /**
     * titleize
     *
     * Returns a trimmed string with the first letter of each word capitalized.
     * Also accepts an array, $ignore, allowing you to list words not to be capitalized.
     *
     * ```php
     * $str = new Str('i like to watch DVDs at home');
     * echo (string)$str->titleize(['at', 'to', 'the']);
     * // I Like to Watch Dvds at Home
     * ```
     *
     * @since 1.0.0
     * @param array $ignore
     * @return Str
     */
    public function titleize(array $ignore = []): Str
    {
        $this->s = \trim($this->s);
        $this->s = (string) \preg_replace_callback('/([\S]+)/u', function ($match) use ($ignore) {
            if (\in_array($match[0], $ignore, true)) {
                return $match[0];
            }
            return \mb_strtoupper(\mb_substr($match[0], 0, 1)) . \mb_strtolower(\mb_substr($match[0], 1));
        }, $this->s);
        return $this;
    }

    /**
     * toBoolean
     *
     * Returns a boolean representation of the given logical string value. For example,
     * 'true', '1', 'on' and 'yes' will return true. 'false', '0', 'off', and 'no' will
     * return false. In all instances, case is ignored. For other numeric strings, their
     * sign will determine the return value. In addition, blank strings consisting of only
     * whitespace will return false. For all other strings, the return value is a result of
     * a boolean cast.
     *
     * ```php
     * $str = new Str('yes');
     * echo $str->toBoolean();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function toBoolean(): bool
    {
        $key = \strtolower($this->s);
        $map = ['true' => true, '1' => true, 'on' => true, 'yes' => true, 'false' => false, '0' => false, 'off' => false, 'no' => false];
        if (\array_key_exists($key, $map)) {
            return $map[$key];
        }
        if (\is_numeric($this->s)) {
            return $this->s + 0 > 0;
        }
        return (bool)(string) \mb_ereg_replace('[[:space:]]+', '', $this->s);
    }

    /**
     * toSpaces
     *
     * Converts each tab in the string to some number of spaces, as defined by $tabLength.
     * By default, each tab is converted to 4 consecutive spaces.
     *
     * ```php
     * $str = new Str('foo    bar');
     * echo (string)$str->toSpaces(0);
     * // foobar
     * ```
     *
     * @since 1.0.0
     * @param int $tabLength
     * @return Str
     */
    public function toSpaces(int $tabLength = 4): Str
    {
        $this->s = \str_replace("\t", \str_repeat(' ', $tabLength), $this->s);
        return $this;
    }

    /**
     * toTabs
     *
     * Converts each occurrence of some consecutive number of spaces, as defined by $tabLength,
     * to a tab. By default, each 4 consecutive spaces are converted to a tab.
     *
     * ```php
     * $str = new Str('foo bar');
     * echo (string)$str->toTabs();
     * // foo    bar
     * ```
     *
     * @since 1.0.0
     * @param int $tabLength
     * @return Str
     */
    public function toTabs(int $tabLength = 4): Str
    {
        $this->s = \str_replace(\str_repeat(' ', $tabLength), "\t", $this->s);
        return $this;
    }

    /**
     * toTitleCase
     *
     * Converts the first character of each word in the string to uppercase.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->toTitleCase();
     * // Foo Bar Baz
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function toTitleCase(): Str
    {
        $this->s = \mb_convert_case($this->s, \MB_CASE_TITLE);
        return $this;
    }

    /**
     * underscored
     *
     * Returns a lowercase and trimmed string separated by underscores. Underscores
     * are inserted before uppercase characters (with the exception of the first
     * character of the string), and in place of spaces as well as dashes.
     *
     * ```php
     * $str = new Str('foo Bar baz');
     * echo (string)$str->underscored();
     * // foo_bar_baz
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function underscored(): Str
    {
        $this->s = (string) \mb_ereg_replace("^['\s']+|['\s']+\$", '', $this->s);
        $this->s = \mb_strtolower((string) \mb_ereg_replace('\B([A-Z])', '-\1', $this->s));
        $this->s = (string) \mb_ereg_replace('[-_\s]+', '_', $this->s);
        return $this;
    }

    /**
     * move
     *
     * Move substring of desired $length to $destination index of the original string.
     * In case $destination is less than $length returns the string untouched.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->move(0, 2, 4);
     * // cm/Ae/
     * ```
     *
     * @since 1.0.0
     * @param int $start
     * @param int $length
     * @param int $destination
     * @return Str
     */
    public function move(int $start, int $length, int $destination): Str
    {
        if ($destination <= $length) {
            return $this;
        }
        $substr = \mb_substr($this->s, $start, $length);
        $this->s = \mb_substr($this->s, 0, $destination) . $substr . \mb_substr($this->s, $destination);
        $pos = \mb_strpos($this->s, $substr, 0);
        $this->s = \mb_substr($this->s, 0, $pos) . \mb_substr($this->s, $pos + \mb_strlen($substr));
        return $this;
    }

    /**
     * overwrite
     *
     * Replaces substring in the original string of $length with given $substr.
     *
     * ```php
     * $str = new Str('/Acme/');
     * echo (string)$str->overwrite(0, 2, 'BAR');
     * // BARcme/
     * ```
     *
     * @since 1.0.0
     * @param int $start
     * @param int $length
     * @param string $substr
     * @return Str
     */
    public function overwrite(int $start, int $length, string $substr): Str
    {
        if ($length <= 0) {
            return $this;
        }
        $sub = \mb_substr($this->s, $start, $length);
        $pos = \mb_strpos($this->s, $sub, 0);
        $this->s = \mb_substr($this->s, 0, $pos) . $substr . \mb_substr($this->s, $pos + \mb_strlen($sub));
        return $this;
    }

    /**
     * snakeize
     *
     * Returns a snake_case version of the string.
     *
     * ```php
     * $str = new Str('Foo Bar');
     * echo (string)$str->snakeize();
     * // foo_bar
     * ```
     *
     * @since 1.0.0
     * @return Str
     */
    public function snakeize(): Str
    {
        $this->s = (string) \mb_ereg_replace('::', '/', $this->s);
        $this->s = (string) \mb_ereg_replace('([A-Z]+)([A-Z][a-z])', '\1_\2', $this->s);
        $this->s = (string) \mb_ereg_replace('([a-z\d])([A-Z])', '\1_\2', $this->s);
        $this->s = (string) \mb_ereg_replace('\s+', '_', $this->s);
        $this->s = (string) \mb_ereg_replace('\s+', '_', $this->s);
        $this->s = (string) \mb_ereg_replace('^\s+|\s+$', '', $this->s);
        $this->s = (string) \mb_ereg_replace('-', '_', $this->s);
        $this->s = \mb_strtolower($this->s);
        $this->s = (string) \mb_ereg_replace_callback('([\d|A-Z])', function ($matches) {
            $match = $matches[1];
            return (string)(int)$match === $match ? '_' . $match . '_' : '';
        }, $this->s);
        $this->s = (string) \mb_ereg_replace('_+', '_', $this->s);
        $this->s = (string) \preg_replace('/^[_]+|[_]+$/', '', $this->s);

        return $this;
    }

    /**
     * afterFirst
     *
     * Inserts given $substr $times into the original string after
     * the first occurrence of $needle.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->afterFirst('a', 'duh', 2);
     * // foo baduhduhr baz
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param string $substr
     * @param int $times
     * @return Str
     */
    public function afterFirst(string $needle, string $substr, int $times = 1): Str
    {
        $idxEnd = \mb_strpos($this->s, $needle) + \mb_strlen($needle);
        $this->s = \mb_substr($this->s, 0, $idxEnd) . \str_repeat($substr, $times) . \mb_substr($this->s, $idxEnd);
        return $this;
    }

    /**
     * beforeFirst
     *
     * Inserts given $substr $times into the original string before
     * the first occurrence of $needle.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->beforeFirst('a', 'duh');
     * // foo bduhar baz
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param string $substr
     * @param int $times
     * @return Str
     */
    public function beforeFirst(string $needle, string $substr, int $times = 1): Str
    {
        $idx = \mb_strpos($this->s, $needle);
        $this->s = \mb_substr($this->s, 0, $idx) . \str_repeat($substr, $times) . \mb_substr($this->s, $idx);
        return $this;
    }

    /**
     * afterLast
     *
     * Inserts given $substr $times into the original string after
     * the last occurrence of $needle.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->afterLast('a', 'duh', 2);
     * // foo bar baduhduhz
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param string $substr
     * @param int $times
     * @return Str
     */
    public function afterLast(string $needle, string $substr, int $times = 1): Str
    {
        $idxEnd = \mb_strrpos($this->s, $needle) + \mb_strlen($needle);
        $this->s = \mb_substr($this->s, 0, $idxEnd) . \str_repeat($substr, $times) . \mb_substr($this->s, $idxEnd);
        return $this;
    }

    /**
     * beforeLast
     *
     * Inserts given $substr $times into the original string before
     * the last occurrence of $needle.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo (string)$str->beforeLast('a', 'duh');
     * // foo bar bduhaz
     * ```
     *
     * @since 1.0.0
     * @param string $needle
     * @param string $substr
     * @param int $times
     * @return Str
     */
    public function beforeLast(string $needle, string $substr, int $times = 1): Str
    {
        $idx = \mb_strrpos($this->s, $needle);
        $this->s = \mb_substr($this->s, 0, $idx) . \str_repeat($substr, $times) . \mb_substr($this->s, $idx);
        return $this;
    }

    /**
     * isEmail
     *
     * Splits the original string in pieces by '@' delimiter and returns
     * true in case the resulting array consists of 2 parts.
     *
     * ```php
     * $str = new Str('test@test@example.com');
     * echo $str->isEmail();
     * // false
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isEmail(): bool
    {
        return \count(\mb_split('@', $this->s)) === 2;
    }

    /**
     * isIpV4
     *
     * Return true if this is valid ipv4 address
     *
     * ```php
     * $str = new Str('1.0.1.0');
     * echo $str->isIpV4();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isIpV4(): bool
    {
        return (bool)\preg_match('/\b((25[0-5]|2[0-4][\d]|[01]?[\d][\d]?)(\.|$)){4}\b/', $this->s);
    }

    /**
     * isIpV6
     *
     * Return true if this is valid ipv6 address
     *
     * ```php
     * $str = new Str('2001:cdba::3257:9652');
     * echo $str->isIpV6();
     * // true
     * ```
     *
     * @since 1.0.0
     * @return bool
     */
    public function isIpV6(): bool
    {
        return (bool)\preg_match('/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/', $this->s);
    }

    /**
     * random
     *
     * Generates a random string consisting of $possibleChars, if specified, of given $size or
     * random length between $size and $sizeMax. If $possibleChars is not specified, the generated string
     * will consist of ASCII alphanumeric chars.
     *
     * ```php
     * $str = new Str('foo bar');
     * echo $str->random(3, -1, 'fobarz');
     * // zfa
     * $str = new Str('');
     * echo $str->random(3);
     * // 1ho
     * ```
     *
     * @since 1.0.0
     * @param int $size
     * @param int $sizeMax
     * @param string $possibleChars
     * @return Str
     */
    public function random(int $size, int $sizeMax = -1, string $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'): Str
    {
        if ($size <= 0 || $sizeMax === 0) {
            $this->s = '';
            return $this;
        }
        if ($sizeMax > 0 && $sizeMax < $size) {
            $this->s = '';
            return $this;
        }
        $maxLen = $sizeMax > 0 ? $sizeMax : $size;
        $actualLen = \random_int($size, $maxLen);
        $allowedCharsLen = \mb_strlen($possibleChars) - 1;
        $result = '';
        while ($actualLen--) {
            $char = \mb_substr($possibleChars, \random_int(0, $allowedCharsLen), 1);
            $result .= $char;
        }
        $this->s = $result;
        return $this;
    }

    /**
     * appendUniqueIdentifier
     *
     * Appends a random string consisting of $possibleChars, if specified, of given $size or
     * random length between $size and $sizeMax to the original string.
     *
     * ```php
     * $str = new Str('foo');
     * echo $str->appendUniqueIdentifier(3, -1, 'foba_rz');
     * // foozro
     * ```
     *
     * @since 1.0.0
     * @param int $size
     * @param int $sizeMax
     * @param string $possibleChars
     * @return Str
     */
    public function appendUniqueIdentifier(int $size = 4, int $sizeMax = -1, string $possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'): Str
    {
        if ($size <= 0 || $sizeMax === 0) {
            $this->s = '';
            return $this;
        }
        if ($sizeMax > 0 && $sizeMax < $size) {
            $this->s = '';
            return $this;
        }
        $maxLen = $sizeMax > 0 ? $sizeMax : $size;
        $actualLen = \random_int($size, $maxLen);
        $allowedCharsLen = \mb_strlen($possibleChars) - 1;
        $result = '';
        while ($actualLen--) {
            $char = \mb_substr($possibleChars, \random_int(0, $allowedCharsLen), 1);
            $result .= $char;
        }
        $this->s .= $result;
        return $this;
    }

    /**
     * words
     *
     * Splits on whitespace, returning an array of strings corresponding to the words in the string.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo $str->words();
     * // ['foo', 'bar', 'baz']
     * ```
     *
     * @since 1.0.0
     * @return array
     */
    public function words(): array
    {
        if ('' === $this->s) {
            return [];
        }
        return \mb_split('[[:space:]]+', $this->s);
    }

    /**
     * quote
     *
     * Wraps each word in the string with specified $quote.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo $str->quote('*');
     * // *foo* *bar* *baz*
     * ```
     *
     * @since 1.0.0
     * @param string $quote
     * @return Str
     */
    public function quote(string $quote = '"'): Str
    {
        $words = \mb_split('[[:space:]]+', $this->s);
        $result = [];
        foreach ($words as $word) {
            $result[] = $quote . $word . $quote;
        }
        $this->s = \implode(' ', $result);
        return $this;
    }

    /**
     * unquote
     *
     * Unwraps each word in the original string, deleting the specified $quote.
     *
     * ```php
     * $str = new Str('*foo* bar* ***baz*');
     * echo $str->unquote('*');
     * // foo bar baz
     * ```
     *
     * @since 1.0.0
     * @param string $quote
     * @return Str
     */
    public function unquote(string $quote = '"'): Str
    {
        $words = \mb_split('[[:space:]]+', $this->s);
        $result = [];
        foreach ($words as $word) {
            $this->s = $word;
            $this->s = (string) \mb_ereg_replace("^[$quote]+|[$quote]+\$", '', $this->s);
            $result[] = $this->s;
        }
        $this->s = \implode(' ', $result);
        return $this;
    }

    /**
     * chop
     *
     * Cuts the original string in pieces of $step size.
     *
     * ```php
     * $str = new Str('foo bar baz');
     * echo $str->chop(2);
     * // ['fo', 'o ', 'ba', 'r ', 'ba', 'z']
     * ```
     *
     * @since 1.0.0
     * @param int $step
     * @return array
     */
    public function chop(int $step): array
    {
        $result = [];
        $len = \mb_strlen($this->s);
        if ($this->s === '' || $step <= 0) {
            return [];
        }
        if ($step >= $len) {
            return [$this->s];
        }
        $startPos = 0;
        for ($i = 0; $i < $len; $i+=$step) {
            $result[] = \mb_substr($this->s, $startPos, $step);
            $startPos += $step;
        }
        return $result;
    }

    /**
     * join
     *
     * Joins the original string with an array of other strings with the given $separator.
     *
     * ```php
     * $str = new Str('foo');
     * echo $str->join('*', ['bar', 'baz']);
     * // foo*bar*baz
     * ```
     *
     * @since 1.0.0
     * @param string $separator
     * @param array $otherStrings
     * @return Str
     */
    public function join(string $separator, array $otherStrings = []): Str
    {
        if ('' === $this->s) {
            return $this;
        }
        foreach ($otherStrings as $otherString) {
            $this->s .= ($separator . $otherString);
        }
        return $this;
    }

    /**
     * shift
     *
     * Returns the substring of the original string from beginning to the first occurrence
     * of $delimiter.
     *
     * ```php
     * $str = new Str('Acme/foo');
     * echo $str->shift('/');
     * // Acme
     * ```
     *
     * @since 1.0.0
     * @param string $delimiter
     * @return Str
     */
    public function shift(string $delimiter): Str
    {
        if ('' === $delimiter) {
            $this->s = '';
            return $this;
        }
        $this->s = \mb_substr($this->s, 0, \mb_strpos($this->s, $delimiter) ?: \mb_strlen($this->s));
        return $this;
    }

    /**
     * shiftReversed
     *
     * Returns the substring of the original string from the first occurrence of $delimiter to the end.
     *
     * ```php
     * $str = new Str('Acme/foo/bar');
     * echo $str->shiftReversed('/');
     * // foo/bar
     * ```
     *
     * @since 1.0.0
     * @param string $delimiter
     * @return Str
     */
    public function shiftReversed(string $delimiter): Str
    {
        if ('' === $delimiter) {
            $this->s = '';
            return $this;
        }
        $idx = \mb_strpos($this->s, $delimiter);
        $this->s = \mb_substr($this->s, $idx ? $idx + 1 : 0);
        return $this;
    }

    /**
     * pop
     *
     * Returns the substring of the string from the last occurrence of $delimiter to the end.
     *
     * ```php
     * $str = new Str('Acme/foo');
     * echo $str->pop('/');
     * // foo
     * ```
     *
     * @since 1.0.0
     * @param string $delimiter
     * @return Str
     */
    public function pop(string $delimiter): Str
    {
        if ('' === $delimiter) {
            $this->s = '';
            return $this;
        }
        $idx = \mb_strrpos($this->s, $delimiter);
        $this->s = \mb_substr($this->s, $idx ? $idx + 1 : 0);
        return $this;
    }

    /**
     * popReversed
     *
     * Returns the substring of the original string from the beginning
     * to the last occurrence of $delimiter.
     *
     * ```php
     * $str = new Str('Acme/foo/bar');
     * echo $str->popReversed('/');
     * // Acme/foo
     * ```
     *
     * @since 1.0.0
     * @param string $delimiter
     * @return Str
     */
    public function popReversed(string $delimiter): Str
    {
        if ('' === $delimiter) {
            $this->s = '';
            return $this;
        }
        $this->s = \mb_substr($this->s, 0, \mb_strrpos($this->s, $delimiter) ?: \mb_strlen($this->s));
        return $this;
    }
}
