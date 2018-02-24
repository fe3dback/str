<?php

declare(strict_types=1);

namespace FS;

use PHPUnit\Framework\TestCase;

class SCommonTest extends TestCase
{
    public function EnsureLeftProvider() {
        return
        [
            [
                ['Hello world', '_left>>'],
                '_left>>Hello world',
            ],

            [
                ['_left>>Hello world', '_left>>'],
                '_left>>Hello world',
            ],

            [
                ['q', 'q'],
                'q',
            ],

            [
                ['qq', 'q'],
                'qq',
            ],

            [
                ['Hello, 世界', '界'],
                '界Hello, 世界',
            ],

            [
                ['界Hello, 世界', '界'],
                '界Hello, 世界',
            ],

            [
                ['世', '世'],
                '世',
            ],
        ];
    }

    public function EnsureRightProvider() {
        return
        [
            [
                ['Hello world', '<<_right'],
                'Hello world<<_right',
            ],

            [
                ['Hello world<<_right', '<<_right'],
                'Hello world<<_right',
            ],

            [
                ['q', 'q'],
                'q',
            ],

            [
                ['qq', 'q'],
                'qq',
            ],

            [
                ['Hello, 世界', '世'],
                'Hello, 世界世',
            ],

            [
                ['Hello, 世界界', '界'],
                'Hello, 世界界',
            ],

            [
                ['世', '世'],
                '世',
            ],
        ];
    }

    public function HasPrefixProvider() {
        return
        [
            [
                ['Hello world', 'Hel'],
                true
            ],

            [
                ['Hello world', 'ell'],
                false
            ],

            [
                ['世Hello world', '世'],
                true
            ],

            [
                ['世H世ello world世', '世H世'],
                true
            ],

            [
                ['世h世ello world世', '世H'],
                false
            ],

            [
                ['h', 'h'],
                true
            ],

            [
                ['hh', 'hh'],
                true
            ],

            [
                ['hhh', 'h'],
                true
            ],

            [
                ['h', ''],
                false
            ],

            [
                ['', 'h'],
                false
            ],
        ];
    }

    public function HasSuffixProvider() {
        return
            [
                [
                    ['Hello world', 'rld'],
                    true
                ],

                [
                    ['Hello world', 'orl'],
                    false
                ],

                [
                    ['Hello world世', '世'],
                    true
                ],

                [
                    ['世H世ello worl世d世', '世d世'],
                    true
                ],

                [
                    ['世h世ello world世', 'D世'],
                    false
                ],

                [
                    ['h', 'h'],
                    true
                ],

                [
                    ['hh', 'hh'],
                    true
                ],

                [
                    ['hhh', 'h'],
                    true
                ],

                [
                    ['h', ''],
                    false
                ],

                [
                    ['', 'h'],
                    false
                ],
            ];
    }

    /**
     * @dataProvider EnsureLeftProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureLeft(array $inp, string $out)
    {
        $this->assertEquals($out, Lib\SCommon::ensureLeft(
            array_shift($inp),
            array_shift($inp)
        ));
    }

    /**
     * @dataProvider EnsureRightProvider
     * @param array $inp
     * @param string $out
     */
    public function testEnsureRight(array $inp, string $out)
    {
        $this->assertEquals($out, Lib\SCommon::ensureRight(
            array_shift($inp),
            array_shift($inp)
        ));
    }

    /**
     * @dataProvider HasPrefixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasPrefix(array $inp, bool $result)
    {
        $this->assertEquals($result, Lib\SCommon::hasPrefix(
            array_shift($inp),
            array_shift($inp)
        ));
    }

    /**
     * @dataProvider HasSuffixProvider
     * @param array $inp
     * @param bool $result
     */
    public function testHasSuffix(array $inp, bool $result)
    {
        $this->assertEquals($result, Lib\SCommon::hasSuffix(
            array_shift($inp),
            array_shift($inp)
        ));
    }
}
