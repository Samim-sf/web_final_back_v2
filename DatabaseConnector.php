<?php


class DatabaseConnector
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'samim123';
    const DB_NAME = 'movie';
    private static $conn = null;

    private function __construct()
    {
        $this->DB_connect();
    }

    private function DB_connect()
    {
        try{
            self::$conn = new PDO('mysql:host=' . self::DB_HOST .';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
            self::$conn->exec('SET NAMES utf8');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$conn)) {
            try{
                self::$conn = new PDO('mysql:host=' . self::DB_HOST .';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
                self::$conn->exec('SET NAMES utf8');
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){

                echo $e->getMessage();

            }
        }
        return self::$conn;
    }

    public static function runQuery($query)
    {
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public static function exeQuery($sql)
    {
        $sql->execute();
    }

    /**
     * @return null
     */
    public static function getDbName()
    {
        return self::DB_NAME;
    }

}