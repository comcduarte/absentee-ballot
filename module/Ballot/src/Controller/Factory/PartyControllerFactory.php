<?php 
namespace Ballot\Controller\Factory;

use Ballot\Controller\PartyController;
use Ballot\Form\PartyForm;
use Ballot\Model\PartyModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class PartyControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new PartyController();
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
        
        $adapter = $container->get('ballot-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new PartyModel($adapter);
        $model->UUID = $uuid->value;
        $model->DATE_CREATED = $today;
        $model->STATUS = $model::ACTIVE_STATUS;
        
        $controller->setModel($model);
        
        $form = $container->get('FormElementManager')->get(PartyForm::class);
        $controller->setForm($form);
        return $controller;
    }
}