<?php 
namespace Ballot\Form;

use Ballot\Model\ReasonModel;
use Midnet\Form\AbstractBaseForm;
use Zend\Form\Element\Text;

class ReasonForm extends AbstractBaseForm
{
    public function initialize()
    {
        parent::initialize();
        
        $this->add([
            'name' => 'REASON',
            'type' => Text::class,
            'attributes' => [
                'id' => 'REASON',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Reason Description',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'CODE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Reason Code',
            ],
        ],['priority' => 100]);
        
        $this->get('STATUS')->setOptions([
            'value_options' => [
                ReasonModel::ACTIVE_STATUS => 'Active',
                ReasonModel::INACTIVE_STATUS => 'Inactive',
            ],
        ]);
    }
}