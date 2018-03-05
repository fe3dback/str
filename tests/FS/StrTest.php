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
        $this->assertFalse($s->isUUIDv4());

        $s = (new Str('世'))
            ->ensureLeft('Hello ')
            ->replace('l', 'L', 1);

        $this->assertEquals('HeLlo 世', $s);
        $this->assertTrue($s->hasPrefix('HeL'));
        $this->assertTrue($s->hasLowerCase());
        $this->assertTrue($s->hasUpperCase());
        $this->assertFalse($s->isAlpha());
        $this->assertFalse($s->isAlphanumeric());
        $this->assertFalse($s->isBase64());
        $this->assertFalse($s->isBlank());
        $this->assertFalse($s->isHexadecimal());
        $this->assertFalse($s->isJson());
        $this->assertFalse($s->isLowerCase());
        $this->assertFalse($s->isSerialized());
        $this->assertFalse($s->isUpperCase());

        $s = new Str('HeL世');
        $this->assertEquals([' ','H','e','L','世'],
            $s
            ->prepend(' ')
            ->chars()
        );

        $this->assertCount(5, $s->chars());
        $this->assertEquals(5, $s->length());
        $this->assertEquals(\count($s->chars()), $s->length());

        $s = new Str('no');
        $this->assertFalse($s->toBoolean());

        $s = new Str('email@email.com');
        $this->assertTrue($s->isEmail());

        $s = new Str('1.0.1.0');
        $this->assertTrue($s->isIpV4());

        $s = new Str('2001:cdba::3257:9652');
        $this->assertTrue($s->isIpV6());
    }

    public function testModifiers()
    {
        $s = new Str('Önnek İş');
        $this->assertEquals('önnek iş', $s->toLowerCase());
        $this->assertEquals('ö', $s->at(0));

        $s = new Str('fòôbàř');
        $this->assertEquals('FÒÔBÀŘ', $s->toUpperCase());
        $this->assertEquals('fòôbàř', $s->toLowerCase());
        $this->assertEquals('Fòôbàř', $s->upperCaseFirst());
        $this->assertEquals('fòôbàř', $s->lowerCaseFirst());

        $s = new Str('author_id');
        $this->assertEquals('Author', $s->humanize());
        $this->assertEquals('aUTHOR', $s->swapCase());

        $s = new Str('Hello 世 fòôbàř');
        $this->assertEquals('He', $s->first(2));
        $this->assertEquals('', $s->first(0));

        $s = new Str('Hello 世 fòôbàř');
        $this->assertEquals('bàř', $s->last(3));
        $this->assertEquals('', $s->last(-1));

        $s = new Str('fòô');
        $this->assertEquals('   fòô   ', $s->pad(9, ' ', 'both'));
        $this->assertEquals('bàř   fòô   ', $s->padLeft(12, 'bàř'));
        $this->assertEquals('bàř   fòô   bàř', $s->padRight(15, 'bàř'));
        $this->assertEquals('bàbàř   fòô   bàřbà', $s->padBoth(19, 'bàř'));
        $this->assertEquals('bàbàř fòô bàřbà', $s->collapseWhitespace());
        $this->assertEquals('bàbàř*fòô*bàřbà', $s->delimit('*'));

        $s = new Str('oo bar');
        $this->assertEquals('foo bar', $s->insert('f', 0));
        $this->assertEquals('oo bar', $s->removeLeft('f'));
        $this->assertEquals('oo b', $s->removeRight('ar'));
        $this->assertEquals('oo boo b', $s->repeat(2));
        $this->assertEquals('b oob oo', $s->reverse());
        $this->assertEquals('bOobOo', $s->camelize());
        $this->assertEquals('b-oob-oo', $s->dasherize());
        $this->assertEquals('booo', $s->safeTruncate(4, 'ooo'));
        $this->assertEquals('oo', $s->substr(2));
        $this->assertEquals('oo', $s->truncate(8, 'i'));

        $s = new Str('{foo} and {bar}');
        $this->assertEquals('bar', $s->between('{', '}', 1));
        $this->assertEquals('__bar__', $s->surround('__'));

        $s = new Str('foo and other stuff');
        $this->assertEquals('foo-and-other-stuff', $s->slugify());
        $this->assertEquals('foo_and_other_stuff', $s->underscored());

        $s = new Str('fòôbàř');
        $this->assertEquals('foobar', $s->toAscii());
        $this->assertEquals('oobar', $s->slice(1));

        $s = new Str('str with     whitespace ');
        $this->assertEquals('strwithwhitespace', $s->stripWhitespace());
        $this->assertEquals('Strwithwhitespace', $s->upperCamelize());
        $this->assertEquals('rwStithwhitespace', $s->move(0, 2, 4));
        $this->assertEquals('rw_stithwhitespace', $s->snakeize());
        $this->assertEquals('rw_stit_here!_hwhitespace', $s->afterFirst('it', '_here!_'));
        $this->assertEquals('rw_stit_h_here!_ere!_hwhitespace', $s->beforeFirst('e', '_here!_'));
        $this->assertEquals('rw_stit_h_here!_ere!_hwhit_ttt!_espace', $s->afterLast('t', '_ttt!_'));
        $this->assertEquals('rw_stit_h_here!_ere!_hwhit_tt_morett!_t!_espace', $s->beforeLast('t', '_morett!_'));

        $s = new Str('I see…');
        $this->assertEquals('I see...', $s->tidy());
        $this->assertEquals('I See...', $s->titleize());

        $s = new Str("\t\tstr\twith tabs");
        $this->assertEquals('strwith tabs', $s->toSpaces(0));
        $this->assertEquals("strwith\ttabs", $s->toTabs(1));
        $this->assertEquals("Strwith\tTabs", $s->toTitleCase());
        $this->assertEquals("hello with\tTabs", $s->overwrite(0, 3, 'hello '));
        $this->assertEquals('"hello" "with" "Tabs"', $s->quote());
        $this->assertEquals('hello with Tabs', $s->unquote());
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

        $this->assertTrue($s->startsWith('Hel'));
        $this->assertTrue($s->startsWithAny(['not', 'Hel']));

        $this->assertTrue($s->endsWith('àř'));
        $this->assertFalse($s->endsWithAny(['世', 'Hel']));

        $this->assertEquals(6, $s->indexOf('世'));
        $this->assertEquals(2, $s->indexOf('l'));
        $this->assertEquals(3, $s->indexOfLast('l'));

        $s = new Str(' 世 HeLlo 世 fòôbàř');
        $this->assertEquals(2, $s->countSubstr('世'));
        $this->assertEquals(2, $s->countSubstr('l', false));
        $this->assertTrue($s->containsAll(['世', 'fòôbàř']));
        $this->assertFalse($s->containsAny(['gh', 'H2']));
        $this->assertFalse($s->startsWith('anything'));
    }

    public function testRandomFunctions()
    {
        $s = new Str('HeLlo 世 fòôbàř');
        $len = \mb_strlen((string)$s);
        $this->assertEquals($len, \mb_strlen((string)$s->shuffle()));
        $this->assertEquals($len, \mb_strlen($s->random($len, -1, (string)$s)));
        $this->assertEquals($len * 2, \mb_strlen((string)$s->appendUniqueIdentifier($len, -1, (string)$s)));
    }

    public function testRegexFunctions()
    {
        $s = new Str('fòô ');
        $this->assertEquals('bàř', $s->regexReplace('f[òô]+\s', 'bàř'));
        $this->assertTrue($s->matchesPattern('b'));
    }

    public function testHtmlFunctions()
    {
        $s = new Str('&');
        $this->assertEquals('&amp;', $s->htmlEncode());
        $this->assertEquals('&', $s->htmlDecode());
    }

    public function testArrayFunctions()
    {
        // the following two assertions are just for code coverage
        $s = new Str('');
        $this->assertEquals([], $s->langSpecificCharsArray('ru'));
        $this->assertEquals(['°', '₀', '۰', '０'], $s->charsArray()['0']);

        $s = new Str("fòô\r\nbàř");
        $this->assertEquals(['fòô', 'bàř'], $s->lines());

        $s = new Str('foo foo foo');
        $this->assertEquals(['foo', 'foo', 'foo'], $s->split(' '));

        $s = new Str('foo   foo foo');
        $this->assertEquals(['foo', 'foo', 'foo'], $s->words());
    }

    public function testComparingFunctions()
    {
        $string = new Str('ooo foo');
        $otherString = 'fo foo';
        $this->assertEquals('o foo', $string->longestCommonSubstring($otherString));
        $this->assertEquals('o foo', $string->longestCommonSuffix($otherString));
        $this->assertEquals('', $string->longestCommonPrefix($otherString));
    }
}
