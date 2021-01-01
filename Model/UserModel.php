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

    /**
     * @param int $user_id
     * @param $form
     */
    public function addRacket(int $user_id, $form): void
    {
        $sql = 'INSERT INTO racket (speed, control, rotation, user_id) VALUES (?, ?, ?, ?)';
        $this->executeRequest($sql, [ $form['racket_speed'], $form['racket_control'], $form['racket_rotation'], $user_id ]);
        $racket_id = $this->db->lastInsertId();
        $sql = 'INSERT INTO red_side (speed, control, rotation, racket_id) VALUES (?, ?, ?, ?)';
        $this->executeRequest($sql, [ $form['red_speed'], $form['red_control'], $form['red_rotation'], $racket_id ]);
        $sql = 'INSERT INTO black_side (speed, control, rotation, racket_id) VALUES (?, ?, ?, ?)';
        $this->executeRequest($sql, [ $form['black_speed'], $form['black_control'], $form['black_rotation'], $racket_id ]);
    }

    /**
     * @param int $user_id
     * @param $form
     */
    public function updateRacket(int $user_id, $form): void
    {
        $racket = $_SESSION['racket'];

        $sql = 'UPDATE racket SET speed = ?, control = ?, rotation = ? WHERE user_id = ?';
        $this->executeRequest($sql, [ $form['racket_speed'], $form['racket_control'], $form['racket_rotation'], $user_id ]);

        $sql = 'UPDATE red_side SET speed = ?, control = ?, rotation = ? WHERE racket_id = ?';
        $this->executeRequest($sql, [ $form['red_speed'], $form['red_control'], $form['red_rotation'], $racket['id'] ]);

        $sql = 'UPDATE black_side SET speed = ?, control = ?, rotation = ? WHERE racket_id = ?';
        $this->executeRequest($sql, [ $form['black_speed'], $form['black_control'], $form['black_rotation'], $racket['id'] ]);
    }


    /**
     * @param int $user_id
     * @return array
     */
    public function getOtherUsers(int $user_id): array
    {
        $sql = 'SELECT * FROM user WHERE id != ?';
        $result = $this->executeRequest($sql, [ $user_id ]);

        return $result->fetchAll();
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function userExists(int $user_id): bool
    {
        $sql = 'SELECT * FROM user WHERE id = ?';
        $result = $this->executeRequest($sql, [ $user_id ]);
        return ($result->rowCount() != 0);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUserWithID(int $user_id)
    {
        $sql = 'SELECT * FROM user WHERE id = ?';
        $result = $this->executeRequest($sql, [ $user_id ]);
        return $result->fetch();
    }

    /**
     * @param int $user_id
     */
    public function addVictory(int $user_id): void
    {
        $sql = 'UPDATE user SET victories = victories + 1 WHERE id = ?';
        $this->executeRequest($sql, [ $user_id ]);
    }

    /**
     * @param int $user_id
     */
    public function addDefeat(int $user_id): void
    {
        $sql = 'UPDATE user SET defeats = defeats + 1 WHERE id = ?';
        $this->executeRequest($sql, [ $user_id ]);
    }
}