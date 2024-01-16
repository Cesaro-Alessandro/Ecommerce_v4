<?php

namespace models;

use Database;

require_once "..\database.php";

class Role
{
    private $id;
    private $nome;
    private $descrizione;

    static public function Find($id)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.roles where id=:id");
        $stm->bindParam(":id", $id);
        $stm->execute();
        $role = $stm->fetchObject(__CLASS__);
        return $role;
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * @param mixed $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }
}