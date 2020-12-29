<?php

require_once 'Model/Model.php';

class SecurityModel extends Model
{
    /**
     * @param string $mail_address
     * @return bool
     */
    public function userIsFree(string $mail_address): bool
    {
        $sql = 'SELECT id FROM user WHERE email = ?';
        $result = $this->executeRequest($sql, [ $mail_address ]);

        return ($result->rowCount() == 0);
    }

    /**
     * @param array $data
     */
    public function register(array $data): void
    {
        $sql = "INSERT INTO user (email, firstname, lastname, password, registration, connection) VALUES (?, ?, ?, ?, now(), ?)";
        $this->executeRequest($sql, [
            $data['email'], $data['firstname'], $data['lastname'], password_hash($data['password'], PASSWORD_DEFAULT), null
        ]);
    }
}