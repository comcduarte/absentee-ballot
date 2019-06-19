<?php 
namespace Ballot\Controller;

use Midnet\Controller\AbstractBaseController;
use Zend\View\Model\ViewModel;

class ReasonController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view = parent::indexAction();
        $view->setTemplate('ballot/ballot/index.phtml');
        
        $view->setVariable('indexViewRoute', 'reasons/default');
        
        return ($view);
    }
    
    public function createAction()
    {
        $view = new ViewModel();
        $view = parent::createAction();
        $view->setTemplate('ballot/ballot/create.phtml');
        return ($view);
    }
    
    public function updateAction()
    {
        $view = new ViewModel();
        $view = parent::updateAction();
        $view->setTemplate('ballot/ballot/update.phtml');
        return ($view);
    }
}