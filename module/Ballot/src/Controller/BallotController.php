<?php 
namespace Ballot\Controller;

use Midnet\Controller\AbstractBaseController;
use Midnet\Exception\Exception;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\View\Model\ViewModel;

class BallotController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view = parent::indexAction();
        
        $view->setVariable('indexViewRoute', 'ballots/default');
        
        $sql = new Sql($this->adapter);
        
        $select = new Select();
        $select->from($this->model->getTableName());
        $select->columns(['UUID','NUMBER','NAME','RESIDENCE_ADDR','DATE_ISSUED','STATUS']);
        $select->where(new Where());
        $select->order(['NUMBER']);
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = new ResultSet();
        try {
            $results = $statement->execute();
            $resultSet->initialize($results);
        } catch (Exception $e) {
            return $e;
        }
        
        $records = $resultSet->toArray();
        $view->setVariable('data', $records);
        
        $header = [];
        if (!empty($records)) {
            $header = array_keys($records[0]);
        }
        $view->setVariable('header', $header);
        
        return ($view);
    }
}