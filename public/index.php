<?php

require_once("../vendor/autoload.php");

header("Content-type: application/json");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

new App\Core\Router();
