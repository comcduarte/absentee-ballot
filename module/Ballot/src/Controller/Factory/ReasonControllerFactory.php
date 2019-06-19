<?php 
namespace Ballot\Controller\Factory;

use Ballot\Controller\ReasonController;
use Ballot\Form\ReasonForm;
use Ballot\Model\ReasonModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class ReasonControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new ReasonController();
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
        
        $adapter = $container->get('ballot-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new ReasonModel($adapter);
        $model->UUID = $uuid->value;
        $model->DATE_CREATED = $today;
        $model->STATUS = $model::ACTIVE_STATUS;
        
        $controller->setModel($model);
        
        $form = $container->get('FormElementManager')->get(ReasonForm::class);
        $controller->setForm($form);
        return $controller;
    }
}