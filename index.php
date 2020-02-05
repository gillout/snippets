<?php

/*
$url = $_SERVER['PHP_SELF'];

if (preg_match('/User/', $url)) {
    require_once('ctrl/UserCtrl.php');
} elseif (preg_match('/Cat/', $url)) {
    require_once('ctrl/CatCtrl.php');
} elseif (preg_match('/Snippet/', $url)) {
    require_once('ctrl/SnippetCtrl.php');
}
*/

require_once(ROOT_DIR . '/ctrl/UserCtrl.php');
require_once(ROOT_DIR . '/ctrl/CatCtrl.php');
require_once(ROOT_DIR . '/ctrl/SnippetCtrl.php');

if ( isset($_GET['action']) && isset($_GET['id']) ) {

    if ($_GET['action'] == 'oneUser') {
        $userCtrl = new UserCtrl();
        $userCtrl->getOne($_GET['id']);
    } elseif ($_GET['action'] == 'delUser') {
        $userCtrl = new UserCtrl();
        $userCtrl->delete($_GET['id']);
    } elseif ($_GET['action'] == 'updUser') {
        $user = new User();
        $user->setUserId($_GET['id']);
        $user->setName('Jay');
        $user->setEmail('jay@test.en');
        $user->setPwd('jay');
        $userCtrl = new UserCtrl();
        $userCtrl->update($user);
    }

    if ($_GET['action'] == 'oneCat') {
        $catCtrl = new CatCtrl();
        $catCtrl->getOne($_GET['id']);
    } elseif ($_GET['action'] == 'delCat') {
        $catCtrl = new CatCtrl();
        $catCtrl->delete($_GET['id']);
    } elseif ($_GET['action'] == 'updCat') {
        $cat = new Cat();
        $cat->setCatId($_GET['id']);
        $cat->setLabel('Réécriture d\'url');
        $catCtrl = new CatCtrl();
        $catCtrl->update($cat);
    }

    if ($_GET['action'] == 'oneSnippet') {
        $snippetCtrl = new SnippetCtrl();
        $snippetCtrl->getOne($_GET['id']);
    } elseif ($_GET['action'] == 'delSnippet') {
        $snippetCtrl = new SnippetCtrl();
        $snippetCtrl->delete($_GET['id']);
    } elseif ($_GET['action'] == 'updSnippet') {
        $snippet = new Snippet();
        $snippet->setSnippetId($_GET['id']);
        $snippet->setTitle('Autoload');
        $snippet->setLanguage('PHP');
        $snippet->setCode('function autoload() { echo "Autoload.php"; }');
        $snippet->setDateCrea('04-02-2020');
        $snippet->setComment('Fonction de chargement automatique des classes');
        $snippet->setRequirement('');
        $snippet->setUserId(5);
        $snippet->setCatId(2);
        $snippetCtrl = new SnippetCtrl();
        $snippetCtrl->update($snippet);
    }

} elseif ( isset($_GET['action'])) {

    if ($_GET['action'] == 'listUsers') {
        $userCtrl = new UserCtrl();
        $userCtrl->getAll();
    } elseif ($_GET['action'] == 'addUser') {
        $user = new User();
        $user->setName('Didier');
        $user->setEmail('didier@test.ru');
        $user->setPwd('didi');
        $userCtrl = new UserCtrl();
        $userCtrl->add($user);
    }

    if ($_GET['action'] == 'listCats') {
        $catCtrl = new CatCtrl();
        $catCtrl->getAll();
    } elseif ($_GET['action'] == 'addCat') {
        $cat = new Cat();
        $cat->setLabel('Sécurité');
        $catCtrl = new CatCtrl();
        $catCtrl->add($cat);
    }

    if ($_GET['action'] == 'listSnippets') {
        $snippetCtrl = new SnippetCtrl();
        $snippetCtrl->getAll();
    } elseif ($_GET['action'] == 'addSnippet') {
        $snippet = new Snippet();
        $snippet->setTitle('Autoload');
        $snippet->setLanguage('PHP');
        $snippet->setCode('function hydrate() { echo "Hydrate.php"; }');
        $snippet->setDateCrea('05-02-2020');
        $snippet->setComment('Fonction d\'hydratation');
        $snippet->setRequirement('');
        $snippet->setUserId(14);
        $snippet->setCatId(1);
        $snippetCtrl = new SnippetCtrl();
        $snippetCtrl->add($snippet);
    }

}
