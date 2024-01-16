<?php
class Database
{
    static private $connection;
    static private $dsn = "mysql:host=localhost;dbname=ecommerce5e";

    public static function get_Connection()
    {
        if(!isset($connection))
        {
            try {
                $loginData = file_get_contents(__DIR__ . "\config.txt");
                $loginDataSplit = explode(":", $loginData);
                $connection = new PDO(self::$dsn, $loginDataSplit[0], $loginDataSplit[1]);
                self::$connection = $connection;
                return self::$connection;
            }
            catch (PDOException $e)
            {
                echo "Database connection error: " . $e->getMessage();
                return false;
            }
        }
        else
        {
            return self::$connection;
        }
    }
}