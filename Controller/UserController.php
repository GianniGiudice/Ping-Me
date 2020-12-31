<?php

require_once 'View/View.php';
require_once 'Model/UserModel.php';
require_once 'Service/WorkshopService.php';

class UserController
{
    private $userModel;
    private $workshopService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->workshopService = new WorkshopService();
    }

    public function index()
    {
        $view = new View('UserHome');
        $view->generate([]);
    }

    public function workshop()
    {
        if ($this->workshopService->checkFormValues($_POST)) {
            if ($_SESSION['racket'] === false) {
                $this->userModel->addRacket($_SESSION['user']['id'], $_POST);
                $this->workshopService->setSuccess('Vous avez bien créé votre raquette !');
            }
            else {
                $this->userModel->updateRacket($_SESSION['user']['id'], $_POST);
                $this->workshopService->setSuccess('Votre raquette a bien été modifiée !');
            }
            $_SESSION['racket'] = $this->userModel->getRacket($_SESSION['user']['id']);
            $_SESSION['red'] = $this->userModel->getRedSide($_SESSION['racket']['id']);
            $_SESSION['black'] = $this->userModel->getBlackSide($_SESSION['racket']['id']);

            $view = new View('UserHome');
            $view->generate(['success' => $this->workshopService->getSuccess()]);
        }
        else {
            $view = new View('UserHome');
            $view->generate(['error' => $this->workshopService->getError()]);
        }
    }

}
