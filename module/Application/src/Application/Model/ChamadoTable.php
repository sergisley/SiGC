<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class ChamadoTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Chamado());

        $this->tableGateway = new TableGateway('chamado', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela chamado
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela chamado
     * 
     * @param type $id
     * @return \Model\Chamado
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado chamado de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Chamado $chamado) {
        $data = array(
            'id' => $chamado->id,
            'chamado_status' => $chamado->chamado_status,
            'usuario_id' => $chamado->usuario_id,
            'equipamento_id' => $chamado->equipamento_id,
            'chamado_categoria_id' => $chamado->chamado_categoria_id,
            'chamado_subcategoria_id' => $chamado->chamado_subcategoria_id,
            'usuario_id_tecnico' => $chamado->usuario_id_tecnico,
        );

        $id = (int) $chamado->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Chamado não encontrado');
            }
        }
    }

}
