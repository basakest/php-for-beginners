<?php
/**
 * Initialisations
 * regisiter an autoload, start or resuse a session
 */
spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});
session_start();