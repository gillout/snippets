<?php

require_once(ROOT_DIR . '/model/User.php');

class UserManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->_db = $db;
    }

    private function hydrate(array $data, User $obj):User
    {
        foreach ($data as $key=>$value) { // => [userId][name][email][pwd]
            $method = "set" . ucfirst($key); // setUserId, setName, setEmail, setPwd
            $obj->$method($value);
        }
        return $obj;
    }

    public function getOneUser($userId)
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM user WHERE userId = :userId');
        $req->bindParam(':userId', $userId);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $this->hydrate($req->fetch(), new User());
    }

    public function getListUsers()
    {
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('SELECT * FROM user');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($req->fetchAll() as $user) {
            $result[] = $this->hydrate($user, new User);
        }
        return $result;
    }

    public function addUser(User $user)
    {
        // Préparation requête insertion
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('INSERT INTO user (name, email, pwd) VALUES (:name, :email, :pwd)');
        // Assignation valeurs
        $name = $user->getName();
        $req->bindParam(':name', $name);
        $email = $user->getEmail();
        $req->bindParam(':email', $email);
        $pwd = $user->getPwd();
        $req->bindParam(':pwd', $pwd);
        // Exécution requête
        if ($req->execute()) {
            $id = $this->_db->lastInsertId();
            return $this->getOneUser($id);
        }
        return null;
    }

    public function delUser($id)
    {
        $req = $this->_db->prepare('DELETE FROM user WHERE userId = :userId');
        $req->bindParam(':userId', $id);
        return $req->execute();
    }

    public function updUser(User $user)
    {
        // Préparation requête update
        $this->_db->exec("set names utf8");
        $req = $this->_db->prepare('UPDATE user SET name=:name, email=:email, pwd=:pwd WHERE userId=:userId');
        // Assignation valeurs
        $name = $user->getName();
        $req->bindParam(':name', $name);
        $email = $user->getEmail();
        $req->bindParam(':email', $email);
        $pwd = $user->getPwd();
        $req->bindParam(':pwd', $pwd);
        $userId = $user->getUserId();
        $req->bindParam(':userId', $userId);
        // Exécution requête
        if ($req->execute()) {
            return $this->getOneUser($userId);
        }
        return null;
    }
}
