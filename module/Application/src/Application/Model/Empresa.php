<?php

namespace Application\Model;
 
class Empresa
{
    public $id;
    public $nome;
    public $usuario_id_responsavel;
 
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->nome                     = (!empty($data['nome'])) ? $data['nome'] : null;
    $this->usuario_id_responsavel   = (!empty($data['usuario_id_responsavel'])) ? $data['usuario_id_responsavel'] : null;
     
    }
}