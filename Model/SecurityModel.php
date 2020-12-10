<?php

require_once 'Model/Model.php';

class SecurityModel extends Model
{
    /**
     * @param string $mail_address
     * @return bool
     */
    public function checkExistingUser(string $mail_address): bool
    {
        $sql = 'SELECT id FROM user WHERE email = ?';
        $result = $this->executeRequest($sql, [ $mail_address ]);

        return ($result->rowCount() > 0);
    }
}