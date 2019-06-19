<?php 
namespace Ballot\Form\Factory;

use Ballot\Form\ReasonForm;
use Ballot\Model\ReasonModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class ReasonFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $uuid = new Uuid();
        $form = new ReasonForm($uuid->value);
        $model = new ReasonModel();
        
        $form->setInputFilter($model->getInputFilter());
//         $form->setDbAdapter($container->get('ballot-model-primary-adapter'));
        $form->initialize();
        return $form;
    }
}