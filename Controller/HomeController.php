<?php

require_once 'View/View.php';

class HomeController {
    public function index() {
        $view = new View('Home');
        $view->generate([]);
    }

}
