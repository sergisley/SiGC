<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class EquipamentosubcategoriaTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Equipamentosubcategoria());

        $this->tableGateway = new TableGateway('equipamentosubcategoria', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela equipamentosubcategoria
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela equipamentosubcategoria
     * 
     * @param type $id
     * @return \Model\Equipamentosubcategoria
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado equipamentosubcategoria de id = {$id}");
        }
        return $row;
    }
    
    
    
    
    
    

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Equipamentosubcategoria $equipamentosubcategoria) {
        $data = array(
            'id' => $equipamentosubcategoria->id,
            'descricao' => $equipamentosubcategoria->descricao,
            'equipamento_categoria_id' => $equipamentosubcategoria->equipamento_categoria_id,
        );

        $id = (int) $equipamentosubcategoria->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Subcategoria de Equipamento não encontrada');
            }
        }
    }

}
