<?php

require_once ('config.php');
require_once('model/CatManager.php');
require_once('config/MyPdo.php');

class CatCtrl
{
    private $_catManager;

    public function __construct()
    {
        $this->_catManager = new CatManager(new MyPdo());
    }

    public function getAll() {
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
        require(ROOT_DIR . '/view/delCatView.php');
    }
    public function update($cat) {
        $cat = $this->_catManager->updCat($cat);
        require(ROOT_DIR . '/view/oneCatView.php');
    }
}
