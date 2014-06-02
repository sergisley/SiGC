<?php

namespace Application\Model;
 
class Chamadosubcategoria
{
    public $id;
    public $chamado_categoria_id;
    public $descricao;
     
    public function exchangeArray($data)
    {
    $this->id                      = (!empty($data['id'])) ? $data['id'] : null;
    $this->chamado_categoria_id    = (!empty($data['chamado_categoria_id'])) ? $data['chamado_categoria_id'] : null;
    $this->descricao               = (!empty($data['descricao'])) ? $data['descricao'] : null;        
 
    }
}