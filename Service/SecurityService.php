<?php

require_once 'Service/Service.php';

class SecurityService extends Service
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function checkSignup(): bool
    {
        if (isset($_POST['signup']) && isset($_POST['lastname']) && isset($_POST['firstname']) &&
            isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm'])) {
            $firtname_length = strlen($_POST['firstname']);
            $lastname_length = strlen($_POST['lastname']);

            // Check firstname
            if ($firtname_length >= 2 && $firtname_length <= 12 && ctype_alpha($_POST['firstname'])) {
                if ($lastname_length >= 2 && $lastname_length <= 12 && ctype_alpha($_POST['lastname'])) {
                    // Check mail address
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                        if (strlen($_POST['password']) >= 3 && $_POST['password'] == $_POST['confirm']) {
                            $this->setSuccess('Vous êtes bien inscrit et pouvez à présent vous connecter.');
                            return true;
                        }
                        $this->setError('Le mot de passe doit contenir au moins 3 caractères et être identique à sa confirmation.');
                    }
                    $this->setError('Mauvais format d\'adresse mail.');
                }
                $this->setError('Le nom doit contenir entre 2 et 12 caractères alphabétiques.');
            }
            $this->setError('Le prénom doit contenir entre 2 et 12 caractères alphabétiques.');
        }
        return false;
    }

    /**
     * @return bool
     */
    public function checkSignin(): bool
    {
        if (isset($_POST['signin']) && isset($_POST['email']) && isset($_POST['password'])) {
            return true;
        }
        $this->setError('Les champs ne sont pas remplis.');
        return false;
    }
}