<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class EquipamentoporatributoTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Equipamentoporatributo());

        $this->tableGateway = new TableGateway('equipamento_por_atributo', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela equipamentoporatributo
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela equipamentoporatributo
     * 
     * @param type $id
     * @return \Model\Equipamentoporatributo
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado equipamentoporatributo de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Equipamentoporatributo $equipamentoporatributo) {
        $data = array(
            'id' => $equipamentoporatributo->id,
            'equipamento_id' => $equipamentoporatributo->equipamento_id,
            'equipamento_atributo_id' => $equipamentoporatributo->equipamento_atributo_id,
            'valor_atributo' => $equipamentoporatributo->valor_atributo,
        );

        $id = (int) $$equipamentoporatributo->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Valor não encontrado');
            }
        }
    }

}
