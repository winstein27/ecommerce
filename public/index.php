<?php

// declare(strict_types=1);

require_once("../vendor/autoload.php");
require_once("../App/Core/ErrorHandler.php");

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

if (file_exists('../.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

new App\Core\Router();
