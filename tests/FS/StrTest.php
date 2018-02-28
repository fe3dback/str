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
        $s = new Str('b3467be4-1bd7-11e8-accf-0ed5f89f718b');
        $this->assertEquals(false, $s->isUUIDv4());

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
        $this->assertEquals('Fòôbàř', $s->upperCaseFirst());
        $this->assertEquals('fòôbàř', $s->lowerCaseFirst());
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
        $this->assertEquals(true, $s->startsWith('Hel'));
        $this->assertEquals(true, $s->startsWithAny(['not', 'Hel']));
        $this->assertEquals(true, $s->endsWith('àř'));
        $this->assertEquals(false, $s->endsWithAny(['世', 'Hel']));

        $this->assertEquals(6, $s->indexOf('世'));
        $this->assertEquals(2, $s->indexOf('l'));
        $this->assertEquals(3, $s->indexOfLast('l'));

        $s = new Str(' 世 HeLlo 世 fòôbàř');
        $this->assertEquals(2, $s->countSubstr('世'));
        $this->assertEquals(2, $s->countSubstr('l', false));
        $this->assertEquals(true, $s->containsAll(['世', 'fòôbàř']));
        $this->assertEquals(false, $s->containsAny(['gh', 'H2']));

        $s = new Str('');
        $this->assertEquals(false, $s->startsWith('anything'));
    }

    public function testPadMutativeFunctions()
    {
        $s = new Str('fòô');
        $this->assertEquals('   fòô   ', (string)$s->pad(9, ' ', 'both'));
        $this->assertEquals('bàř   fòô   ', (string)$s->padLeft(12, 'bàř'));
        $this->assertEquals('bàř   fòô   bàř', (string)$s->padRight(15, 'bàř'));
        $this->assertEquals('bàbàř   fòô   bàřbà', (string)$s->padBoth(19, 'bàř'));
        $this->assertEquals('bàbàř fòô bàřbà', (string)$s->collapseWhitespace());
        $this->assertEquals('bàbàř*fòô*bàřbà', (string)$s->delimit('*'));

        $s = new Str('oo bar');
        $this->assertEquals('foo bar', (string)$s->insert('f', 0));
        $this->assertEquals('oo bar', (string)$s->removeLeft('f'));
        $this->assertEquals('oo b', (string)$s->removeRight('ar'));
        $this->assertEquals('oo boo b', (string)$s->repeat(2));
        $this->assertEquals('b oob oo', (string)$s->reverse());
        $this->assertEquals('bOobOo', (string)$s->camelize());
        $this->assertEquals('b-oob-oo', (string)$s->dasherize());

        $s = new Str('{foo} and {bar}');
        $this->assertEquals('bar', (string)$s->between('{', '}', 1));
    }

    public function testRandomFunctions()
    {
        $s = new Str('HeLlo 世 fòôbàř');
        $this->assertEquals(\mb_strlen((string)$s), \mb_strlen((string)$s->shuffle()));
    }

    public function testRegexFunctions()
    {
        $s = new Str('fòô ');
        $this->assertEquals('bàř', (string)$s->regexReplace('f[òô]+\s', 'bàř'));
    }
}
