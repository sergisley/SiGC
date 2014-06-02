<?php

namespace Application\Model;
 
class Usuario
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;
    public $perfil;
    public $setor_id;
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->nome                     = (!empty($data['nome'])) ? $data['nome'] : null;
    $this->email                    = (!empty($data['email'])) ? $data['email'] : null;    
    $this->senha                    = (!empty($data['senha'])) ? $data['senha'] : null;    
    $this->telefone                 = (!empty($data['telefone'])) ? $data['telefone'] : null;
    $this->perfil                   = (!empty($data['perfil']))  ? $data['perfil'] : null;
    $this->setor_id                 = (!empty($data['setor_id'])) ? $data['setor_id'] : null;   
 
    }
}