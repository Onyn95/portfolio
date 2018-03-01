<?php
namespace Album;

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
                Model\AlbumTable::class => function($container) {
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    return new Model\AlbumTable($tableGateway);
                },
                                                
                Model\AlbumTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
                    Model\AdministrationTable::class => function($container) {
                    $tableGateway = $container->get(Model\AdministrationTableGateway::class);
                    return new Model\AdministrationTable($tableGateway);
                },
                        
                Model\AdministrationTableGateway::class => function ($container) {
                    
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Administration());
                    return new TableGateway('photo', $dbAdapter, null, $resultSetPrototype);
                },
                        
                  Model\AuthTable::class => function($container) {
                    $tableGateway = $container->get(Model\AuthTableGateway::class);
                    return new Model\AuthTable($tableGateway);
                },
                Model\AuthTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Auth());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },        
                        
            ],
                        
             
        ];
    }
    
    //recupere les controller
    
     public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumController::class => function($container) {
                    return new Controller\AlbumController(
                        $container->get(Model\AlbumTable::class),
                        $container->get(Model\AdministrationTable::class)
                    );
                },
                Controller\AuthController::class => function($container) {
                    return new Controller\AuthController(
                       // $dbAdapter = $container->get(Model\AlbumTableGateway::class)
                    $container->get(Model\AuthTable::class)
                    );
                },
                   Controller\AdministrationController::class => function($container) {
                     
                    return new Controller\AdministrationController(
                       // $dbAdapter = $container->get(Model\AlbumTableGateway::class)
                    $container->get(Model\AdministrationTable::class)
                    );
                },     
                        
            ],
        ];
    }
}
