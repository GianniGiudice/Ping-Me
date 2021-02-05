<?php

require_once 'Model/Model.php';
require_once 'Model/UserModel.php';

class ChatModel extends Model
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    /**
     * @param int $user_id
     * @param array $data
     */
    public function send(int $user_id, array $data): void
    {
        $user = $this->userModel->getUserWithID($user_id);
        $name = $user['firstname'] . ' ' . $user['lastname'];
        $sql = "INSERT INTO chat (author, message) VALUES (?, ?)";
        $this->executeRequest($sql, [
            $name, $data['message']
        ]);
    }

    /**
     * @return array
     */
    public function getAllMessages(): array
    {
        $sql = 'SELECT * FROM chat';
        $result = $this->executeRequest($sql);

        return $result->fetchAll();
    }
}