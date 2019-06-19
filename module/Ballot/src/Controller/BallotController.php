<?php 
namespace Ballot\Controller;

use Midnet\Controller\AbstractBaseController;
use Zend\View\Model\ViewModel;

class BallotController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view = parent::indexAction();
        
        $view->setVariable('indexViewRoute', 'ballots/default');
        
        return ($view);
    }
}