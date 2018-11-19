<?php
use app\modules\organization\models\orm\Employee;

// todo выпилить этот бред.
return [
    'key' => 'sex',
    'value' => [
        [
            'sex' => Employee::SEX_MALE,
            'name' => 'Мужской',
        ],
        [
            'sex' => Employee::SEX_FEMALE,
            'name' => 'Женский'
        ],
    ],
    'entity' => null,
];