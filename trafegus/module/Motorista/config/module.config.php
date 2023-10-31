<?php 

namespace Motorista;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'motorista' => [
                'type' =>   \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/motorista[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_\-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\MotoristaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'motorista' => __DIR__.'/../view',
        ],
    ],
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'pgsql:dbname=testeweb;host=db',
        'username' => 'testeweb',
        'password' => 'testeweb',
    ],
];