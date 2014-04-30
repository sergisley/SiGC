<?php

namespace Application\Model;
 
class Equipamento_por_atributo
{
    public $id;
    public $valor_atributo;
    public $equipamento_id;
    public $equipamento_atributo_id;
   

    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->valor_atributo        = (!empty($data['valor_atributo'])) ? $data['valor_atributo'] : null;
    $this->equipamento_id           = (!empty($data['equipamento_id  '])) ? $data['equipamento_id  '] : null;
    $this->equipamento_atributo_id              = (!empty($data['equipamento_atributo_id'])) ? $data['equipamento_atributo_id'] : null;
        
 
    }
}