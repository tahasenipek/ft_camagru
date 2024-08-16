<?php

namespace Backend\Router;


class Router{
   


    static function get($url, $controller){
        if($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == $url){
            $controller = explode('@', $controller);
            $controller = 'Backend\Controller\\' . $controller[0];
            $controller = new $controller;
            $controller->{$controller[1]}();
        }
    }

    


}