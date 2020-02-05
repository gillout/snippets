<?php

require_once(ROOT_DIR . '/config.php');
require_once(ROOT_DIR . '/model/SnippetManager.php');
require_once(ROOT_DIR . '/config/MyPdo.php');
require_once(ROOT_DIR . '/service/SnippetService.php');

class SnippetCtrl
{
    private $_snippetManager;
    private $_snippetService;

    public function __construct()
    {
        $db = new MyPdo();
        $this->_snippetManager = new SnippetManager($db);
        $this->_snippetService = new SnippetService($db);
    }

    public function getAll() {
        $snippets = $this->_snippetManager->getListSnippets();
        require(ROOT_DIR . '/view/allSnippetsView.php');
    }

    public function getOne($id) {
        $snippets = $this->_snippetManager->getListSnippets();
        $snippet = $this->_snippetService->findById($id);
        require(ROOT_DIR . '/view/oneSnippetView.php');
    }
    public function add($snippet) {
        $snippet = $this->_snippetManager->addSnippet($snippet);
        require(ROOT_DIR . '/view/oneSnippetView.php');
    }
    public function delete($id)
    {
        $result = $this->_snippetManager->delSnippet($id);
        require(ROOT_DIR . '/view/delSnippetView.php');
    }
    public function update($snippet) {
        $snippet = $this->_snippetManager->updSnippet($snippet);
        require(ROOT_DIR . '/view/oneSnippetView.php');
    }
}
