<?php

require_once 'View/View.php';
require_once 'Model/SecurityModel.php';
require_once 'Model/UserModel.php';
require_once 'Service/SecurityService.php';

class SecurityController
{
    private $securityModel;
    private $userModel;
    private $securityService;

    public function __construct()
    {
        $this->securityModel = new SecurityModel();
        $this->userModel = new UserModel();
        $this->securityService = new SecurityService();
    }

    public function signup()
    {
        if ($this->securityService->checkSignup()) {
            if ($this->securityModel->userIsFree($_POST['email'])) {
                $this->securityModel->register($_POST);
                $view = new View('Home');
                $view->generate(['success' => $this->securityService->getSuccess()]);
            }
            else {
                $view = new View('Home');
                $view->generate(['error' => 'Cette adresse mail est déjà prise.']);
            }
        }
        else {
            $view = new View('Home');
            $view->generate(['error' => $this->securityService->getError()]);
        }
    }

    public function signin()
    {
        if ($this->securityService->checkSignin()) {
            if ($this->securityModel->login($_POST['email'], $_POST['password'])) {
                $view = new View('UserHome');
                $_SESSION['user'] = $this->securityModel->getUser($_POST['email']);
                $_SESSION['racket'] = $this->userModel->getRacket($_SESSION['user']['id']);
                if ($_SESSION['racket'] != null) {
                    $_SESSION['red'] = $this->userModel->getRedSide($_SESSION['racket']['id']);
                    $_SESSION['black'] = $this->userModel->getBlackSide($_SESSION['racket']['id']);
                }
                $view->generate([]);
            }
            else {
                $view = new View('Home');
                $view->generate(['error' => 'Les identifiants sont incorrects.']);
            }
        }
        else {
            $view = new View('Home');
            $view->generate(['error' => $this->securityService->getError()]);
        }
    }

}
