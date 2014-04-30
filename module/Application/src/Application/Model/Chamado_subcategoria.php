<?php

namespace Application\Model;
 
class Chamado_subcategoria
{
    public $id;
    public $chamado_categoria;
    public $empresa_id;
     
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->chamado_categoria        = (!empty($data['chamado_categoria'])) ? $data['chamado_categoria'] : null;
    $this->empresa_id               = (!empty($data['empresa_id'])) ? $data['empresa_id'] : null;        
 
    }
}