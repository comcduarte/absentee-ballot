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
    
    public function returnAction() 
    {
        $view = new ViewModel();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $date = new \DateTime('now',new \DateTimeZone('EDT'));
            $today = $date->format('Y-m-d');
            
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
                );
            
            foreach ($post['RETURNS'] as $uuid) {
                $this->model->read(['UUID' => $uuid]);
                $this->model->STATUS = $this->model::RETURNED_STATUS;
                $this->model->DATE_RETURNED = $today;
                $this->model->update();
            }
            
        }
        
        $sql = new Sql($this->adapter);
        
        $select = new Select();
        $select->from($this->model->getTableName())
            ->columns(['UUID','NUMBER'])
            ->where(['STATUS' => $this->model::ISSUED_STATUS]);
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = new ResultSet();
        try {
            $results = $statement->execute();
            $resultSet->initialize($results);
        } catch (Exception $e) {
            return $e;
        }
        
        $records = $resultSet->toArray();
        $data = [];
        foreach ($records as $record) {
            $data[$record['UUID']] = $record['NUMBER'];
        }
        
        
        $view->setVariable('data', $data);
        
        
        return ($view);
    }
}