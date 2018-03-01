<?php
namespace Portefolio;

use Zend\Router\Http\Segment;


return [
    

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'portefolio' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/portefolio[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PortefolioController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'portefolio' => __DIR__ . '/../view',
        ],
    ],
];

