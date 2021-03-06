<?php

require_once(ROOT_DIR . '/model/UserManager.php');
require_once(ROOT_DIR . '/model/CatManager.php');
require_once(ROOT_DIR . '/model/LanguageManager.php');
require_once(ROOT_DIR . '/model/SnippetManager.php');
require_once(ROOT_DIR . '/model/SnippetDto.php');

class SnippetService
{
    private $_userManager;
    private $_languageManager;
    private $_catManager;
    private $_snippetManager;

    public function __construct(PDO $db)
    {
        $this->_userManager = new UserManager($db);
        $this->_languageManager = new LanguageManager($db);
        $this->_catManager = new CatManager($db);
        $this->_snippetManager = new SnippetManager($db);
    }

    public function findById($id):SnippetDto
    {
        $snippet = $this->_snippetManager->getOne($id);
        return $this->mapToDto($snippet);
    }
    public function findLast(array $criteres)
    {
        $snippet = $this->_snippetManager->getLast($criteres);
        return $this->findById($snippet->getSnippetId());
    }
    public function getList():array
    {
        $snippets = $this->_snippetManager->getAll();
        $resultDto = [];
        foreach ($snippets as $snippet) {
            $snippetDto = $this->mapToDto($snippet);
            $resultDto[] = $snippetDto;
         }
        return $resultDto;
    }

    public function getOne($id):?SnippetDto
    {
        $snippet = $this->_snippetManager->getOne($id);
        $snippetDto = $this->mapToDto($snippet);
        return $snippetDto;
    }

    /**
     * @param Snippet $snippet
     * @return SnippetDto
     */
    private function mapToDto(Snippet $snippet): SnippetDto
    {
        $snippetDto = new SnippetDto();
        $snippetDto->setSnippetId($snippet->getSnippetId());
        $snippetDto->setTitle($snippet->getTitle());
        $snippetDto->setCode($snippet->getCode());
        $snippetDto->setDateCrea($snippet->getDateCrea());
        $snippetDto->setComment($snippet->getComment());
        $snippetDto->setRequirement($snippet->getRequirement());
        $user = $this->_userManager->getOneUser($snippet->getUserId());
        $snippetDto->setUser($user);
        $language = $this->_languageManager->getOneLanguage($snippet->getLanguageId());
        $snippetDto->setLanguage($language);
        $cats = $this->_catManager->getCatsBySnippetId($snippet->getSnippetId());
        $snippetDto->setCats($cats);
        return $snippetDto;
    }

    public function findAll(array $criteres):array
    {
        // Récupérer tous les snippets
        $snippets = $this->_snippetManager->getAll($criteres);
        // Transformer les snippets en snippetDto
        $snippetsDto = [];
        foreach ($snippets as $snippet) {
               $snippetsDto[] = $this->mapToDto($snippet);
        }
        return $snippetsDto;
    }

}
