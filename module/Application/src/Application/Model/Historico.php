<?php

namespace Application\Model;
 
class Historico
{
    public $id;
    public $descricao;
    public $acao;
    public $datahora;
    public $chamado_id;
    public $usuario_id;
    
 
    public function exchangeArray($data)
    {
    $this->id                       = (!empty($data['id'])) ? $data['id'] : null;
    $this->descricao                = (!empty($data['descricao'])) ? $data['descricao'] : null;
    $this->acao                     = (!empty($data['acao'])) ? $data['acao'] : null;        
    $this->chamado_id               = (!empty($data['chamado_id'])) ? $data['chamado_id'] : null;
    $this->usuario_id               = (!empty($data['usuario_id '])) ? $data['usuario_id '] : null;    
    $this->datahora                 = (!empty($data['datahora'])) ? $data['datahora'] : null;
        
 
    }
}