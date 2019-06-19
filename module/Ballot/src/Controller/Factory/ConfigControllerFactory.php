<?php 
namespace Ballot\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Ballot\Controller\ConfigController;

class ConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new ConfigController();
        $controller->setDbAdapter($container->get('ballot-model-primary-adapter'));
        $controller->initialize();
        return $controller;
    }
}