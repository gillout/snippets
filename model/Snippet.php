<?php

class Snippet
{
    private $_snippetId;
    private $_title;
    private $_language;
    private $_code;
    private $_dateCrea;
    private $_comment;
    private $_requirement;
    private $_userId;

    // Getters
    public function getSnippetId()
    {
        return $this->_snippetId;
    }
    public function getTitle()
    {
        return $this->_title;
    }
    public function getLanguage()
    {
        return $this->_language;
    }
    public function getCode()
    {
        return $this->_code;
    }
    public function getDateCrea()
    {
        return $this->_dateCrea;
    }
    public function getComment()
    {
        return $this->_comment;
    }
    public function getRequirement()
    {
        return $this->_requirement;
    }
    public function getUserId()
    {
        return $this->_userId;
    }

    // Setters
    public function setSnippetId($snippetId)
    {
        $this->_snippetId = $snippetId;
    }
    public function setTitle($title)
    {
        $this->_title = (string) $title;
    }
    public function setLanguage($language)
    {
        $this->_language = (string) $language;
    }
    public function setCode($code)
    {
        $this->_code = (string) $code;
    }
    public function setDateCrea($dateCrea)
    {
        $this->_dateCrea = $dateCrea;
    }
    public function setComment($comment)
    {
        $this->_comment = (string) $comment;
    }
    public function setRequirement($require)
    {
        $this->_requirement = (string) $require;
    }
    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }
}
