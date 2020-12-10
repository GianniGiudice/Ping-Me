<?php
session_start();

require 'Controller/Router.php';

$router = new Router();
$router->routerRequest();
