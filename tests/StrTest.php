<?php

declare(strict_types=1);

namespace Str;

use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testGetString()
    {
        $s = new Str('Hello world');
        $this->assertEquals((string)$s, 'Hello world');
        $this->assertEquals((string)$s, $s);
        $this->assertEquals($s->getString(), 'Hello world');
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
        $this->assertFalse($s->contains('hello'));
        $this->assertFalse($s->isAlpha());
        $this->assertFalse($s->isAlphanumeric());
        $this->assertFalse($s->isBase64());
        $this->assertFalse($s->isBlank());
        $this->assertFalse($s->isHexadecimal());
        $this->assertFalse($s->isJson());
        $this->assertFalse($s->isSerialized());
        $this->assertFalse($s->isUpperCase());
        $this->assertFalse($s->isLowerCase());
        $this->assertFalse($s->hasPrefix('sdhf'));
        $this->assertFalse($s->hasSuffix('sdfjh'));

        $s = (new Str('世'))
            ->ensureLeft('Hello ')
            ->replaceWithLimit('l', 'L', 1);

        $this->assertEquals('HeLlo 世', $s);
        $this->assertTrue($s->hasPrefix('HeL'));
        $this->assertTrue($s->hasSuffix('世'));
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
        $this->assertFalse($s->isEmail());

        $s = new Str('HeL世');
        $this->assertEquals([' ','H','e','L','世'],
            $s
            ->prepend(' ')
            ->chars()
        );

        $this->assertCount(5, $s->chars());
        $this->assertEquals(5, $s->length());
        $this->assertEquals(\count($s->chars()), $s->length());

        $s = new Str('n世');
        $this->assertTrue($s->toBoolean());

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
        $this->assertEquals('Önnekİş', $s->stripWhitespace());
        $this->assertEquals('önnekiş', $s->toLowerCase());
        $this->assertTrue($s->hasPrefix('ön'));
        $this->assertEquals('ö', $s->at(0));

        $s = new Str('hello world');
        $this->assertEquals('Hello world', $s->upperCaseFirst());
        $this->assertEquals('hello world', $s->lowerCaseFirst());

        $s = new Str('fòôbàř');
        $this->assertEquals('FÒÔBÀŘ', $s->toUpperCase());
        $this->assertEquals('fòôbàř', $s->toLowerCase());
        $this->assertEquals('Fòôbàř', $s->upperCaseFirst());
        $this->assertEquals('fòôbàř', $s->lowerCaseFirst());
        $this->assertEquals('fòhuôbàř', $s->insert('hu', 2));
        $this->assertEquals('huôbàř', $s->removeLeft('fò'));
        $this->assertEquals('huôb', $s->removeRight('àř'));
        $this->assertEquals('huôbhuôb', $s->repeat(2));
        $this->assertEquals('bôuhbôuh', $s->reverse());
        $this->assertEquals('Bôuhbôuh', $s->upperCaseFirst());
        $this->assertEquals('bôuhbôuh', $s->lowerCaseFirst());
        $this->assertEquals('BÔUHBÔUH', $s->swapCase());

        $s = new Str('fòô bàř');
        $this->assertEquals('fòôBàř', $s->camelize());
        $this->assertEquals('fòô-bàř', $s->dasherize());
        $this->assertEquals('FòôBàř', $s->upperCamelize());
        $this->assertEquals('duh_FòôBàřduh_', $s->surround('duh_'));
        $this->assertEquals('duh_fòôbàřduh', $s->snakeize());
        $this->assertEquals('duh_fusrodah_fòôbàřduh', $s->afterFirst('uh', '_fusrodah'));
        $this->assertEquals('duh_duh_fusrodah_fòôbàřduh', $s->beforeFirst('uh', 'uh_d'));
        $this->assertEquals('duh_duh_fusrodah_fòôbàřduh?', $s->afterLast('uh', '?'));
        $this->assertEquals('duh_duh_fusrodah_fòôbàřduh??', $s->beforeLast('?', '?'));

        $s = new Str('author');
        $this->assertEquals('Author', $s->humanize());
        $this->assertEquals('aUTHOR', $s->swapCase());
        $this->assertEquals('U', $s->at(1));

        $s = new Str('authôr');
        $this->assertEquals('Authôr', $s->humanize());
        $this->assertEquals('aUTHÔR', $s->swapCase());

        $s = new Str('Hello 世 fòôbàř');
        $this->assertEquals('He', $s->first(2));
        $this->assertEquals('', $s->first(0));

        $s = new Str('Hello 世 fòôbàř');
        $this->assertEquals('bàř', $s->last(3));
        $this->assertEquals('', $s->last(-1));

        $s = new Str('fòô');
        $this->assertEquals('   fòô   ', $s->padBoth(9));
        $this->assertEquals('bàř   fòô   ', $s->padLeft(12, 'bàř'));
        $this->assertEquals('bàř   fòô   bàř', $s->padRight(15, 'bàř'));
        $this->assertEquals('bàbàř   fòô   bàřbà', $s->padBoth(19, 'bàř'));
        $this->assertEquals('bàbàř fòô bàřbà', $s->collapseWhitespace());
        $this->assertEquals('bàbàř*fòô*bàřbà', $s->delimit('*'));
        $this->assertEquals('bàř*fòô*bàřbà', $s->substr(2));
        $this->assertEquals('ř*fòô*bà', $s->between('bà', 'řbà'));
        $this->assertEquals('ř*fòô*bà', $s->truncate(20, 'i'));

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
        $this->assertEquals('Booo', $s->ensureLeft('Bo'));
        $this->assertEquals('BoooBo', $s->ensureRight('Bo'));
        $this->assertEquals('HeyBo', $s->replace('Booo', 'Hey'));
        $this->assertEquals('heybo', $s->toLowerCase());
        $this->assertEquals('HEYBO', $s->toUpperCase());
        $this->assertEquals('huhHEYBOhuh', $s->padBoth(11, 'huh'));
        $this->assertEquals('huhuhHEYBOhuh', $s->padLeft(13, 'hu'));
        $this->assertEquals('huhuhHEYBOhuhuh', $s->padRight(15, 'uh'));
        $this->assertEquals('huhuh_h_e_y_b_ohuhuh', $s->delimit('_'));

        $s = new Str('b-oob-oò');
        $this->assertEquals('booò', $s->safeTruncate(4, 'ooò'));

        $s = new Str('fòò and other stuff');
        $this->assertEquals('foo-and-other-stuff', $s->slugify());

        $s = new Str('fòò and other stuff');
        $this->assertEquals('fòò_and_other_stuff', $s->underscored());
        $this->assertEquals('òòf_and_other_stuff', $s->move(0, 1, 3));

        $s = new Str('foo foo   foo');
        $this->assertEquals('foo foo foo', $s->collapseWhitespace());
        $this->assertEquals('h foo foo', $s->overwrite(0, 3, 'h'));
        $this->assertEquals('"h" "foo" "foo"', $s->quote());

        $s = new Str(' foo bar ');
        $this->assertEquals('foo bar', $s->trim());
        $this->assertEquals('oo bar', $s->trimLeft('f'));
        $this->assertEquals('oo ba', $s->trimRight('r'));
        $this->assertEquals('oo bar baz', $s->append('r baz'));
        $this->assertEquals('foo foo bar baz', $s->prepend('foo f'));

        $s = new Str('{foo} and {bar}');
        $this->assertEquals('bar', $s->between('{', '}', 1));
        $this->assertEquals('__bar__', $s->surround('__'));

        $s = new Str('foo and other stuff');
        $this->assertEquals('foo-and-other-stuff', $s->slugify());
        $this->assertEquals('foo_and_other_stuff', $s->underscored());

        $s = new Str('fòôbàř');
        $this->assertEquals('òôbàř', $s->slice(1));
        $this->assertEquals('oobar', $s->toAscii());
        $this->assertEquals('obar', $s->slice(1));
        $this->assertEquals(4, $s->length());

        $s = new Str('"fòôbàř"');
        $this->assertEquals('fòôbàř', $s->unquote());
        $this->assertEquals('fòôbàř#hey#ho', $s->join('#', ['hey', 'ho']));
        $this->assertEquals('fòôbàř', $s->shift('#'));
        $this->assertEquals('ôbàř', $s->shiftReversed('ò'));
        $this->assertEquals('àř', $s->pop('b'));
        $this->assertEquals('à', $s->popReversed('ř'));

        $s = new Str('fòô bàř');
        $this->assertEquals('Fòô Bàř', $s->titleize());

        $s = new Str('str with     whitespace ');
        $this->assertEquals('strwithwhitespace', $s->stripWhitespace());
        $this->assertEquals('Strwithwhitespace', $s->upperCamelize());
        $this->assertEquals('rwStithwhitespace', $s->move(0, 2, 4));
        $this->assertEquals('rw_stithwhitespace', $s->snakeize());
        $this->assertEquals('rw_stit_here!_hwhitespace', $s->afterFirst('it', '_here!_'));
        $this->assertEquals('rw_stit_h_here!_ere!_hwhitespace', $s->beforeFirst('e', '_here!_'));
        $this->assertEquals('rw_stit_h_here!_ere!_hwhit_ttt!_espace', $s->afterLast('t', '_ttt!_'));
        $this->assertEquals('rw_stit_h_here!_ere!_hwhit_tt_morett!_t!_espace', $s->beforeLast('t', '_morett!_'));
        $this->assertEquals('rw_stit_h_here', $s->shift('!'));
        $this->assertEquals('_stit_h_here', $s->shiftReversed('w'));
        $this->assertEquals('_stit_h_he', $s->popReversed('r'));
        $this->assertEquals('_h_he', $s->pop('t'));

        $s = new Str('I see…');
        $this->assertEquals('I see...', $s->tidy());
        $this->assertEquals('I see...', $s->tidy());
        $this->assertEquals('I See...', $s->titleize());

        $s = new Str("\t\tstr\twith tabs");
        $this->assertEquals('strwith tabs', $s->toSpaces(0));
        $this->assertEquals("strwith\ttabs", $s->toTabs(1));
        $this->assertEquals("Strwith\tTabs", $s->toTitleCase());
        $this->assertEquals("hello with\tTabs", $s->overwrite(0, 3, 'hello '));
        $this->assertEquals('"hello" "with" "Tabs"', $s->quote());
        $this->assertEquals('hello with Tabs', $s->unquote());
        $this->assertEquals('hello with Tabs@other@oie', $s->join('@', ['other', 'oie']));
        $this->assertEquals('oie', $s->last(3));

        $s = new Str("\t\tstr\twith tàbs");
        $this->assertEquals('strwith tàbs', $s->toSpaces(0));
        $this->assertEquals("strwith\ttàbs", $s->toTabs(1));
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

        $s = new Str('hello');
        $this->assertEquals(1, $s->indexOf('e'));
        $this->assertEquals(3, $s->indexOfLast('l'));
        $this->assertEquals(1, $s->countSubstr('lo'));
        $this->assertTrue($s->containsAll(['e', 'lo']));
        $this->assertTrue($s->containsAny(['egh', 'lo']));
        $this->assertTrue($s->startsWith('hel'));
        $this->assertTrue($s->startsWithAny(['not', 'hel']));
        $this->assertTrue($s->endsWith('o'));
        $this->assertTrue($s->endsWithAny(['fdg', 'lo']));
        $this->assertTrue($s->hasLowerCase());
        $this->assertFalse($s->hasUpperCase());
    }

    public function testRandomFunctions()
    {
        $s = new Str('HeLlo 世 fòôbàř');
        $len = \mb_strlen((string)$s);
        $this->assertEquals($len, \mb_strlen((string)$s->shuffle()));
        $this->assertEquals($len, \mb_strlen((string)$s->random($len, -1, (string)$s)));
        $this->assertEquals($len * 2, \mb_strlen((string)$s->appendUniqueIdentifier($len, -1, (string)$s)));
    }

    public function testRegexFunctions()
    {
        $s = new Str('fòô ');
        $this->assertEquals('bàř', $s->regexReplace('f[òô]+\s', 'bàř'));
        $this->assertTrue($s->matchesPattern('b'));

        $s = new Str('foo ');
        $this->assertEquals('bar', $s->regexReplace('f[o]+\s', 'bar'));
        $this->assertTrue($s->matchesPattern('b'));
    }

    public function testHtmlFunctions()
    {
        $s = new Str('&');
        $this->assertEquals('&amp;', $s->htmlEncode());
        $this->assertEquals('&', $s->htmlDecode());

        $s = new Str('&òô');
        $this->assertEquals('&òô', $s->htmlDecode());
        $this->assertEquals('&amp;&ograve;&ocirc;', $s->htmlEncode());
    }

    public function testArrayFunctions()
    {
        $s = new Str("fòô\r\nbàř");
        $this->assertEquals(['fòô', 'bàř'], $s->lines());

        $s = new Str('foo foo foo');
        $this->assertEquals(['foo', 'foo', 'foo'], $s->split(' '));

        $s = new Str('foo   foo foo');
        $this->assertEquals(['foo', 'foo', 'foo'], $s->words());

        $s = new Str('foo   foo foo');
        $this->assertEquals(['fo', 'o ', '  ', 'fo', 'o ', 'fo', 'o'], $s->chop(2));

        $s = new Str('hello');
        $this->assertEquals(['h', 'e', 'l', 'l', 'o'], $s->chars());

        $s = new Str("foo\nboo");
        $this->assertEquals(['foo', 'boo'], $s->lines());

        $s = new Str('fòo foo foo');
        $this->assertEquals(['fòo', 'foo', 'foo'], $s->split(' '));

        $s = new Str('fòo   foo foo');
        $this->assertEquals(['fòo', 'foo', 'foo'], $s->words());

        $s = new Str('fòo   foo foo');
        $this->assertEquals(['fò', 'o ', '  ', 'fo', 'o ', 'fo', 'o'], $s->chop(2));
    }

    public function testComparingFunctions()
    {
        $string = new Str('ooo foo');
        $otherString = 'fo foo';
        $this->assertEquals('o foo', $string->longestCommonSubstring($otherString));
        $this->assertEquals('o foo', $string->longestCommonSuffix($otherString));
        $this->assertEquals('', $string->longestCommonPrefix($otherString));

        $string = new Str('ooo foô');
        $otherString = 'fo foô';
        $this->assertEquals('o foô', $string->longestCommonSubstring($otherString));
        $this->assertEquals('o foô', $string->longestCommonSuffix($otherString));
        $this->assertEquals('', $string->longestCommonPrefix($otherString));
    }
}
