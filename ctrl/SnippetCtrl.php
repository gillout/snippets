<?php

require_once(ROOT_DIR . '/config.php');
require_once(ROOT_DIR . '/PhpHelper.php');
require_once(ROOT_DIR . '/model/UserManager.php');
require_once(ROOT_DIR . '/model/CatManager.php');
require_once(ROOT_DIR . '/model/LanguageManager.php');
require_once(ROOT_DIR . '/model/SnippetManager.php');
require_once(ROOT_DIR . '/config/MyPdo.php');
require_once(ROOT_DIR . '/service/SnippetService.php');

class SnippetCtrl
{
    private $_userManager;
    private $_catManager;
    private $_languageManager;
    private $_snippetManager;
    private $_snippetService;

    public function __construct()
    {
        $db = new MyPdo();
        $this->_userManager = new UserManager($db);
        $this->_catManager = new CatManager($db);
        $this->_languageManager = new LanguageManager($db);
        $this->_snippetManager = new SnippetManager($db);
        $this->_snippetService = new SnippetService($db);
    }

    public function getOne($id) {
        $cats = $this->_catManager->getListCats();
        $languages = $this->_languageManager->getList();
        if (isset($_GET ['cat'])) {
            $snippetsDto = $this->_snippetService->findAll([ 'cat' => $_GET['cat'] ]);
        } else {
            $snippetsDto = $this->_snippetService->getList();
        }
        $snippetDto = $this->_snippetService->findById($id);
        require(ROOT_DIR . '/view/oneSnippetView.php');
    }
    public function add() {
        if (isset($_POST['validate'])) {
            $snippet = new Snippet();
            $snippet->setTitle($_POST['title']);
            $snippet->setCode(htmlentities($_POST['code']));
            $snippet->setDateCrea(date("Y-m-d H:i:s"));
            $snippet->setComment($_POST['comment']);
            $snippet->setRequirement($_POST['requirement']);
            $snippet->setUserId($_POST['userId']);
            $snippet->setLanguageId($_POST['languageId']);
            $snippet = $this->_snippetManager->add($snippet);
            header('location: ?action=oneSnippet&id=' . $snippet->getSnippetId());
        } else {
            $users = $this->_userManager->getListUsers();
            $cats = $this->_catManager->getListCats();
            $languages = $this->_languageManager->getList();
            $snippetsDto = $this->_snippetService->getList();
            require(ROOT_DIR . '/view/addUpdSnippetView.php');
        }
    }
    public function delete($id)
    {
        $deleted = $this->_snippetManager->delete($id);
        $cats = $this->_catManager->getListCats();
        $languages = $this->_languageManager->getList();
        $snippetsDto = $this->_snippetService->getList();
        $snippetDto = $this->_snippetService->findLast();
        require(ROOT_DIR . '/view/oneSnippetView.php');
    }
    public function update($id) {
        if (isset($_POST['validate'])) {
            $snippet = new Snippet();
            $snippet->setSnippetId($_POST['snippetId']);
            $snippet->setTitle($_POST['title']);
            $snippet->setCode(htmlentities($_POST['code']));
            $snippet->setComment(htmlentities($_POST['comment']));
            $snippet->setRequirement(htmlentities($_POST['requirement']));
            $snippet->setUserId($_POST['userId']);
            $snippet->setLanguageId($_POST['languageId']);
            $snippet = $this->_snippetManager->update($snippet);
            if (!is_null($snippet)) {
                header('location: ?action=oneSnippet&id=' . $snippet->getSnippetId());
            } else {
                PhpHelper::debug($_POST);
            }

        } else {
            $users = $this->_userManager->getListUsers();
            $cats = $this->_catManager->getListCats();
            $languages = $this->_languageManager->getList();
            $snippetsDto = $this->_snippetService->getList();
            $snippetDto = $this->_snippetService->getOne($id);
            require(ROOT_DIR . '/view/addUpdSnippetView.php');
        }
    }
    public function getLast() {
        // Url : http://localhost:8001/?language=1&cat=2&keyword=test => [language => 1, cat => 2, keyword => 'test']
        $criteres = [];
        if (array_key_exists('language', $_GET) && $_GET['language'] != '') {
            $criteres['language'] = $_GET['language'];
        }
        if (array_key_exists('cat', $_GET) && $_GET['cat'] != '') {
            $criteres['cat'] = $_GET['cat'];
        }
        if (array_key_exists('keyword', $_GET) && $_GET['keyword'] != '') {
            $criteres['keyword'] = $_GET['keyword'];
        }
        $cats = $this->_catManager->getListCats();
        $languages = $this->_languageManager->getList();
        // Récupère tous les snippetsDto en fonction des critères
        $snippetsDto = $this->_snippetService->findAll($criteres);
        // Récupère le dernier snippetDto en fonction des critères
        $snippetDto = $this->_snippetService->findLast($criteres);
        require(ROOT_DIR . '/view/oneSnippetView.php');
    }
}
