<?php

require_once 'Service/Service.php';
require_once 'Model/UserModel.php';

class CompetitionService extends Service
{
    private $filter_options;
    private $userModel;
    private $fight_result;

    public function __construct()
    {
        parent::__construct();
        $this->setFilterOptions();
        $this->userModel = new UserModel();
        $this->fight_result = '';
    }

    private function setFilterOptions(): void
    {
        $this->filter_options = [
            'options' => [
                'min_range' => 1,
            ]
        ];
    }

    /**
     * @param $racket
     * @return bool
     */
    public function canFight($racket): bool
    {
        if ($racket == null) {
            $this->setError('Vous devez posséder une raquette pour affronter un joueur.');
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function checkOpponent(): bool
    {
        if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            if ((filter_var($user_id, FILTER_VALIDATE_INT, $this->filter_options) !== FALSE) && ($user_id != $_SESSION['user']['id']) && ($this->userModel->userExists(intval($user_id)))) {
                if ($this->userModel->getRacket($user_id) != null) {
                    return true;
                }
                $this->setError('Vous ne pouvez pas affronter cet adversaire car il ne possède pas de raquette.');
            }
            else {
                $this->setError('L\'adversaire renseignié n\'existe pas.');
            }
        }
        else {
            $this->setError('Vous devez renseigner un adversaire.');
        }
        return false;
    }

    /**
     * @param int $user_id
     */
    public function fight(int $user_id): void
    {
        $user_data = [
            'user' => $user = $this->userModel->getUserWithID($_SESSION['user']['id']),
            'racket' => $_SESSION['racket'],
            'red' => $_SESSION['red'],
            'black' => $_SESSION['black'],
            'power' => 0
        ];

        $opponent_racket = $this->userModel->getRacket($user_id);

        $opponent_data = [
            'user' => $this->userModel->getUserWithID($user_id),
            'racket' => $this->userModel->getRacket($user_id),
            'red' => $this->userModel->getRedSide($opponent_racket['id']),
            'black' => $this->userModel->getBlackSide($opponent_racket['id']),
            'power' => 0
        ];

        $final = $this->calculatePower($user_data, $opponent_data);

        $user_data = $final['user_data'];
        $opponent_data = $final['opponent_data'];

        if ($user_data['power'] >= $opponent_data['power']) {
            $this->userModel->addVictory($_SESSION['user']['id']);
            $this->userModel->addDefeat($user_id);
            $this->fight_result = 'VICTOIRE';
        }
        else {
            $this->userModel->addVictory($user_id);
            $this->userModel->addDefeat($_SESSION['user']['id']);
            $this->fight_result = 'DEFAITE';
        }
    }

    /**
     * @param array $user_data
     * @param array $opponent_data
     * @return array[]
     */
    private function calculatePower(array $user_data, array $opponent_data): array
    {
        // Racket Speed = 10/u
        // Racket Control = 5/u
        // Racket Rotation = 5/u
        $user_data['power'] = 10 * $user_data['racket']['speed'];
        $user_data['power'] += 5 * $user_data['racket']['control'];
        $user_data['power']+= 5 * $user_data['racket']['rotation'];

        $opponent_data['power'] = 10 * $opponent_data['racket']['speed'];
        $opponent_data['power'] += 5 * $opponent_data['racket']['control'];
        $opponent_data['power'] += 5 * $opponent_data['racket']['rotation'];

        // Red Speed = 3/u
        // Red Control = 7/u
        // Red Rotation = 10/u
        $user_data['power'] = 3 * $user_data['red']['speed'];
        $user_data['power'] += 7 * $user_data['red']['control'];
        $user_data['power']+= 10 * $user_data['red']['rotation'];

        $opponent_data['power'] = 3 * $opponent_data['red']['speed'];
        $opponent_data['power'] += 7 * $opponent_data['red']['control'];
        $opponent_data['power'] += 10 * $opponent_data['red']['rotation'];

        // Black Speed = 3/u
        // Black Control = 7/u
        // Black Rotation = 10/u
        $user_data['power'] = 3 * $user_data['black']['speed'];
        $user_data['power'] += 7 * $user_data['black']['control'];
        $user_data['power']+= 10 * $user_data['black']['rotation'];

        $opponent_data['power'] = 3 * $opponent_data['black']['speed'];
        $opponent_data['power'] += 7 * $opponent_data['black']['control'];
        $opponent_data['power'] += 10 * $opponent_data['black']['rotation'];

        return [
            'user_data' => $user_data,
            'opponent_data' => $opponent_data
        ];
    }

    /**
     * @return string
     */
    public function getFightResult(): string
    {
        return $this->fight_result;
    }
}