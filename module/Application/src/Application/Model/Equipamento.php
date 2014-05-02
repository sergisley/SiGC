<?php

namespace Application\Model;
 
class Equipamento
{
    public $id;
    public $descricao  ;
    public $usuario_id;
    public $equipamento_subcategoria_id;
   
 
    public function exchangeArray($data)
    {
    $this->id                            = (!empty($data['id'])) ? $data['id'] : null;
    $this->descricao                     = (!empty($data['descricao'])) ? $data['descricao'] : null;
    $this->usuario_id                    = (!empty($data['usuario_id '])) ? $data['usuario_id '] : null;
    $this->equipamento_subcategoria_id   = (!empty($data['equipamento_subcategoria_id'])) ? $data['equipamento_subcategoria_id'] : null;
    
 
    }
}