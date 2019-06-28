<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Midnet\Exception\Exception;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\AdapterAwareTrait;
use Ballot\Model\BallotModel;

class IndexController extends AbstractActionController
{
    use AdapterAwareTrait;
    
    public function indexAction()
    {
        $view = new ViewModel();
        $sql = new Sql($this->adapter);
        
        /********************************
         * Party Ratio 
         ********************************/
        $select = new Select();
        $select->from('ballots')
            ->columns(['COUNT' => new Expression('COUNT("ballots.NUMBER")')])
            ->join('parties', 'parties.UUID = ballots.PARTY', 'NAME', Select::JOIN_LEFT)
            ->group('NAME');
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = new ResultSet();
        try {
            $results = $statement->execute();
            $resultSet->initialize($results);
        } catch (Exception $e) {
            return $e;
        }
        
        $partyratio = $resultSet->toArray();
        $view->setVariable('partyratio', $partyratio);
        
        /********************************
         * Issuance Ratio
         ********************************/
        $select = new Select();
        $select->from('ballots')
            ->columns(['STATUS', 'COUNT' => new Expression('COUNT(STATUS)')])
            ->group('STATUS');
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = new ResultSet();
        try {
            $results = $statement->execute();
            $resultSet->initialize($results);
        } catch (Exception $e) {
            return $e;
        }
        
        $issuanceratio = $resultSet->toArray();
        
        $model = new BallotModel();
        foreach ($issuanceratio as &$record) {
            $record['STATUS'] = $model::retrieveStatus($record['STATUS']);
        }
        
        $view->setVariable('issuanceratio', $issuanceratio);
            
        return ($view);
    }
}
