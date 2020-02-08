<?php

require_once(ROOT_DIR . '/model/UserManager.php');
require_once(ROOT_DIR . '/model/CatManager.php');
require_once(ROOT_DIR . '/model/SnippetManager.php');
require_once(ROOT_DIR . '/model/SnippetDto.php');

class SnippetService
{
    private $_userManager;
    private $_catManager;
    private $_snippetManager;

    public function __construct(PDO $db)
    {
        $this->_userManager = new UserManager($db);
        $this->_catManager = new CatManager($db);
        $this->_snippetManager = new SnippetManager($db);
    }

    public function findById($id)
    {
        $snippet = $this->_snippetManager->getOneSnippet($id);
        $result = new SnippetDto();
        $result->setSnippetId($snippet->getSnippetId());
        $result->setTitle($snippet->getTitle());
        $result->setLanguage($snippet->getLanguage());
        $result->setCode($snippet->getCode());
        $result->setDateCrea($snippet->getDateCrea());
        $result->setComment($snippet->getComment());
        $result->setRequirement($snippet->getRequirement());
        $user = $this->_userManager->getOneUser($snippet->getUserId());
        $cat = $this->_catManager->getOneCat($snippet->getCatId());
        $result->setUser($user);
        $result->setCat($cat);
        return $result;
    }
    public function findLast()
    {
        $snippet = $this->_snippetManager->getLastSnippet();
        return $this->findById($snippet->getSnippetId());
    }

}
