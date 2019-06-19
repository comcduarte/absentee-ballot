<?php 
namespace Ballot\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\Factory\FactoryInterface;

class BallotModelPrimaryAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = new Adapter($container->get('ballot-model-primary-adapter-config'));
        return $adapter;
    }
}