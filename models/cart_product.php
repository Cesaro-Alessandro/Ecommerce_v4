<?php

namespace models;
require_once "../database.php";

use Database;
use PDO;

class cart_product
{
    private $cart_id;
    private $product_id;
    private $quantita;

    public static function FindAll()
    {
    }

    public static function Delete($id)
    {
    }

    public static function Create($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("insert into ecommerce5e.cart_products(cart_id, product_id, quantita) values (:cart_id, :product_id, :quantita)");
        $stm->bindParam(":cart_id", $params['cart_id']);
        $stm->bindParam(":product_id", $params['product_id']);
        $stm->bindParam(":quantita", $params['quantita']);
        $stm->execute();
        $cart_product = cart_product::Find($params);
        return $cart_product;
    }

    public static function Find($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.cart_products where cart_id=:cart_id and product_id=:product_id");
        $stm->bindParam(":cart_id", $params["cart_id"]);
        $stm->bindParam(":product_id", $params["product_id"]);
        $stm->execute();
        $cart_product = $stm->fetchObject(__CLASS__);
        return $cart_product;
    }

    public static function FindByUser($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("select * from ecommerce5e.cart_products where cart_id=:cart_id");
        $stm->bindParam(":cart_id", $params["cart_id"]);
        $stm->execute();

        $cart_product = $stm->fetchAll(PDO::FETCH_ASSOC);
        var_dump($cart_product);
        return $cart_product;
    }

    public static function Test($params)
    {
        $pdo = Database::get_Connection();
        //$stm = $pdo->prepare("SELECT * FROM ecommerce5e.cart_products INNER JOIN ecommerce5e.products ON ecommerce5e.cart_products.product_id = ecommerce5e.products.id WHERE ecommerce5e.cart_products.product_id = :id");
        $stm = $pdo->prepare("select ecommerce5e.products.nome, ecommerce5e.products.marca, ecommerce5e.products.prezzo, tb1.quantita 
                                    from (SELECT * 
                                    FROM ecommerce5e.cart_products 
                                    INNER JOIN ecommerce5e.carts ON ecommerce5e.cart_products.cart_id = ecommerce5e.carts.id 
                                    WHERE ecommerce5e.cart_products.cart_id = :id)tb1
                                    inner join ecommerce5e.products on tb1.product_id = ecommerce5e.products.id
                                    ");
        $stm->bindParam(":id", $params["cart_id"]);
        $stm->execute();

        $cart_product = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $cart_product;
    }

    public function Update($params)
    {
        $pdo = Database::get_Connection();
        $stm = $pdo->prepare("update ecommerce5e.cart_products set quantita=:quantita where cart_id=:cart_id and product_id=:product_id");
        $stm->bindParam(":quantita", $params['quantita']);
        $stm->bindParam(":cart_id", $this->cart_id);
        $stm->bindParam(":product_id", $this->product_id);
        $stm->execute();
        $cart_product = cart_product::Find($params);
        return $cart_product;
    }

    /**
     * @return mixed
     */
    public function getCartId()
    {
        return $this->cart_id;
    }

    /**
     * @param mixed $cart_id
     */
    public function setCartId($cart_id)
    {
        $this->cart_id = $cart_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getQuantita()
    {
        return $this->quantita;
    }

    /**
     * @param mixed $quantita
     */
    public function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }
}