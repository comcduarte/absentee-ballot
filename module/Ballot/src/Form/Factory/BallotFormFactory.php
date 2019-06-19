<?php 
namespace Ballot\Form\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Midnet\Model\Uuid;
use Ballot\Form\BallotForm;
use Ballot\Model\BallotModel;

class BallotFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $uuid = new Uuid();
        $form = new BallotForm($uuid->value);
        $model = new BallotModel();
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($container->get('ballot-model-primary-adapter'));
        $form->initialize();
        return $form;
    }
}