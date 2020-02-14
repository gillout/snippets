<?php

class SnippetDto
{
    private $_snippetId;
    private $_title;
    private $_code;
    private $_dateCrea;
    private $_comment;
    private $_requirement;
    private $_user;
    private $_cats = [];
    private $_language;

    /**
     * @return mixed
     */
    public function getSnippetId()
    {
        return $this->_snippetId;
    }

    /**
     * @param mixed $snippetId
     */
    public function setSnippetId($snippetId)
    {
        $this->_snippetId = $snippetId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->_language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }

    /**
     * @return mixed
     */
    public function getDateCrea()
    {
        return $this->_dateCrea;
    }

    /**
     * @param mixed $dateCrea
     */
    public function setDateCrea($dateCrea)
    {
        $this->_dateCrea = $dateCrea;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->_comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getRequirement()
    {
        return $this->_requirement;
    }

    /**
     * @param mixed $requirement
     */
    public function setRequirement($requirement)
    {
        $this->_requirement = $requirement;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return mixed
     */
    public function getCats()
    {
        return $this->_cats;
    }

    /**
     * @param mixed $cats
     */
    public function setCats($cats)
    {
        $this->_cats = $cats;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->_language;
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages)
    {
        $this->_language = $languages;
    }
}
