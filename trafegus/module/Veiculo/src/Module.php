<?php 

namespace Veiculo;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Veiculo\Controller\VeiculoController;

class Module implements ConfigProviderInterface {

    public function getConfig() {
        return include __DIR__.'/../config/module.config.php';
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                Model\VeiculoTable::class => function  ($container) {
                    $tableGateway = $container->get(Model\VeiculoTableGateway::class);
                    return new Model\VeiculoTable($tableGateway);
                },
                Model\VeiculoTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Veiculo());
                    return new TableGateway('veiculo', $dbAdapter, null, $resultSetPrototype);
                },
            ]
        ];
    }

    public function getControllerConfig() {
        return [
            'factories' => [
                VeiculoController::class => function ($container) {
                    $tableGateway = $container->get(Model\VeiculoTable::class);
                    return new VeiculoController($tableGateway);
                },
            ]
        ];
    }
}