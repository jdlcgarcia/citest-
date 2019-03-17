<?php


use jdlc\citest\model\Definition;
use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
    public function testCreateHappyPath1Word()
    {
        $englishWord = "Hello";
        $spanishWord = "Hola";
        $translations = [Definition::ESPANOL => $spanishWord];
        try {
            $d = new Definition($englishWord, $translations);
            $this->assertEquals($d->getEnglishWord(), $englishWord);
            $this->assertEquals($d->getTranslations(), $translations);
            $this->assertEquals($d->getTranslation(Definition::ESPANOL), $spanishWord);
        } catch (Exception $e) {
        }
    }

    public function testCreateHappyPath2Words()
    {
        $englishWord = "Hello";
        $spanishWord = "Hola";
        $klingonWord = "nuqneH";
        $translations = [Definition::ESPANOL => $spanishWord, Definition::KLINGON => $klingonWord];
        try {
            $d = new Definition($englishWord, $translations);
            $this->assertEquals($d->getEnglishWord(), $englishWord);
            $this->assertEquals($d->getTranslations(), $translations);
            $this->assertEquals($d->getTranslation(Definition::ESPANOL), $spanishWord);
            $this->assertEquals($d->getTranslation(Definition::KLINGON), $klingonWord);
        } catch (Exception $e) {
        }
    }

    public function testCreateUnknownLanguage()
    {
        $englishWord = "Hello";
        $andalusianWord = "Killo qué";
        $andalusianKey = "Andalusian";
        $translations = [$andalusianKey => $andalusianWord];
        $this->expectException(Exception::class);
        $d = new Definition($englishWord, $translations);

    }

    public function testGettingUntranslatedLanguage()
    {
        $englishWord = "Hello";
        $spanishWord = "Hola";
        $klingonWord = "nuqneH";
        $translations = [Definition::ESPANOL => $spanishWord];
        try {
            $d = new Definition($englishWord, $translations);
        } catch (Exception $e) {
        }
        $this->expectException(Exception::class);
        $this->assertEquals($d->getTranslation(Definition::KLINGON), $klingonWord);
    }

    public function testExport()
    {
        $englishWord = "Hello";
        $spanishWord = "Hola";
        $klingonWord = "nuqneH";
        $expectedOutput = [
            Definition::ESPANOL => $spanishWord,
            Definition::KLINGON => $klingonWord
        ];
        $translations = [Definition::KLINGON => $klingonWord, Definition::ESPANOL => $spanishWord];
        try {
            $d = new Definition($englishWord, $translations);
            $this->assertEquals($expectedOutput, $d->export());
        } catch (Exception $e) {
        }
    }
}