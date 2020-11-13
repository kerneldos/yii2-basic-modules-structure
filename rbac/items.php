<?php
return [
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'createMessage',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'user',
            'updateMessage',
            'adminPanel',
        ],
    ],
    'createMessage' => [
        'type' => 2,
        'description' => 'Create a Message',
    ],
    'updateMessage' => [
        'type' => 2,
        'description' => 'Update Message',
    ],
    'adminPanel' => [
        'type' => 2,
        'description' => 'Access to Admin Panel',
    ],
];
