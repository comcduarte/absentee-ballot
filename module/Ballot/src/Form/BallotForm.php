<?php 
namespace Ballot\Form;

use Ballot\Model\BallotModel;
use Midnet\Form\AbstractBaseForm;
use Midnet\Form\Element\DatabaseSelectObject;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Form\Element\Date;
use Zend\Form\Element\Text;

class BallotForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function initialize()
    {
        parent::initialize();
        
        $this->add([
            'name' => 'NUMBER',
            'type' => Text::class,
            'attributes' => [
                'id' => 'NUMBER',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Number',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'NAME',
            'type' => Text::class,
            'attributes' => [
                'id' => 'NAME',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'RESIDENCE_ADDR',
            'type' => Text::class,
            'attributes' => [
                'id' => 'RESIDENCE_ADDR',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Residence Address',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'MAILING_ADDR',
            'type' => Text::class,
            'attributes' => [
                'id' => 'MAILING_ADDR',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Mailing Address',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'MAILING_CITY',
            'type' => Text::class,
            'attributes' => [
                'id' => 'MAILING_CITY',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Mailing City',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'MAILING_STATE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'MAILING_STATE',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Mailing State',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'MAILING_ZIP',
            'type' => Text::class,
            'attributes' => [
                'id' => 'MAILING_ZIP',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Mailing Zip',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'VOTING_DISTRICT',
            'type' => DatabaseSelectObject::class,
            'attributes' => [
                'id' => 'VOTING_DISTRICT',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Voting District',
                'database_adapter' => $this->adapter,
                'database_table' => 'districts',
                'database_id_column' => 'UUID',
                'database_value_column' => 'NAME',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'PARTY',
            'type' => DatabaseSelectObject::class,
            'attributes' => [
                'id' => 'PARTY',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Party',
                'database_adapter' => $this->adapter,
                'database_table' => 'parties',
                'database_id_column' => 'UUID',
                'database_value_column' => 'NAME',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'REASON_CODE',
            'type' => DatabaseSelectObject::class,
            'attributes' => [
                'id' => 'REASON_CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Reason Code',
                'database_adapter' => $this->adapter,
                'database_table' => 'reasons',
                'database_id_column' => 'UUID',
                'database_value_column' => 'NAME',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DISTRIBUTION_CODE',
            'type' => DatabaseSelectObject::class,
            'attributes' => [
                'id' => 'DISTRIBUTION_CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Distribution Code',
                'database_adapter' => $this->adapter,
                'database_table' => 'distributions',
                'database_id_column' => 'UUID',
                'database_value_column' => 'NAME',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DATE_ISSUED',
            'type' => Date::class,
            'attributes' => [
                'id' => 'DATE_ISSUED',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Date Issued',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DATE_RETURNED',
            'type' => Date::class,
            'attributes' => [
                'id' => 'DATE_RETURNED',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Date Returned',
            ],
        ],['priority' => 100]);
        
        $this->get('STATUS')->setOptions([
            'value_options' => [
                BallotModel::ISSUED_STATUS => 'Issued',
                BallotModel::RETURNED_STATUS => 'Returned',
                BallotModel::ACTIVE_STATUS => 'Active',
                BallotModel::INACTIVE_STATUS => 'Inactive',
            ],
        ]);
    }
}