<?php 

namespace Motorista;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Motorista\Controller\MotoristaController;

class Module implements ConfigProviderInterface {
    public function getConfig() {
        return include __DIR__.'/../config/module.config.php';
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                Model\MotoristaTable::class => function ($container) {
                    $tableGateway = $container->get(Model\MotoristaTableGateway::class);
                    return new Model\MotoristaTable($tableGateway);
                },
                Model\MotoristaTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Motorista());
                    return new TableGateway('motorista', $dbAdapter, null, $resultSetPrototype);
                },
                Model\VeiculoTable::class => function ($container) {
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
                MotoristaController::class => function ($container) {
                    $motoristaTable = $container->get(Model\MotoristaTable::class);
                    $veiculoTable = $container->get(Model\VeiculoTable::class);
                    return new MotoristaController($motoristaTable, $veiculoTable);
                },
            ]
        ];
    }
}
