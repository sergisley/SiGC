<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class ChamadosubcategoriaTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Chamadosubcategoria());

        $this->tableGateway = new TableGateway('chamadosubcategoria', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela chamadosubcategoria
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela chamadosubcategoria
     * 
     * @param type $id
     * @return \Model\chamadosubcategoria
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado chamado subcategoria de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Chamadosubcategoria $chamadosubcategoria) {
        $data = array(
            'id' => $chamadosubcategoria->id,
            'nome' => $chamadosubcategoria->descricao,
            'chamado_categoria_id' => $chamadosubcategoria->chamado_categoria_id,
        );

        $id = (int) $chamadosubcategoria->id;
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
