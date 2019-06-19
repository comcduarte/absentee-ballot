<?php 
namespace Ballot\Form\Factory;

use Ballot\Form\DistrictForm;
use Ballot\Model\DistrictModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class DistrictFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $uuid = new Uuid();
        $form = new DistrictForm($uuid->value);
        $model = new DistrictModel();
        
        $form->setInputFilter($model->getInputFilter());
//         $form->setDbAdapter($container->get('ballot-model-primary-adapter'));
        $form->initialize();
        return $form;
    }
}