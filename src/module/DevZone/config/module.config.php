<?php

return array(
    'router' => array(
        'routes' => array(
            'DevZone' => array(
                'module' => 'DevZone',
                'controller' => 'Index',
                'view' => 'index'
            )
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'default'    => dirname(__FILE__) . '/../view/layout/devzone.phtml',
        ),
    ),
);
