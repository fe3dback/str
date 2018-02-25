<?php

declare(strict_types=1);

namespace Str;

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
        $this->assertEquals('H', $s->at(0));
        $this->assertEquals('e', $s->at(1));
        $this->assertEquals('L', $s->at(2));
        $this->assertEquals('世', $s->at(6));

        $s = new Str('HeL世');
        $this->assertEquals([' ','H','e','L','世'],
            $s
            ->prepend(' ')
            ->chars()
        );

        $this->assertCount(5, $s->chars());
        $this->assertEquals(5, $s->length());
        $this->assertEquals(\count($s->chars()), $s->length());
    }

    public function testModifiers()
    {
        $s = new Str('Önnek İş');
        $this->assertEquals('önnek iş', $s->toLowerCase());

        $s = new Str('fòôbàř');
        $this->assertEquals('FÒÔBÀŘ', $s->toUpperCase());
        $this->assertEquals('fòôbàř', $s->toLowerCase());
    }

    public function testTrim()
    {
        $s = new Str('[fòôbàř]');
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

    public function testAppendAndPrepend()
    {
        $s = new Str('fòô');
        $this->assertEquals('fòôbàř', $s->append('bàř'));
        $this->assertEquals('世 fòôbàř', $s->prepend('世 '));
    }

    public function testSearch()
    {
        $s = new Str('Hello 世 fòôbàř');
        $this->assertTrue($s->contains('世'));
        $this->assertTrue($s->contains(' '));
        $this->assertTrue($s->contains('bàř'));

        $this->assertFalse($s->contains('rnd'));
        $this->assertFalse($s->contains('bò世'));
        $this->assertFalse($s->contains('  '));

        $this->assertEquals('He', $s->first(2));
        $this->assertEquals('', $s->first(0));
        $this->assertEquals('bàř', $s->last(3));
        $this->assertEquals('', $s->last(-1));

        $this->assertEquals(6, $s->indexOf('世'));
        $this->assertEquals(2, $s->indexOf('l'));
        $this->assertEquals(3, $s->indexOfLast('l'));

        $s = new Str(' 世 HeLlo 世 fòôbàř');
        $this->assertEquals(2, $s->countSubstr('世'));
        $this->assertEquals(2, $s->countSubstr('l', false));
    }


}
