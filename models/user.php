<?php

namespace models;

use Database;

require_once "..\database.php";

class User
{
    private $id;
    private $email;
    private $password;
    private $role_id;

    public static function Create($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("insert into ecommerce5e.users(email, password, role_id) values (:email, :password, 1)");
        $stm->bindParam(":email", $params['email']);
        $stm->bindParam(":password", $params['password']);
        $stm->execute();
        $user = User::Find($params);
        return $user;
    }

    public static function Find($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.users where email=:email and password=:password");
        $stm->bindParam(":email", $params['email']);
        $stm->bindParam(":password", $params['password']);
        $stm->execute();
        $user = $stm->fetchObject(__CLASS__);
        return $user;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
