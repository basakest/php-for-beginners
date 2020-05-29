<?php
/**
 * redirect to a new url
 *
 * @param [string] $path
 * @return void
 */
function redirect($path) {
    if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != "off")) {
        $protocal = "https";
    } else {
        $protocal = "http";
    }
    $url = "$protocal://$_SERVER[HTTP_HOST]/$path";
    header("Location: $url");
    exit();
}