<?php

namespace models;

//use Database;

use Database;

require_once "../database.php";

class session
{
    private $id;
    private $ip;
    private $data_login;

    public static function Create($params)
    {
        $date = date('Y-m-d H:i:s');
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("insert into ecommerce5E.sessions(ip,data_login,user_id)values (:ip,:data_login,:user_id)");
        $stm->bindParam(":ip", $params["ip"]);
        $stm->bindParam(":data_login", $date);
        $stm->bindParam(":user_id", $params["user_id"]);
        $stm->execute();
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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getDataLogin()
    {
        return $this->data_login;
    }

    /**
     * @param mixed $data_login
     */
    public function setDataLogin($data_login)
    {
        $this->data_login = $data_login;
    }
}
