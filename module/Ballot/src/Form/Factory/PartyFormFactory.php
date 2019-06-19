<?php 
namespace Ballot\Form\Factory;

use Ballot\Form\PartyForm;
use Ballot\Model\PartyModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class PartyFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $uuid = new Uuid();
        $form = new PartyForm($uuid->value);
        $model = new PartyModel();
        
        $form->setInputFilter($model->getInputFilter());
//         $form->setDbAdapter($container->get('ballot-model-primary-adapter'));
        $form->initialize();
        return $form;
    }
}