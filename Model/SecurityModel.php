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

    /**
     * @param string $mail_address
     * @param string $password
     * @return false|mixed
     */
    public function login(string $mail_address, string $password)
    {
        $sql = 'SELECT * FROM user WHERE email = ?';
        $result = $this->executeRequest($sql, [ $mail_address ]);
        $user = $result->fetch();

        if ($result->rowCount() > 0 && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

    /**
     * @param string $mail_address
     * @return mixed
     */
    public function getUser(string $mail_address)
    {
        $sql = 'SELECT * FROM user WHERE email = ?';
        $result = $this->executeRequest($sql, [ $mail_address ]);
        return $result->fetch();
    }
}