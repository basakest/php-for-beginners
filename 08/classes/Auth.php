<?php
/**
 * the class to auth user
 */
class Auth
{
    /**
     * judge if the user is logged in
     *
     * @return boolean
     */
    public static function isLoggedIn() {
        return isset($_SESSION["has_login"]) && $_SESSION["has_login"];
    }
}