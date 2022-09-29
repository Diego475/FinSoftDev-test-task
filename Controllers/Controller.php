<?php

namespace App\Controllers;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Router;

abstract class Controller 
{
    public static function request() : Request
    {
        return Router::request();
    }

    public static function response() : Response
    {
        return Router::response();
    }

    public function input($index = null, $defaultValue = null, ...$methods)
    {
        if ($index !== null) {
            return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
        }
    
        return request()->getInputHandler();
    }

    public function setCors()
    {
        $this->response->header('Access-Control-Allow-Origin: *');
        $this->response->header('Access-Control-Request-Method: OPTIONS');
        $this->response->header('Access-Control-Allow-Credentials: true');
        $this->response->header('Access-Control-Max-Age: 3600');
    }
}