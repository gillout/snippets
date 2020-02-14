<?php

require_once(ROOT_DIR . '/model/Snippet.php');
require_once(ROOT_DIR . '/model/Manager.php');

class SnippetManager extends Manager
{

    public function getOneSnippet($snippetId)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM snippet WHERE snippetId = :snippetId');
        $req->bindParam(':snippetId', $snippetId);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new Snippet());
    }

    public function getListSnippets():array
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

    public function getListSnippetsByCat($id)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('
            SELECT s.snippetId, title, code, dateCrea, comment, requirement, userId, languageId, sc.catId
                FROM snippet s JOIN snipcat sc ON s.snippetId = sc.snippetId WHERE sc.catId = :id');
        $req->bindParam(':id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($req->fetchAll() as $snippet) {
            $result[] = $this->hydrate($snippet, new Snippet);
        }
        return $result;
    }

    public function getAllByLanguageId($id)
    {
        $this->_db->exec("set names utf8");
        $req = 'SELECT s.snippetId, title, code, dateCrea, comment, requirement, userId, languageId, sc.catId
                FROM snippet s JOIN snipcat sc ON s.snippetId = sc.snippetId WHERE languageId = :id';
        $stmt = $this->_db->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objs = [];
        foreach($results as $result) {
            $objs[] = $this->hydrate($result, new Snippet);
        }
        return $objs;
    }

    public function addSnippet(Snippet $snippet)
    {
        // Préparation requête insertion
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('INSERT INTO snippet (title, code, dateCrea, comment, requirement, userId, languageId) VALUES (:title, :language, :code, :dateCrea, :comment, :requirement, :userId, :languageId)');
        // Assignation valeurs
        $title = $snippet->getTitle();
        $req->bindParam(':title', $title);
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
        $languageId = $snippet->getLanguageId();
        $req->bindParam(':languageId', $languageId);
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
            // Préparation requête update
            $this->_db->exec("set names utf8");
            $req = $this->_db->prepare('UPDATE snippet SET title=:title, code=:code, comment=:comment, requirement=:requirement, userId=:userId, languageId=:languageId WHERE snippetId=:snippetId');
            // Assignation valeurs
            $title = $snippet->getTitle();
            $req->bindParam(':title', $title);
            $code = $snippet->getCode();
            $req->bindParam(':code', $code);
            $comment = $snippet->getComment();
            $req->bindParam(':comment', $comment);
            $requirement = $snippet->getRequirement();
            $req->bindParam(':requirement', $requirement);
            $userId = $snippet->getUserId();
            $req->bindParam(':userId', $userId);
            $languageId = $snippet->getLanguageId();
            $req->bindParam(':languageId', $languageId);
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

    public function getLastSnippetByCat($id)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('
            SELECT s.snippetId, title, code, dateCrea, comment, requirement,/*userId,*/ languageId, sc.catId
                FROM snippet s JOIN snipcat sc ON s.snippetId = sc.snippetId
                    WHERE catId = :id ORDER BY s.snippetId DESC LIMIT 1');
        $req->bindParam(':id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new Snippet());
    }

    public function getLastByLanguageId($id)
    {
        $this->_db->exec("set names utf8");
        $req = 'SELECT s.snippetId, title, code, dateCrea, comment, requirement, userId, languageId, sc.catId
                    FROM snippet s JOIN snipcat sc ON s.snippetId = sc.snippetId
                    WHERE languageId = :id ORDER BY s.snippetId DESC LIMIT 1';
        $stmt = $this->_db->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->hydrate($result, new Snippet());

    }

    public function getAll(array $criteres)
    {
        // Initialisation de la requête commune à tous les cas de figure (indépendant du nombre de critères passés)
        $req = 'SELECT s.snippetId, title, code, dateCrea, comment, requirement, userId, languageId
                FROM snippet s';
        $clauses = [];
        // Si la catégorie est présente
        if ($criteres['cat'] != '') {
            // alors on ajoute une clause de WHERE
            $clauses[] = 'catId=:cat';
            // alors on ajoute une jointure
            $req .= ' JOIN snipcat sc ON s.snippetId = sc.snippetId';
        }
        // Si le language est présent
        if ($criteres['language'] != '') {
            // alors on ajoute une clause WHERE
            $clauses[] = 'languageId=:language';
        }
        // Si le keyword est présent
        if ($criteres['keyword'] != '') {
            // alors on ajoute une clause WHERE
            $clauses[] = '(title like %:keyword% OR code like %:keyword% OR comment like %:keyword%)';
        }
        // La fonction JOIN nous permet
        $clausesStr = join(" AND ", $clauses);
        $req .= (strlen($clausesStr) > 0 ) ? ' WHERE ' . $clausesStr : '';
        $stmt = $this->_db->prepare($req);
        PhpHelper::debug($req);
        foreach ($criteres as $key=>$value) {
            if ($value != '') {
                echo $key;
                $stmt->bindParam(":$key", $value);
            }
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($results);
        $objs = [];
        foreach ($results as $result) {
            $objs[] = $this->hydrate($result, new Snippet());
        }
        return $objs;
    }

}
