<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class HistoricoTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Historico());

        $this->tableGateway = new TableGateway('historico', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela historico
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela historico
     * 
     * @param type $id
     * @return \Model\Historico
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado historico de id = {$id}");
        }
        return $row;
    }
    
    public function fetchbychamado($chamado_id){
        
       $chamado_id = (int) $chamado_id;
       $data = $this->tableGateway->select(array('chamado_id' => $chamado_id)); 
        
       return $data; 
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Historico $historico) {
        $data = array(
            'id' => $historico->id,
            'acao' => $historico->acao,
            'usuario_id' => $historico->usuario_id,
            'chamado_id' => $historico->chamado_id,
            'datahora' => $historico->datahora,
            'descricao' => $historico->descricao,
            'equipamento_id' => $historico->equipamento_id,
        );

        $id = (int) $historico->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Histórico não encontrado');
            }
        }
    }

}
