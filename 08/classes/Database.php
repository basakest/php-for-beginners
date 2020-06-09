<?php
/**
 * Database class
 */
class Database
{   /**
    * the address of host computer
    *
    * @var [string]
    */
    protected $host;
    /**
     * the name of database
     *
     * @var [string]
     */
    protected $name;
    /**
     * the username of database
     *
     * @var [string]
     */
    protected $user;
    /**
     * the password of user
     *
     * @var [string]
     */
    protected $pwd;
    /**
     * construct the Database object
     *
     * @param [string] $host
     * @param [string] $name
     * @param [string] $user
     * @param [string] $pwd
     */
    public function __construct($host, $name, $user, $pwd)
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->pwd = $pwd;
    }
    /**
     * get the connection of mysql
     *
     * @return a PDO object
     */
    public function getConn() {
        $dsn = "mysql:host=$this->host;dbname=$this->name;charset=utf8";

        try {
            $db = new PDO($dsn, $this->user, $this->pwd);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }
        
    }
}