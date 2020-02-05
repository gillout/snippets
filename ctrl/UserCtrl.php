<?php

require_once(ROOT_DIR . '/config.php');
require_once(ROOT_DIR . '/model/UserManager.php');
require_once(ROOT_DIR . '/config/MyPdo.php');

class UserCtrl
{
    private $_userManager;

    public function __construct()
    {
        $this->_userManager = new UserManager(new MyPdo());
    }

    public function getAll() {
        $users = $this->_userManager->getListUsers();
        require(ROOT_DIR . '/view/allUsersView.php');
    }

    public function getOne($id) {
        $user = $this->_userManager->getOneUser($id);
        require(ROOT_DIR . '/view/oneUserView.php');
    }
    public function add($user) {
        $user = $this->_userManager->addUser($user);
        require(ROOT_DIR . '/view/oneUserView.php');
    }
    public function delete($id)
    {
        $result = $this->_userManager->delUser($id);
        require(ROOT_DIR . '/view/delUserView.php');
    }
    public function update($user) {
        $user = $this->_userManager->updUser($user);
        require(ROOT_DIR . '/view/oneUserView.php');
    }
}
