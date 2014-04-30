<?php

namespace Application\Model;
 
class Setor
{
    public $id;
    public $nome;
    public $empresa_id;
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->nome                     = (!empty($data['nome'])) ? $data['nome'] : null;
    $this->empresa_id               = (!empty($data['empresa_id'])) ? $data['empresa_id'] : null;
        
 
    }
}