<?php
/**
 * the class about url
 */
class Url
{
    /**
     * redirect to a new url
     *
     * @param [string] $path
     * @return void
     */
    public static function redirect($path) {
        if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != "off")) {
            $protocal = "https";
        } else {
            $protocal = "http";
        }
        $url = "$protocal://$_SERVER[HTTP_HOST]/$path";
        header("Location: $url");
        exit();
    }
}