<?php 
namespace Ballot\Controller;

use Midnet\Controller\AbstractConfigController;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\DropTable;
use Zend\Db\Sql\Ddl\Column\Date;
use Zend\Db\Sql\Ddl\Column\Datetime;
use Zend\Db\Sql\Ddl\Column\Integer;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;

class ConfigController extends AbstractConfigController
{
    public function clearDatabase()
    {
        $sql = new Sql($this->adapter);
        
        $ddl = new DropTable('ballots');
        
        $this->adapter->query($sql->buildSqlString($ddl), $this->adapter::QUERY_MODE_EXECUTE);
    }

    public function createDatabase()
    {
        $sql = new Sql($this->adapter);
        
        $ddl = new CreateTable('ballots');
        $ddl->addColumn(new Varchar('UUID', 36));
        
        $ddl->addColumn(new Integer('NUMBER', TRUE));
        $ddl->addColumn(new Varchar('NAME', 255, TRUE));
        $ddl->addColumn(new Varchar('RESIDENCE_ADDR', 255, TRUE));
        $ddl->addColumn(new Varchar('MAILING_ADDR', 255, TRUE));
        $ddl->addColumn(new Varchar('MAILING_CITY', 255, TRUE));
        $ddl->addColumn(new Varchar('MAILING_STATE', 255, TRUE));
        $ddl->addColumn(new Varchar('MAILING_ZIP', 255, TRUE));
        $ddl->addColumn(new Varchar('VOTING_DISTRICT', 255, TRUE));
        $ddl->addColumn(new Varchar('PARTY', 36, TRUE));
        $ddl->addColumn(new Varchar('REASON_CODE', 36, TRUE));
        $ddl->addColumn(new Varchar('DISTRIBUTION_CODE', 36, TRUE));
        $ddl->addColumn(new Date('DATE_ISSUED', TRUE));
        $ddl->addColumn(new Date('DATE_RETURNED', TRUE));
        
        $ddl->addColumn(new Integer('STATUS', TRUE));
        $ddl->addColumn(new Datetime('DATE_CREATED', TRUE));
        $ddl->addColumn(new Datetime('DATE_MODIFIED', TRUE));
        
        $ddl->addConstraint(new PrimaryKey('UUID'));
        
        $this->adapter->query($sql->buildSqlString($ddl), $this->adapter::QUERY_MODE_EXECUTE);
    }
    
    public function setRoute()
    {
        $this->route = 'ballots/config';
    }

}