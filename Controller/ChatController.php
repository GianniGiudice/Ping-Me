<?php

require_once 'View/View.php';
require_once 'Model/UserModel.php';
require_once 'Model/ChatModel.php';
require_once 'Service/ChatService.php';

class ChatController
{
    private $userModel;
    private $chatModel;
    private $chatService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->chatModel = new ChatModel();
        $this->chatService = new ChatService();
    }

    public function send() {
        if ($this->chatService->checkSendingData()) {
            $this->chatModel->send($_SESSION['user']['id'], $_POST);
            $view = new View('UserHome');
            $view->generate([
                'chat' => $this->chatModel->getAllMessages(),
                'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                'others' => $this->userModel->getOtherUsers($_SESSION['user']['id'])
            ]);
        }
        else {
            $view = new View('UserHome');
            $view->generate([
                'error' => $this->chatService->getError(),
                'chat' => $this->chatModel->getAllMessages(),
                'user' => $this->userModel->getUserWithID($_SESSION['user']['id']),
                'others' => $this->userModel->getOtherUsers($_SESSION['user']['id'])
            ]);
        }
    }
}