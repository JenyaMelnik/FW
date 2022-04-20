<?php
return [
    'main' => [
        'x' => [],
        'y' => [
            'default' => 'value',
            'req' => 0,
            'rules' => '[0-9]+',
        ],
        'z' => [],
    ],
    '/OPTIONS' => [
        'before' => true,
        'after' => true,
        'config' => true,
        'controller' => true,
        'allpages' => true,
    ]
];