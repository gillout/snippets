<?php

require_once(ROOT_DIR . '/model/Language.php');
require_once(ROOT_DIR . '/model/Manager.php');

class LanguageManager extends Manager
{

    public function getOneLanguage($id)
    {
        $this->_db->exec("set names utf8");
        $req = 'SELECT * FROM language WHERE languageId = :id';
        $stmt = $this->_db->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->hydrate($result, new Language);
    }

    public function getList()
    {
        $this->_db->exec("set names utf8");
        $req = 'SELECT * FROM language';
        $stmt = $this->_db->query($req);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objs = [];
        foreach($results as $result) {
            $objs[] = $this->hydrate($result, new Language);
        }
        return $objs;
    }

    public function addLanguage(Language $language)
    {
        $this->_db->exec("set names utf8");
        $req = 'INSERT INTO language (label) VALUES (:label)';
        $stmt = $this->_db->prepare($req);
        $label = $language->getLabel();
        $stmt->bindParam(':label', $label);
        if ($stmt->execute()) {
            $id = $this->_db->lastInsertId();
            return $this->getOneLanguage($id);
        }
        return null;
    }

    public function delLanguage($id)
    {
        $req = 'DELETE FROM language WHERE languageId = :languageId';
        $stmt = $this->_db->prepare($req);
        $stmt->bindParam(':languageId', $id);
        return $stmt->execute();
    }

    public function updLanguage(Language $language)
    {
        $this->_db->exec("set names utf8");
        $req = 'UPDATE language SET label=:label WHERE languageId=:languageId';
        $stmt = $this->_db->prepare($req);
        $label = $language->getLabel();
        $stmt->bindParam(':label', $label);
        $languageId = $language->getLanguageId();
        $stmt->bindParam(':languageId', $languageId);
        if ($stmt->execute()) {
            return $this->getOneLanguage($languageId);
        }
        return null;
    }

}
