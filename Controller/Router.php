<?php

require_once 'Controller/HomeController.php';
require_once 'View/View.php';
class Router {
    private $homeController;

    public function __construct() {
        $this->homeController = new HomeController();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequest() {
        try {
            if (isset($_GET['action'])) {

            }
            // Aucune action définie : affichage de l'accueil
            $this->homeController->index();
        }
        catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    // Affiche une erreur
    private function error($errorMessage) {
        $view = new View("Erreur");
        $view->generate(array('errorMessage' => $errorMessage));
    }

    // Recherche un paramètre dans un tableau
    private function getParameter($array, $name) {
        if (isset($array[$name])) {
            return $array[$name];
        }
        else
            throw new Exception("Paramètre '$name' absent");
    }

}
