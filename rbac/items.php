<?php
return [
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'children' => [
            'user',
        ],
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'children' => [
            'FL',
            'IP',
            'UL',
        ],
    ],
    'FL' => [
        'type' => 1,
        'description' => 'ФЛ',
    ],
    'IP' => [
        'type' => 1,
        'description' => 'ИП',
    ],
    'UL' => [
        'type' => 1,
        'description' => 'ЮЛ',
    ],
];
