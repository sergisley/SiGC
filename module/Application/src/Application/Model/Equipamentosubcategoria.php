<?php

namespace Application\Model;
 
class Equipamentosubcategoria
{
    public $id;
    public $descricao;    
    public $equipamento_categoria_id;
 
    public function exchangeArray($data)
    {
    $this->id                         = (!empty($data['id'])) ? $data['id'] : null;
    $this->descricao                  = (!empty($data['descricao'])) ? $data['descricao'] : null;
    $this->equipamento_categoria_id   = (!empty($data['equipamento_categoria_id'])) ? $data['equipamento_categoria_id'] : null;    
 
    }
}