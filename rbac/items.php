<?php
return [
    'createMessage' => [
        'type' => 2,
        'description' => 'Create a Message',
    ],
    'updateMessage' => [
        'type' => 2,
        'description' => 'Update Message',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'createMessage',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'updateMessage',
            'user',
            'adminPanel',
        ],
    ],
    'adminPanel' => [
        'type' => 2,
        'description' => 'Access to Admin Panel',
    ],
];
