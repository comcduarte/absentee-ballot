<?php 
namespace Ballot\Model;

class PartyModel extends TableModel
{
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('parties');
    }
}