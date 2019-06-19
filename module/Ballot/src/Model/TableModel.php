<?php 
namespace Ballot\Model;

use Midnet\Model\DatabaseObject;

class TableModel extends DatabaseObject
{
    public $CODE;
    public $NAME;
    
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setPrimaryKey('UUID');
    }
}