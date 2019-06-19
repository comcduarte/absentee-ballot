<?php 
namespace Ballot\Model;

use Midnet\Model\DatabaseObject;

class ReasonModel extends DatabaseObject
{
    public $REASON;
    public $CODE;
    
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('reasons');
        $this->setPrimaryKey('UUID');
    }
}
