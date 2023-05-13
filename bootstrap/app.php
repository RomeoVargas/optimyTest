<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/helpers.php');

ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . '/../logs/error.log');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->safeLoad();