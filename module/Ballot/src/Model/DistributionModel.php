<?php 
namespace Ballot\Model;

class DistributionModel extends TableModel
{
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('distributions');
    }
}