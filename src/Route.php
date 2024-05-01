<?php

namespace Dell\NdaPortal;

class Route{
    public array $getRoutes;
    public array $postRoutes;

    public function get (string $route, array|callable $method) {
        $this->getRoutes[$route] = $method;
        return $this;
    }
    public function post (string $route, array|callable $method) {
        $this->postRoutes[$route] = $method;
        return $this;
    }
    public function resolve () {
        $r_method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? '/';
        if($r_method == "GET") {
            $action = $this->getRoutes[$path] ?? null;
        }else{
            $action = $this->postRoutes[$path] ?? null;
        }
        if($action){
            [$object, $method] = $action;
            $object = new $object();
            return $object->$method();
        }
        else{
            header("HTTP/1.0 404 Not Found");
            return "404 Page Not Found";
        }

    }
}