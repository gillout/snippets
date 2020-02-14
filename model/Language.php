<?php

class Language
{
    /**
     * @var int
     */
    private $_languageId;
    /**
     * @var string
     */
    private $_label;

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return $this->_languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId(int $languageId)
    {
        $this->_languageId = $languageId;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->_label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->_label = $label;
    }

}
