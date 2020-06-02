<?php
/**
 * Initialisations
 * regisiter an autoload, start or resuse a session
 */
spl_autoload_register(function ($class) {
    require "./classes/{$class}.php";
});
session_start();