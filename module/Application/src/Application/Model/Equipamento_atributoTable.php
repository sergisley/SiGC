<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class Equipamento_atributoTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Equipamento_atributo());

        $this->tableGateway = new TableGateway('equipamento_atributo', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela equipamento_atributo
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela equipamento_atributo
     * 
     * @param type $id
     * @return \Model\Equipamento_atributo
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado equipamento_atributo de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Equipamento_atributo $equipamento_atributo) {
        $data = array(
            'id' => $equipamento_atributo->id,
            'descricao' => $equipamento_atributo->descricao,
            'equipamento_subcategoria_id' => $equipamento_atributo->equipamento_subcategoria_id,
        );

        $id = (int) $equipamento_atributo->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Atributo não encontrado');
            }
        }
    }

}
