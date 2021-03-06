<?php

class View {

    // Nom du fichier associé à la vue
    private $filename;
    
    // Titre de la vue (défini dans le fichier vue)
    private $title;

    public function __construct($action) {
        // Détermine le nom du fichier vue à partir de l'action
        $this->filename = "View/" . $action . "View.php";
    }

    // Génère et affiche la vue
    public function generate($data) {
        // Génération de la partie spécifique de la vue
        $content = $this->generateFile($this->filename, $data);
        // Génération du template commun utilisant la partie spécifique
        if (isset($_SESSION['user'])) {
            $view = $this->generateFile('View/template.php', [
                'title' => $this->title, 'content' => $content, 'breadcrumb' => true
            ]);
        }
        else {
            $view = $this->generateFile('View/template.php', [
                'title' => $this->title, 'content' => $content, 'breadcrumb' => false
            ]);
        }
        // Renvoi de la vue au navigateur
        echo $view;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function generateFile($filename, $data) {
        if (file_exists($filename)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($data);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $filename;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$filename' introuvable");
        }
    }

}
