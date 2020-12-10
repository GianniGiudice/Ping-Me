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
                            return true;
                        }
                        $this->setError('Le mot de passe doit contenir au moins 3 caractères et être identique à sa confirmation.');
                    }
                    $this->setError('Mauvais format d\'adresse mail.');
                }
                $this->setError('Mauvais format de nom de famille.');
            }
            $this->setError('Mauvais format de prénom.');
        }
        return false;
    }
}