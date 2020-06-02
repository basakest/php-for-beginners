<?php
class User
{
    /**
     * the id of user
     *
     * @var [int]
     */
    public $id;
    /**
     * the username of user
     *
     * @var [string]
     */
    public $username;
    /**
     * the password of user
     *
     * @var [string]
     */
    public $password;
    /**
     * authenticate the user
     *
     * @param [object] $dbc
     * @param [string] $username
     * @param [string] $password
     * @return boolean
     */
    public static function authenticate($dbc, $username, $password) {
        $sql = "select * from user where username = :username";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        $stmt->execute();
        if ($user = $stmt->fetch()) {
            return password_verify($password, $user->password);
        }
    }
}