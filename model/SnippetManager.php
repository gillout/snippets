<?php

require_once(ROOT_DIR . '/model/Snippet.php');

class SnippetManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->_db = $db;
    }

    private function hydrate(array $data, Snippet $obj):Snippet
    {
        foreach ($data as $key=>$value) { // => [snippetId][title][language][code][dateCrea][comment][requirement][userId][catId]
            $method = "set" . ucfirst($key); // setSnippetId, setTitle, setLanguage, setCode, setDateCrea, setComment, setRequirement, setUserId, setCatId
            $obj->$method($value);
        }
        return $obj;
    }

    public function getOneSnippet($snippetId)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM snippet WHERE snippetId = :snippetId');
        $req->bindParam(':snippetId', $snippetId);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new Snippet());
    }

    public function getListSnippets()
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM snippet');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($req->fetchAll() as $snippet) {
            $result[] = $this->hydrate($snippet, new Snippet);
        }
        return $result;
    }

    public function addSnippet(Snippet $snippet)
    {
        // Préparation requête insertion
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('INSERT INTO snippet (title, language, code, dateCrea, comment, requirement, userId) VALUES (:title, :language, :code, :dateCrea, :comment, :requirement, :userId)');
        // Assignation valeurs
        $title = $snippet->getTitle();
        $req->bindParam(':title', $title);
        $language = $snippet->getLanguage();
        $req->bindParam(':language', $language);
        $code = $snippet->getCode();
        $req->bindParam(':code', $code);
        $dateCrea = $snippet->getDateCrea();
        $req->bindParam(':dateCrea', $dateCrea);
        $comment = $snippet->getComment();
        $req->bindParam(':comment', $comment);
        $requirement = $snippet->getRequirement();
        $req->bindParam(':requirement', $requirement);
        $userId = $snippet->getUserId();
        $req->bindParam(':userId', $userId);
        // Exécution requête
        if ($req->execute()) {
            $id = $this->_db->lastInsertId();
            return $this->getOneSnippet($id);
        }
        return null;
    }

    public function delSnippet($id)
    {
        $req = $this->_db->prepare('DELETE FROM snippet WHERE snippetId = :snippetId');
        $req->bindParam(':snippetId', $id);
        $req->execute();
        return $req->rowCount();
    }

    public function updSnippet(Snippet $snippet)
    {
        try {
            echo '<pre>';
            var_dump($snippet);
            echo '</pre>';
            // Préparation requête update
            $this->_db->exec("set names utf8");
            $req = $this->_db->prepare('UPDATE snippet SET title=:title, language=:language, code=:code, comment=:comment, requirement=:requirement, userId=:userId WHERE snippetId=:snippetId');
            // Assignation valeurs
            $title = $snippet->getTitle();
            $req->bindParam(':title', $title);
            $language = $snippet->getLanguage();
            $req->bindParam(':language', $language);
            $code = $snippet->getCode();
            $req->bindParam(':code', $code);
            $comment = $snippet->getComment();
            $req->bindParam(':comment', $comment);
            $requirement = $snippet->getRequirement();
            $req->bindParam(':requirement', $requirement);
            $userId = $snippet->getUserId();
            $req->bindParam(':userId', $userId);
            $snippetId = $snippet->getSnippetId();
            $req->bindParam(':snippetId', $snippetId);
            echo '=================';
            echo $snippetId . ' ' . $userId;
            // Exécution requête
            if ($req->execute()) {
                return $this->getOneSnippet($snippetId);
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getLastSnippet()
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM snippet ORDER BY snippetId DESC LIMIT 1');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new Snippet());
    }
}
