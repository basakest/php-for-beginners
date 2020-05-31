<?php
/**
 * Database class
 */
class Database
{
    /**
     * get the connection of mysql
     *
     * @return a PDO object
     */
    public function getConn() {
        $db_host = "127.0.0.1";
        $db_name = "cms";
        $db_user = "cms_www";
        $db_pwd = "12345";

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";

        try {
            $db = new PDO($dsn, $db_user, $db_pwd);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }
        
    }
}