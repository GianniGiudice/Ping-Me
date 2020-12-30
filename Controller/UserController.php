<?php

require_once 'View/View.php';
require_once 'Service/WorkshopService.php';

class UserController
{
    private $workshopService;

    public function __construct()
    {
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

        }
        else {
            $view = new View('UserHome');
            $view->generate(['error' => $this->workshopService->getError()]);
        }
    }

}
