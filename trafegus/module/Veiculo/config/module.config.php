<?php 

namespace Veiculo;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'veiculo' => [
                'type' =>   \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/veiculo[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_\-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\VeiculoController::class,
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
            'veiculo' => __DIR__.'/../view',
        ],
    ],
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'pgsql:dbname=testeweb;host=db',
        'username' => 'testeweb',
        'password' => 'testeweb',
    ],
];