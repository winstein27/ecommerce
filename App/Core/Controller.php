<?php

namespace App\Core;

abstract class Controller
{
    protected function createModel($model)
    {
        $lowerCaseType = strtolower($model);
        $modelType = ucwords($lowerCaseType);
        require_once "../App/Models/" . $modelType . ".php";
        echo "../App/Models/" . $modelType . ".php";


        return new $modelType;
    }

    protected function getRequestBody()
    {
        $json = file_get_contents("php://input");
        $obj = (array) json_decode($json, true);

        return $obj;
    }
}
