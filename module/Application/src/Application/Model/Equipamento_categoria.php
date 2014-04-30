<?php

namespace Application\Model;
 
class Equipamento_categoria
{
    public $id;
    public $descricao;    
    public $empresa_id;
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->descricao                = (!empty($data['descricao'])) ? $data['descricao'] : null;
    $this->empresa_id               = (!empty($data['empresa_id'])) ? $data['empresa_id'] : null;
        
 
    }
}