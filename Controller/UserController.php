<?php

require_once 'View/View.php';
require_once 'Model/UserModel.php';
require_once 'Service/WorkshopService.php';
require_once 'Service/CompetitionService.php';

class UserController
{
    private $userModel;
    private $workshopService;
    private $competitionService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->workshopService = new WorkshopService();
        $this->competitionService = new CompetitionService();
    }

    public function index()
    {
        $view = new View('UserHome');
        $view->generate([
            'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
            'others' => $this->userModel->getOtherUsers($_SESSION['user']['id'])
        ]);
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
            $view->generate([
                'success' => $this->workshopService->getSuccess(),
                'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                'others' => $this->userModel->getOtherUsers($_SESSION['user']['id'])
            ]);
        }
        else {
            $view = new View('UserHome');
            $view->generate([
                'error' => $this->workshopService->getError(),
                'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                'others' => $this->userModel->getOtherUsers($_SESSION['user']['id'])
            ]);
        }
    }

    public function competition()
    {
        if ($this->competitionService->canFight($_SESSION['racket']) && $this->competitionService->checkOpponent())
        {
            $this->competitionService->fight(intval($_GET['user_id']));
            $others = $this->userModel->getOtherUsers($_SESSION['user']['id']);
            if ($this->competitionService->getFightResult() == 'VICTOIRE') {
                $array = [
                    'success' => 'Vous remportez le match.',
                    'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                    'others' => $others
                ];
            }
            else {
                $array = [
                    'danger' => 'Vous perdez le match.',
                    'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                    'others' => $others
                ];
            }
            $view = new View('UserHome');
            $view->generate($array);
        }
        else {
            $view = new View('UserHome');
            $view->generate([
                'error' => $this->competitionService->getError(),
                'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                'others' => $this->userModel->getOtherUsers($_SESSION['user']['id'])
            ]);
        }
    }

}
