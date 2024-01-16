<?php

namespace models;
require_once "../database.php";

use Database;
use PDO;

class product
{
    private $id;
    private $nome;
    private $prezzo;
    private $marca;

    public static function FindAll()
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.products");
        $stm->execute();
        $products = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public static function Create($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("insert into ecommerce5e.products(nome, marca, prezzo) values (:nome, :marca, :prezzo)");
        $stm->bindParam(":nome", $params['nome']);
        $stm->bindParam(":marca", $params['marca']);
        $stm->bindParam(":prezzo", $params['prezzo']);
        $stm->execute();
        $prodotto = product::Find($params);
        return $prodotto;
    }

    public static function Find($id)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.products where id=:id");
        $stm->bindParam(":id", $params["id"]);
        $stm->execute();
        $prodotto = $stm->fetchObject(__CLASS__);
        return $prodotto;
    }

    public function Delete()
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("delete from ecommerce5e.products where id=:id");
        $stm->bindParam(":id", $this->id);
        $stm->execute();
        return null;
    }

    public function Update()
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("update ecommerce5e.products set nome=:nome, prezzo=:prezzo, marca=:marca WHERE id=:id");
        $stm->bindParam(":id", $this->id);
        $stm->bindParam(":nome", $this->nome);
        $stm->bindParam(":prezzo", $this->prezzo);
        $stm->bindParam(":marca", $this->marca);
        $stm->execute();

        $params = array("id" => $this->id, "nome" => $this->nome, "prezzo" => $this->prezzo, "marca" => $this->marca);
        $prodotto = product::Find($params);
        return $prodotto;
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
    public function getPrezzo()
    {
        return $this->prezzo;
    }

    /**
     * @param mixed $prezzo
     */
    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
}