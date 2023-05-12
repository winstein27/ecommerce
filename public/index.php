<?php

// declare(strict_types=1);

require_once("../vendor/autoload.php");

if (file_exists('../.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

header("Content-type: application/json; charset:UTF-8");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

new App\Core\Router();
