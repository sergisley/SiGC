<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class Equipamento_subcategoriaTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Equipamento_subcategoria());

        $this->tableGateway = new TableGateway('equipamento_subcategoria', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela equipamento_subcategoria
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela equipamento_subcategoria
     * 
     * @param type $id
     * @return \Model\Equipamento_subcategoria
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado equipamento_subcategoria de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Equipamento_subcategoria $equipamento_subcategoria) {
        $data = array(
            'id' => $equipamento_subcategoria->id,
            'descricao' => $equipamento_subcategoria->descricao,
            'equipamento_categoria_id' => $equipamento_subcategoria->equipamento_categoria_id,
        );

        $id = (int) $equipamento_subcategoria->id;
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
