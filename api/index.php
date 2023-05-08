<?php

declare(strict_types=1);

require dirname(__DIR__) . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$resource = explode("/", $path)[2];

$method = $_SERVER["REQUEST_METHOD"];

if($resource != "products") {
    http_response_code(404);
    exit;
}

header("Content-type: application/json; charset:UTF-8");

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
$database->getConnection();

$controller = new ProductController;
$controller->processRequest($method);
