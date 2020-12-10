<?php

require_once 'View/View.php';
require_once 'Model/SecurityModel.php';
require_once 'Service/SecurityService.php';

class SecurityController
{
    private $securityModel;
    private $securityService;

    public function __construct()
    {
        $this->securityModel = new SecurityModel();
        $this->securityService = new SecurityService();
    }

    public function signup()
    {
        $this->securityService->checkSignup();

        $this->securityModel->checkExistingUser($_POST['email']);
        exit(0);
        $view = new View('Home');
        $view->generate([]);
    }

}
