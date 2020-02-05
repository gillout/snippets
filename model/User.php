<?php

class User
{
    private $_userId;
    private $_name;
    private $_email;
    private $_pwd;

    // Getters
    public function getUserId()
    {
        return $this->_userId;
    }
    public function getName()
    {
        return $this->_name;
    }
    public function getEmail()
    {
        return $this->_email;
    }
    public function getPwd()
    {
        return $this->_pwd;
    }

    // Setters
    public function setUserId($userId)
    {
        $this->_userId = (int) $userId;
    }
    public function setName($name)
    {
        $this->_name = (string) $name;
    }
    public function setEmail($email)
    {
        $this->_email = (string) $email;
    }
    public function setPwd($pwd)
    {
        $this->_pwd = (string) $pwd;
    }
}
