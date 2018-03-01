<?php
namespace Portefolio;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
     public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\PortefolioTable::class => function($container) {
                    $tableGateway = $container->get(Model\PortefolioTableGateway::class);
                    return new Model\PortefolioTable($tableGateway);
                },
                Model\PortefolioTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Portefolio());
                    return new TableGateway('portefolio', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
    
     public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\PortefolioController::class => function($container) {
                    return new Controller\PortefolioController(
                        $container->get(Model\PortefolioTable::class)
                    );
                },
            ],
        ];
    }
}
