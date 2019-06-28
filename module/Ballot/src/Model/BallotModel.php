<?php 
namespace Ballot\Model;

use Midnet\Model\DatabaseObject;

class BallotModel extends DatabaseObject
{
    const ISSUED_STATUS = 100;
    const RETURNED_STATUS = 101;
    
    public $NUMBER;
    public $NAME;
    public $RESIDENCE_ADDR;
    public $MAILING_ADDR;
    public $MAILING_CITY;
    public $MAILING_STATE;
    public $MAILING_ZIP;
    public $VOTING_DISTRICT;
    public $PARTY;
    public $REASON_CODE;
    public $DISTRIBUTION_CODE;
    public $DATE_ISSUED;
    public $DATE_RETURNED;
    
    public function __construct($dbAdapter = NULL) 
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('ballots');
        $this->setPrimaryKey('UUID');
    }
    
    public static function retrieveStatus($status)
    {
        $statuses = [
            NULL => 'Inactive',
            self::INACTIVE_STATUS => 'Inactive',
            self::ACTIVE_STATUS => 'Active',
            self::ISSUED_STATUS => 'Issued',
            self::RETURNED_STATUS => 'Returned',
        ];
        
        return $statuses[$status];
    }
}