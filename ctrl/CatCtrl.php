<?php

require_once(ROOT_DIR . '/config.php');
require_once(ROOT_DIR . '/model/SnippetManager.php');
require_once(ROOT_DIR . '/model/CatManager.php');
require_once(ROOT_DIR . '/config/MyPdo.php');

class CatCtrl
{
    private $_snippetManager;
    private $_catManager;

    public function __construct()
    {
        $this->_snippetManager = new SnippetManager(new MyPdo());
        $this->_catManager = new CatManager(new MyPdo());
    }

    public function getAll() {
        $snippets = $this->_snippetManager->getAll();
        $cats = $this->_catManager->getListCats();
        require(ROOT_DIR . '/view/allCatsView.php');
    }

    public function getOne($id) {
        $cat = $this->_catManager->getOneCat($id);
        require(ROOT_DIR . '/view/oneCatView.php');
    }
    public function add($cat) {
        $cat = $this->_catManager->addCat($cat);
        require(ROOT_DIR . '/view/oneCatView.php');
    }
    public function delete($id)
    {
        $result = $this->_catManager->delCat($id);
        require(ROOT_DIR . '/index.php?action=listCats');
    }
    public function update($cat) {
        $cat = $this->_catManager->updCat($cat);
        require(ROOT_DIR . '/view/oneCatView.php');
    }
}
