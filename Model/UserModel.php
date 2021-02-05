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
        $sql = "SELECT * FROM racket WHERE user_id = '" . $id . "'";
        $result = $this->executeRequest($sql);

        return $result->fetch();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRedSide(int $id)
    {
        $sql = "SELECT * FROM red_side WHERE racket_id = '" . $id . "'";
        $result = $this->executeRequest($sql);

        return $result->fetch();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getBlackSide(int $id)
    {
        $sql = "SELECT * FROM black_side WHERE racket_id = '" . $id . "'";
        $result = $this->executeRequest($sql);

        return $result->fetch();
    }

    /**
     * @param int $user_id
     * @param $form
     */
    public function addRacket(int $user_id, $form): void
    {
        $sql = "INSERT INTO racket (speed, control, rotation, user_id) VALUES (
                '". $form['racket_speed'] ."', 
                '". $form['racket_control'] ."', 
                '". $form['racket_rotation'] ."', 
                '". $user_id ."')";
        $this->executeRequest($sql);
        $racket_id = $this->db->lastInsertId();
        $sql = "INSERT INTO red_side (speed, control, rotation, racket_id) VALUES (
                '". $form['red_speed'] ."', 
                '". $form['red_control'] ."', 
                '". $form['red_rotation'] ."', 
                '". $racket_id ."')";
        $this->executeRequest($sql);
        $sql = "INSERT INTO black_side (speed, control, rotation, racket_id) VALUES (
                '". $form['black_speed'] ."', 
                '". $form['black_control'] ."', 
                '". $form['black_rotation'] ."', 
                '". $racket_id ."')";
        $this->executeRequest($sql);
    }

    /**
     * @param int $user_id
     * @param $form
     */
    public function updateRacket(int $user_id, $form): void
    {
        $racket = $_SESSION['racket'];

        $sql = "UPDATE racket SET 
                speed = '" . $form['racket_speed'] . "', 
                control = '" . $form['racket_control'] . "', 
                rotation = '" . $form['racket_rotation'] . "' WHERE user_id = '" . $user_id . "'";
        $this->executeRequest($sql);

        $sql = "UPDATE red_side SET 
                speed = '" . $form['red_speed'] . "', 
                control = '" . $form['red_control'] . "', 
                rotation = '" . $form['red_rotation'] . "' WHERE racket_id = '" . $racket['id'] . "'";
        $this->executeRequest($sql);

        $sql = "UPDATE black_side SET 
                speed = '" . $form['black_speed'] . "', 
                control = '" . $form['black_control'] . "', 
                rotation = '" . $form['black_rotation'] . "' WHERE racket_id = '" . $racket['id'] . "'";
        $this->executeRequest($sql);
    }


    /**
     * @param int $user_id
     * @return array
     */
    public function getOtherUsers(int $user_id): array
    {
        $sql = "SELECT * FROM user WHERE id != '" . $user_id . "'";
        $result = $this->executeRequest($sql);

        return $result->fetchAll();
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function userExists(int $user_id): bool
    {
        $sql = "SELECT * FROM user WHERE id = '" . $user_id . "'";
        $result = $this->executeRequest($sql);
        return ($result->rowCount() != 0);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUserWithID(int $user_id)
    {
        $sql = "SELECT * FROM user WHERE id = '" . $user_id . "'";
        $result = $this->executeRequest($sql);
        return $result->fetch();
    }

    /**
     * @param int $user_id
     */
    public function addVictory(int $user_id): void
    {
        $sql = "UPDATE user SET victories = victories + 1 WHERE id = '" . $user_id . "'";
        $this->executeRequest($sql);
    }

    /**
     * @param int $user_id
     */
    public function addDefeat(int $user_id): void
    {
        $sql = "UPDATE user SET defeats = defeats + 1 WHERE id = '" . $user_id . "'";
        $this->executeRequest($sql);
    }
}