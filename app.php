<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


if (isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT'] != '') {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    if (getenv('HEROKU_APP') === 'true') {
        Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->safeLoad();
    }else{
        Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();
    }
} else {
    if (isset($GLOBALS['_SERVER']['HOME']) && $GLOBALS['_SERVER']['HOME'] != '') {
        require_once $GLOBALS['_SERVER']['HOME'] . '/www/vendor/autoload.php';
        Dotenv\Dotenv::createImmutable($GLOBALS['_SERVER']['HOME'] . '/www')->load();
    } else {
        require_once 'vendor/autoload.php';
        Dotenv\Dotenv::createImmutable(__DIR__)->load();
    }
}

@session_start();
?>
