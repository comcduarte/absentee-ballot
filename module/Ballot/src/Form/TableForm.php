<?php 
namespace Ballot\Form;

use Midnet\Form\AbstractBaseForm;
use Zend\Form\Element\Text;

class TableForm extends AbstractBaseForm
{
    public function initialize()
    {
        parent::initialize();
        
        $this->add([
            'name' => 'CODE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Code',
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
    }
}
