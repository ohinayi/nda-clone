<?php


use Dell\NdaPortal\Login;
use Dell\NdaPortal\Register;
use Dell\NdaPortal\Route;

require_once __DIR__."/vendor/autoload.php";

$route = new Route;
$route->get('/', [Register::class, "resolve"]);
$route->post('/register', [Register::class, "poo"]);
$route->get('/login', [Login::class, "loginPage"]);
$route->post('/logine', [Login::class, "verify"]);
$route->resolve();
