<?php

namespace Application\Model;
 
class Equipamentoatributo
{
    public $id;
    public $descricao;
    public $equipamento_subcategoria_id;
   
 
    public function exchangeArray($data)
    {
    $this->id                            = (!empty($data['id'])) ? $data['id'] : null;
    $this->descricao                     = (!empty($data['descricao'])) ? $data['descricao'] : null;
    $this->equipamento_subcategoria_id   = (!empty($data['equipamento_subcategoria_id'])) ? $data['equipamento_subcategoria_id'] : null;
        
 
    }
}