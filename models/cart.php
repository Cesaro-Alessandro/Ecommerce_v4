<?php

namespace models;
require_once "../database.php";

use Database;
use PDO;

class cart
{
    private $id;
    private $user_id;

    public static function FindAll()
    {
    }

    public static function Delete($id)
    {
    }

    public static function Create($user_id)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("insert into ecommerce5e.carts(user_id) values (:user_id)");
        $stm->bindParam(":user_id", $user_id);
        $stm->execute();
        $cart = cart::FindByUser($user_id);
        return $cart;
    }

    public static function Find($id)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.carts where id=:id");
        $stm->bindParam(":id", $id);
        $stm->execute();
        $cart = $stm->fetchObject(__CLASS__);
        return $cart;
    }
    public static function FindByUser($id)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.carts where user_id=:id");
        $stm->bindParam(":id", $id);
        $stm->execute();
        $cart = $stm->fetchObject(__CLASS__);
        return $cart;
    }

    public static function Update($params)
    {
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}