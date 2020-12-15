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
        if ($this->securityService->checkSignup() &&
            $this->securityModel->userIsFree($_POST['email'])) {

            $view = new View('Home');
            $view->generate([]);
        }
        else {
            $view = new View('Home');
            $view->generate([]);
        }
    }

}
