<?php

require_once(ROOT_DIR . '/model/Snippet.php');
require_once(ROOT_DIR . '/model/Manager.php');

class SnippetManager extends Manager
{

    public function getOne($snippetId)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM snippet WHERE snippetId = :snippetId');
        $req->bindParam(':snippetId', $snippetId);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new Snippet());
    }

    public function add(Snippet $snippet)
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
            return $this->getOne($id);
        }
        return null;
    }

    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM snippet WHERE snippetId = :snippetId');
        $req->bindParam(':snippetId', $id);
        $req->execute();
        return $req->rowCount();
    }

    public function update(Snippet $snippet)
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
                return $this->getOne($snippetId);
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getLast(array $criteres):Snippet
    {
        $req = $this->buildSelectQueryWithCriteria($criteres);
        $req .= ' ORDER BY s.snippetId DESC LIMIT 1';
        $stmt = $this->_db->prepare($req);
        $stmt->execute($criteres);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->hydrate($result, new Snippet());
    }

    public function getAll(array $criteres=[])
    {
        $req = $this->buildSelectQueryWithCriteria($criteres);
        $stmt = $this->_db->prepare($req);
        $stmt->execute($criteres); // Execute peut prendre un tableau associatif en paramètres pour "binder" les paramètres SQL (:param)
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objs = [];
        foreach ($results as $result) {
            $objs[] = $this->hydrate($result, new Snippet());
        }
        return $objs;
    }

    /**
     * @param array $criteres
     * @return array
     */
    private function buildSelectQueryWithCriteria(array & $criteres): string
    {
// Initialisation de la requête commune à tous les cas de figure (indépendant du nombre de critères passés)
        $req = 'SELECT s.snippetId, s.title, s.code, s.dateCrea, s.comment, s.requirement, s.userId, s.languageId FROM snippet s';
        $clauses = [];
        // Si la catégorie est présente
        if (array_key_exists('cat', $criteres)) {
            // alors on ajoute une clause de WHERE
            $clauses[] = 'sc.catId=:cat';
            // alors on ajoute une jointure
            $req .= ' JOIN snipcat sc ON s.snippetId = sc.snippetId';
        }
        // Si le language est présent
        if (array_key_exists('language', $criteres)) {
            // alors on ajoute une clause WHERE
            $clauses[] = 's.languageId=:language';
        }
        // Si le keyword est présent
        if (array_key_exists('keyword', $criteres)) {
            // alors on ajoute une clause WHERE
            $clauses[] = '(s.title like :keyword OR s.code like :keyword OR s.comment like :keyword)';
            $criteres['keyword'] = '%' . $criteres['keyword'] . '%';
        }
        // La fonction JOIN nous permet
        $clausesStr = join(" AND ", $clauses);
        $req .= (strlen($clausesStr) > 0) ? ' WHERE ' . $clausesStr : '';
        return $req;
    }

}
