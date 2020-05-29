<?php
/**
 * judge if the user is logged in
 *
 * @return boolean
 */
function isLoggedIn() {
    return isset($_SESSION["has_login"]) && $_SESSION["has_login"];
}