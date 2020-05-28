<?php
/**
 * connect php and mysql
 *
 * @return the connection of mysql
 */
    function getDB() {
        $db_host = "127.0.0.1";
        $db_name = "cms";
        $db_user = "cms_www";
        $db_pwd = "12345";

        $dbc = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);

        if (mysqli_connect_errno()) {
            echo mysqli_connect_errno();
            exit();
        }
        return $dbc;
    }
    
?>