<?php

return [
    'auth' => [
        'page2' => [],
        'login' => [],
        'password' => [],
        'content-type' =>[
            'default' => 'json',
        ],
    ],

    'socials' => [
        'page2' => [],
        'param1' => [],
    ],

    '/OPTIONS' => [
        'controller' => true,
    ]
];


























/*
return [
    'auth' => [
        'page2' => [
            'default' => 'main',
        ],
        'param1' => [],
    ],

    'socials' => [
        'page2' => [
            'default' => 'main'
        ],
        'delete' => [
            'param1' => [],
        ],

//        'param2' => [],
    ],

    '/OPTIONS' => [
        'controller' => true,
    ]
];





'news' => array(
    'view' => array(
        'GET' => array(
            'category' => array(
                'rules' => '[a-zа-яё0-9_-]+',
                'default' => 'all',
                'type' => 'string',
            ),
            'page' => array(
                'rules' => '[0-9]+',
                'default' => 1,
                'type' => 'int',
            ),
        ),
    ),
    'read' => array(
        'GET' => array(
            'id' => array(
                'req' => 1,
                'rules' => '[0-9]+',
            ),
        ),
    ),
),
*/