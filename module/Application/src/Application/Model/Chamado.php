<?php

namespace Application\Model;
 
class Chamado
{
    public $id;
    public $chamado_status;
    public $usuario_id;
    public $empresa_id;
    public $equipamento_id;
    public $chamado_categoria_id;
    public $chamado_subcategoria_id;
    public $usuario_id_tecnico;
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->chamado_status           = (!empty($data['chamado_status  '])) ? $data['chamado_status  '] : null;
    $this->usuario_id               = (!empty($data['usuario_id'])) ? $data['usuario_id'] : null;
    $this->empresa_id               = (!empty($data['empresa_id'])) ? $data['empresa_id'] : null;
    $this->equipamento_id           = (!empty($data['equipamento_id  '])) ? $data['equipamento_id  '] : null;
    $this->chamado_categoria_id     = (!empty($data['chamado_categoria_id '])) ? $data['chamado_categoria_id '] : null;
    $this->chamado_subcategoria_id  = (!empty($data['chamado_subcategoria_id'])) ? $data['chamado_subcategoria_id'] : null;
    $this->usuario_id_tecnico       = (!empty($data['usuario_id_tecnico   '])) ? $data['usuario_id_tecnico   '] : null;
        
 
    }
}