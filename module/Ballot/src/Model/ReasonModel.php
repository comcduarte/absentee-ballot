<?php 
namespace Ballot\Model;

class ReasonModel extends TableModel
{
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('reasons');
    }
}
