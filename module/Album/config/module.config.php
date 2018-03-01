<?php
namespace Album;

use Zend\Router\Http\Segment;


return [
    

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'album' => [
                'type'    => Segment::class,
                'options' => [                   
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                  
                ],
            ], 
            'auth' => [
                'type'    => Segment::class,
                'options' => [                   
                    'route' => '/auth[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'index',
                    ],
                  
                ],
            ],
            
            'admin' => [
                'type'    => Segment::class,
                'options' => [                   
                    'route' => '/admin[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdministrationController::class,
                        'action'     => 'index',
                    ],
                  
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
        
        'template_path_stack' => [
            'admins' => __DIR__ . '/../view',
        ],
    ],
];

