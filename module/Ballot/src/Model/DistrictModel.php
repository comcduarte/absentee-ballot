<?php
namespace Ballot\Model;

class DistrictModel extends TableModel
{
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('districts');
    }
}