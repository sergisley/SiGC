<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class Chamado_subcategoriaTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Chamado_subcategoria());

        $this->tableGateway = new TableGateway('chamado_subcategoria', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela chamado_subcategoria
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela chamado_subcategoria
     * 
     * @param type $id
     * @return \Model\chamado_subcategoria
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado chamado_subcategoria de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Chamado_subcategoria $chamado_subcategoria) {
        $data = array(
            'id' => $chamado_subcategoria->id,
            'nome' => $chamado_subcategoria->descricao,
            'chamado_categoria_id' => $chamado_subcategoria->chamado_categoria_id,
        );

        $id = (int) $chamado_subcategoria->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Subcategoria de chamado não encontrada');
            }
        }
    }

}
