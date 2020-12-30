<?php

require_once 'Controller/HomeController.php';
require_once 'Controller/SecurityController.php';
require_once 'Controller/UserController.php';
require_once 'View/View.php';

class Router
{
    private $homeController;
    private $securityController;
    private $userController;

    public function __construct()
    {
        $this->homeController = new HomeController();
        $this->securityController = new SecurityController();
        $this->userController = new UserController();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequest()
    {
        try {
            // Visiteur
            if (!$this->isConnected()) {
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'inscription':
                            $this->securityController->signup();
                            break;
                        case 'connexion':
                            $this->securityController->signin();
                            break;
                    }
                }
                else {
                    $this->homeController->index();
                }
            }
            // Connecté
            else {
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'atelier':
                            $this->userController->workshop();
                            break;
                        case 'logout':
                            session_destroy();
                            unset($_SESSION['user']);
                            header('location: index.php');
                            break;
                    }
                }
                else {
                    $this->userController->index();
                }
            }
        }
        catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    // Affiche une erreur
    private function error($errorMessage)
    {
        $view = new View('Error');
        $view->generate(array('errorMessage' => $errorMessage));
    }

    // Recherche un paramètre dans un tableau
    private function getParameter($array, $name)
    {
        if (isset($array[$name])) {
            return $array[$name];
        }
        else {
            throw new Exception('Paramètre ' . $name . ' absent');
        }
    }

    /**
     * @return bool
     */
    private function isConnected() : bool
    {
        return (isset($_SESSION['user'])) ? (true) : (false);
    }

}
