<?php

require_once(ROOT_DIR . '/model/Cat.php');
require_once(ROOT_DIR . '/model/Manager.php');

class CatManager extends Manager
{

    public function getOneCat($catId)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM cat WHERE catId = :catId');
        $req->bindParam(':catId', $catId);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new Cat());
    }

    public function getListCats()
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM cat');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($req->fetchAll() as $cat) {
            $result[] = $this->hydrate($cat, new Cat);
        }
        return $result;
    }

    public function addCat(Cat $cat)
    {
        // Préparation requête insertion
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('INSERT INTO cat (label) VALUES (:label)');
        // Assignation valeurs
        $label = $cat->getLabel();
        $req->bindParam(':label', $label);
        // Exécution requête
        if ($req->execute()) {
            $id = $this->_db->lastInsertId();
            return $this->getOneCat($id);
        }
        return null;
    }

    public function delCat($id)
    {
        $req = $this->_db->prepare('DELETE FROM cat WHERE catId = :catId');
        $req->bindParam(':catId', $id);
        return $req->execute();
    }

    public function updCat(Cat $cat)
    {
        // Préparation requête update
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('UPDATE cat SET label=:label WHERE catId=:catId');
        // Assignation valeurs
        $label = $cat->getLabel();
        $req->bindParam(':label', $label);
        $catId = $cat->getCatId();
        $req->bindParam(':catId', $catId);
        // Exécution requête
        if ($req->execute()) {
            return $this->getOneCat($catId);
        }
        return null;
    }

    public function getCatsBySnippetId($id)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT c.catId, c.label FROM cat c JOIN snipcat sc ON sc.catId = c.catId WHERE sc.snippetId = :id');
        $req->bindParam(':id', $id);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->execute();
        $result = [];
        foreach ($req->fetchAll() as $cat) {
            $result[] = $this->hydrate($cat, new Cat);
        }
        return $result;
    }
}
