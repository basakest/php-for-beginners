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
    public static function isLoggedIn()
    {
        return isset($_SESSION["has_login"]) && $_SESSION["has_login"];
    }

    /**
     * quit if the user hasn't logged in
     *
     * @return void
     */
    public static function requireLogIn()
    {
        if (!Auth::isLoggedIn()) {
            die("<a href='../login.php'>log in </a>to see this page");
        }
    }

    /**
     * user login
     *
     * @return void
     */
    public static function logIn()
    {
        session_regenerate_id(true);
        $_SESSION["has_login"] = true;
    }

    /**
     * user logout
     *
     * @return void
     */
    public static function logOut()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}
