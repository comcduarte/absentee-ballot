<?php 
namespace Ballot\Controller\Factory;

use Ballot\Controller\BallotController;
use Ballot\Form\BallotForm;
use Ballot\Model\BallotModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class BallotControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new BallotController();
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
        
        $adapter = $container->get('ballot-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new BallotModel($adapter);
        $model->UUID = $uuid->value;
        $model->DATE_CREATED = $today;
        $model->STATUS = $model::ACTIVE_STATUS;
        
        $controller->setModel($model);
        
        $form = $container->get('FormElementManager')->get(BallotForm::class);
        $controller->setForm($form);
        return $controller;
    }
}