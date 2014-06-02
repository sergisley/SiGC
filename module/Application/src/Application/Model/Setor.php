<?php

namespace Application\Model;
 
class Setor
{
    public $id;
    public $nome;
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->nome                     = (!empty($data['nome'])) ? $data['nome'] : null;
    }
}