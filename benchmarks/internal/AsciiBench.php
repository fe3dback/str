<?php

namespace Benchmark;

use Str\Ascii;

class AsciiBench
{
    const VALID_ASCII = [
        ' ',    //  (space) // 32
        '!',    //	(exclamation mark) // 33
        '"',    //	(Quotation mark) // 34
        '#',    //	(Number sign) // 35
        '$',    //	(Dollar sign) // 36
        '%',    //	(Percent sign) // 37
        '&',    //	(Ampersand) // 38
        '\'',   //	(Apostrophe) // 39
        '(',    //	(round brackets or parentheses) // 40
        ')',    //	(round brackets or parentheses) // 41
        '*',    //	(Asterisk) // 42
        '+',    //	(Plus sign) // 43
        ',',    //	(Comma) // 44
        '-',    //	(Hyphen) // 45
        '.',    //	(Full stop , dot) // 46
        '/',    //	(Slash) // 47
        '0',    //	(number zero) // 48
        '1',    //	(number one) // 49
        '2',    //	(number two) // 50
        '3',    //	(number three) // 51
        '4',    //	(number four) // 52
        '5',    //	(number five) // 53
        '6',    //	(number six) // 54
        '7',    //	(number seven) // 55
        '8',    //	(number eight) // 56
        '9',    //	(number nine) // 57
        ':',    //	(Colon) // 58
        ';',    //	(Semicolon) // 59
        '<',    //	(Less-than sign ) // 60
        '=',    //	(Equals sign) // 61
        '>',    //	(Greater-than sign ; Inequality) // 62
        '?',    //	(Question mark) // 63
        '@',    //	(At sign) // 64
        'A',    //	(Capital A ) // 65
        'B',    //	(Capital B ) // 66
        'C',    //	(Capital C ) // 67
        'D',    //	(Capital D ) // 68
        'E',    //	(Capital E ) // 69
        'F',    //	(Capital F ) // 70
        'G',    //	(Capital G ) // 71
        'H',    //	(Capital H ) // 72
        'I',    //	(Capital I ) // 73
        'J',    //	(Capital J ) // 74
        'K',    //	(Capital K ) // 75
        'L',    //	(Capital L ) // 76
        'M',    //	(Capital M ) // 77
        'N',    //	(Capital N ) // 78
        'O',    //	(Capital O ) // 79
        'P',    //	(Capital P ) // 80
        'Q',    //	(Capital Q ) // 81
        'R',    //	(Capital R ) // 82
        'S',    //	(Capital S ) // 83
        'T',    //	(Capital T ) // 84
        'U',    //	(Capital U ) // 85
        'V',    //	(Capital V ) // 86
        'W',    //	(Capital W ) // 87
        'X',    //	(Capital X ) // 88
        'Y',    //	(Capital Y ) // 89
        'Z',    //	(Capital Z ) // 90
        '[',    //	(square brackets or box brackets) // 91
        '\\',   //	(Backslash) // 92
        ']',    //	(square brackets or box brackets) // 93
        '^',    //	(Caret or circumflex accent) // 94
        '_',    //	(underscore , understrike , underbar or low line) // 95
        '`',    //	(Grave accent) // 96
        'a',    //	(Lowercase  a ) // 97
        'b',    //	(Lowercase  b ) // 98
        'c',    //	(Lowercase  c ) // 99
        'd',    //	(Lowercase  d ) // 100
        'e',    //	(Lowercase  e ) // 101
        'f',    //	(Lowercase  f ) // 102
        'g',    //	(Lowercase  g ) // 103
        'h',    //	(Lowercase  h ) // 104
        'i',    //	(Lowercase  i ) // 105
        'j',    //	(Lowercase  j ) // 106
        'k',    //	(Lowercase  k ) // 107
        'l',    //	(Lowercase  l ) // 108
        'm',    //	(Lowercase  m ) // 109
        'n',    //	(Lowercase  n ) // 110
        'o',    //	(Lowercase  o ) // 111
        'p',    //	(Lowercase  p ) // 112
        'q',    //	(Lowercase  q ) // 113
        'r',    //	(Lowercase  r ) // 114
        's',    //	(Lowercase  s ) // 115
        't',    //	(Lowercase  t ) // 116
        'u',    //	(Lowercase  u ) // 117
        'v',    //	(Lowercase  v ) // 118
        'w',    //	(Lowercase  w ) // 119
        'x',    //	(Lowercase  x ) // 120
        'y',    //	(Lowercase  y ) // 121
        'z',    //	(Lowercase  z ) // 122
        '{',    //	(curly brackets or braces) // 123
        '|',    //	(vertical-bar, vbar, vertical line or vertical slash) // 124
        '}',    //	(curly brackets or braces) // 125
        '~',    //	(Tilde ; swung dash) // 126
    ];

    const INVALID_ASCII = 'Hello world, i`am not valid ascii string, with special symbols. Например русские буквы. 世';

    private static $valid_ascii = 'Hello world, this is valid ascii string, and all chars: ';

    public function __construct()
    {
        self::$valid_ascii .= implode('', self::VALID_ASCII);
    }

    /**
     * @throws \RuntimeException
     */
    public function bench_MbDetectEncoding()
    {
        if (!Ascii::checkWithMb(self::$valid_ascii)) {
            $this->halt(__LINE__);
        }

        if (Ascii::checkWithMb(self::INVALID_ASCII)) {
            $this->halt(__LINE__, true);
        }
    }

    /**
     * @throws \RuntimeException
     */
    public function bench_Regex()
    {
        if (!Ascii::checkWithRegex(self::$valid_ascii)) {
            $this->halt(__LINE__);
        }

        if (Ascii::checkWithRegex(self::INVALID_ASCII)) {
            $this->halt(__LINE__, true);
        }
    }

    /**
     * @throws \RuntimeException
     */
    public function bench_CType()
    {
        if (!Ascii::checkWithCType(self::$valid_ascii)) {
            $this->halt(__LINE__);
        }

        if (Ascii::checkWithCType(self::INVALID_ASCII)) {
            $this->halt(__LINE__, true);
        }
    }

    /**
     * @param $line
     * @param bool $isReversed
     * @throws \RuntimeException
     */
    private function halt(int $line, bool $isReversed = false)
    {
        throw new \RuntimeException(
            vsprintf('This is %s ascii string, but detected as %s at %s:%d',
                [
                    !$isReversed ? 'valid' : 'invalid',
                    !$isReversed ? 'invalid' : 'valid',
                    __FILE__, $line
                ]
            )
        );
    }
}