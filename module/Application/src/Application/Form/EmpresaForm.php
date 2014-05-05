<?php
namespace Application\Form;

 use Zend\Form\Form;

 class EmpresaForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('empresa');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'nome',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nome:  ',
                
             ),
             'attributes' => array(
                 'class' => 'form-control',
                 )
         ));
         $this->add(array(
             'name' => 'usuario_id_responsavel',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Gerente Responsável:',
                
             ),
             'attributes' => array(
                 'class' => 'form-control',
                 )
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Salvar',
                 'id' => 'submitbutton',
                 'class' => 'btn btn-sm btn-success',
             ),
         ));
     }
 }