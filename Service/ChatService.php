<?php

require_once 'Service/Service.php';

class ChatService extends Service
{
    /**
     * @return bool
     */
    public function checkSendingData(): bool
    {
        if (isset($_POST['send']) && isset($_POST['message'])) {
            if (strlen($_POST['message']) >= 1 && strlen($_POST['message']) <= 50) {
                return true;
            }
            $this->setError('Le message doit contenir entre 1 et 50 caractères.');
        }
        else {
            $this->setError('Le formulaire est erroné.');
        }
        return false;
    }
}