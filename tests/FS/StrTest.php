<?php

declare(strict_types=1);

namespace FS;

use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testGetString()
    {
        $s = new Str('Hello world');
        $this->assertEquals($s->getString(), 'Hello world');
        $this->assertEquals($s->getString(), $s->toString());
        $this->assertEquals($s->getString(), $s);
        $this->assertEquals($s->toString(), $s);
        $this->assertEquals((string)$s, 'Hello world');
        $this->assertEquals($s, 'Hello world');
    }

    public function testPrefixSuffix()
    {
        $s = (new Str('世'))
            ->ensureLeft('>>')
            ->ensureRight('<<');

        $this->assertEquals((string)$s, '>>世<<');
        $this->assertTrue($s->hasPrefix('>>'));
        $this->assertTrue($s->hasSuffix('<<'));
    }

    public function testCommon()
    {
        $s = (new Str('世'))
            ->ensureLeft('Hello ')
            ->replace('l', 'L', 1);

        $this->assertEquals('HeLlo 世', $s);
        $this->assertTrue($s->hasPrefix('HeL'));
    }

    public function testModifiers()
    {
        $s = (new Str('Önnek İş'));
        $this->assertEquals('önnek iş', $s->toLowerCase());

        $s = (new Str('fòôbàř'));
        $this->assertEquals('FÒÔBÀŘ', $s->toUpperCase());
        $this->assertEquals('fòôbàř', $s->toLowerCase());
    }

    public function testTrim()
    {
        $s = (new Str('[fòôbàř]'));
        $this->assertEquals('fòôbàř]', $s->trimLeft('['));
        $this->assertEquals('fòôbàř', $s->trimRight(']'));
        $this->assertEquals('fòôbàř', $s
            ->ensureLeft('!!')
            ->ensureRight('!!')
            ->trim('!')
        );
        $this->assertEquals('fòôbà', $s
            ->ensureLeft('!!!')
            ->ensureRight('!!!')
            ->trim('!ř')
        );
    }


}
