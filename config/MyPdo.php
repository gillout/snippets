<?php

class MyPdo extends PDO
{
    private $_sgbd = 'mysql';
    private $_bdd = 'snippets';
    private $_host = 'localhost';
    private $_user = 'snipper';
    private $_password = 'password';
    // private static $_instance; // Variable de classe

    public function __construct()
    {
        $sgbdHost = $this->_sgbd . ':dbname=' . $this->_bdd . ';host=' . $this->_host;
        parent::__construct($sgbdHost, $this->_user, $this->_password);
    }

    /*
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new MyPdoSingleton();
        }
        return self::$_instance;
    }
    */

}

