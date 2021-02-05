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
        $sql = "SELECT id FROM user WHERE email = '" . $mail_address . "'";
        $result = $this->executeRequest($sql);

        return ($result->rowCount() == 0);
    }

    /**
     * @param array $data
     */
    public function register(array $data): void
    {
        $sql = "INSERT INTO user (email, firstname, lastname, password, registration, connection) VALUES (
                '" . $data['email'] . "', 
                '" . $data['firstname'] . "', 
                '" . $data['lastname'] . "', 
                '" . $data['password'] . "', 
                now(), 
                null)";
        $this->executeRequest($sql);
    }

    /**
     * @param string $mail_address
     * @param string $password
     * @return false|mixed
     */
    public function login(string $mail_address, string $password)
    {
        $sql = "SELECT * FROM user WHERE email = '" . $mail_address . "' AND password = '" . $password . "'";
        $result = $this->executeRequest($sql);

        if ($result->rowCount() > 0) {
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
        $sql = "SELECT * FROM user WHERE email = '" . $mail_address . "'";
        $result = $this->executeRequest($sql);
        return $result->fetch();
    }
}