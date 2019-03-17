<?php


namespace jdlc\citest\model;


use Exception;

class Definition
{
    const ESPANOL = 'español';
    const KLINGON = 'klingon';
    const ACCEPTED_LANGUAGES = [self::ESPANOL, self::KLINGON];

    /** @var string */
    private $englishWord;

    /** @var string[] */
    private $translations;

    /**
     * Definition constructor.
     * @param string $englishWord
     * @param string[] $translations
     * @throws Exception
     */
    public function __construct(string $englishWord, array $translations)
    {
        $this->englishWord = $englishWord;
        foreach($translations as $language => $translation) {
            $this->addTranslation($language, $translation);
        }
    }

    /**
     * @return string
     */
    public function getEnglishWord(): string
    {
        return $this->englishWord;
    }

    /**
     * @param string $englishWord
     */
    public function setEnglishWord(string $englishWord): void
    {
        $this->englishWord = $englishWord;
    }

    /**
     * @return string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @param $language
     * @param $translation
     * @throws Exception
     */
    public function addTranslation($language, $translation)
    {
        if (in_array($language, self::ACCEPTED_LANGUAGES)) {
            $this->translations[$language] = $translation;
        } else {
            throw new Exception("Language not supported");
        }
    }

    /**
     * @param string $language
     * @return mixed|string
     * @throws Exception
     */
    public function getTranslation($language)
    {
        if (isset($this->translations[$language])) {
            return $this->translations[$language];
        } else {
            throw new Exception("This translation doesn't exists yet");
        }
    }

    public function export()
    {
        $exportData = [];
        foreach($this->translations as $language => $translation) {
            $exportData[$language] = $translation;
        }
        return $exportData;
    }
}