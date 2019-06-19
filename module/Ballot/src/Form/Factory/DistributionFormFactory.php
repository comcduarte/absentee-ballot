<?php 
namespace Ballot\Form\Factory;

use Ballot\Form\DistributionForm;
use Ballot\Model\DistributionModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class DistributionFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $uuid = new Uuid();
        $form = new DistributionForm($uuid->value);
        $model = new DistributionModel();
        
        $form->setInputFilter($model->getInputFilter());
//         $form->setDbAdapter($container->get('ballot-model-primary-adapter'));
        $form->initialize();
        return $form;
    }
}