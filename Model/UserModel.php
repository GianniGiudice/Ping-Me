<?php

require_once 'Model/Model.php';

class UserModel extends Model
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getRacket(int $id)
    {
        $sql = 'SELECT * FROM racket WHERE user_id = ?';
        $result = $this->executeRequest($sql, [ $id ]);

        return $result->fetch();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRedSide(int $id)
    {
        $sql = 'SELECT * FROM red_side WHERE racket_id = ?';
        $result = $this->executeRequest($sql, [ $id ]);

        return $result->fetch();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getBlackSide(int $id)
    {
        $sql = 'SELECT * FROM black_side WHERE racket_id = ?';
        $result = $this->executeRequest($sql, [ $id ]);

        return $result->fetch();
    }
}