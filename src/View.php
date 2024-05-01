<?php

namespace Dell\NdaPortal;


class View {
    public function __construct(
        public string $page,
        public array|string $options = []
    ) {
    }
    public function resolve() {
        $path = "./views/{$this->page}.php";
        if (file_exists($path)) {
            include $path;
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "404 Page Not Found";
    
        }
    }
}
