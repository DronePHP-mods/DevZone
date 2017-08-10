<?php

return [
    'router' => [
        'routes' => [
            'DevZone' => [
                'module' => 'DevZone',
                'controller' => 'Index',
                'view' => 'index'
            ]
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'default'    => __DIR__ . '/../view/layout/devzone.phtml',
        ],
    ],
];
