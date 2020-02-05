<?php

require_once ('config.php');
require_once('model/SnippetManager.php');
require_once('config/MyPdo.php');

class SnippetCtrl
{
    private $_snippetManager;

    public function __construct()
    {
        $this->_snippetManager = new SnippetManager(new MyPdo());
    }

    public function getAll() {
        $snippets = $this->_snippetManager->getListSnippets();
        require(ROOT_DIR . '/view/allSnippetsView.php');
    }

    public function getOne($id) {
        $snippets = $this->_snippetManager->getListSnippets();
        $snippet = $this->_snippetManager->getOneSnippet($id);
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
