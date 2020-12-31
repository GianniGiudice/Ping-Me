<?php

require_once 'Service/Service.php';

class WorkshopService extends Service
{
    private $filter_options;

    public function __construct()
    {
        parent::__construct();
        $this->setFilterOptions();
    }


    private function setFilterOptions(): void
    {
        $this->filter_options = [
            'options' => [
                'min_range' => 0,
                'max_range' => 15
            ]
        ];
    }

    /**
     * @param array $form
     * @return bool
     */
    public function checkFormValues(array $form): bool
    {
        $fields_groups = $this->getFields();
        foreach ($fields_groups as $field_group) {
            $sum = 0;
            foreach ($field_group as $field) {
                if (!array_key_exists($field, $form) || (filter_var($form[$field], FILTER_VALIDATE_INT, $this->filter_options) === FALSE)) {
                    $this->setError('Certains champs sont incorrects.');
                    return false;
                }
                $sum += intval($form[$field]);
            }
            if ($sum != 15) {
                $this->setError('La somme doit égaler 15 pour chaque catégorie d\'équipement.');
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    private function getFields(): array
    {
        return [
            'racket' => [
                'racket_speed', 'racket_control', 'racket_rotation'
            ],
            'red' => [
                'red_speed', 'red_control', 'red_rotation'
            ],
            'black' => [
                'black_speed', 'black_control', 'black_rotation'
            ]
        ];
    }
}