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
            echo ('Scandiweb API');
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
                $this->controllerMethod = "store";
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                break;

            default:
                http_response_code(405);
                header("Allow: GET, POST, DELETE");
                exit;
                break;
        }

        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    private function parseURL()
    {
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
}
