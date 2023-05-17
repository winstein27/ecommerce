<?php

namespace App\Core;

class Router
{
    private $controller;
    private $method;
    private $controllerMethod;
    private $params = [];

    function __construct()
    {

        $url = $this->parseURL();

        if (file_exists("../App/Controllers/" . ucfirst($url[1]) . ".php")) {
            $this->controller = $url[1];
            unset($url[1]);
        } elseif (empty($url[1])) {
            echo json_encode('Scandiweb API');
            exit;
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Resource not found."]);
        }

        require_once "../App/Controllers/" . ucfirst($this->controller) . ".php";

        $this->controller = new $this->controller;

        $this->method = $_SERVER["REQUEST_METHOD"];

        switch ($this->method) {
            case "GET":
                $this->controllerMethod = "index";
                break;

            case "POST":
                if (empty($url[2])) {
                    $this->controllerMethod = "store";
                } elseif ($url[2] == "massDelete") {
                    $this->controllerMethod = "deleteMany";
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Resource not found."]);
                }
                break;

            case "OPTIONS":
                http_response_code(200);
                exit;

            default:
                http_response_code(405);
                header("Allow: GET, POST");
                exit;
        }

        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    private function parseURL()
    {
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
}
