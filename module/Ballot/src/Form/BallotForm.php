<?php 
namespace Ballot\Form;

use Ballot\Model\BallotModel;
use Midnet\Form\AbstractBaseForm;
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
                'required' => 'true',
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
                'required' => 'true',
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
                'required' => 'true',
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
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Mailing Zip',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'VOTING_DISTRICT',
            'type' => Text::class,
            'attributes' => [
                'id' => 'VOTING_DISTRICT',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Voting District',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'PARTY',
            'type' => Text::class,
            'attributes' => [
                'id' => 'PARTY',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Party',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'REASON_CODE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'REASON_CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Reason Code',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DISTRIBUTION_CODE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'DISTRIBUTION_CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Distribution Code',
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
                'required' => 'true',
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