<?php

// namespace de localizacao do nosso model

namespace Application\Model;

// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class UsuarioTable {

    protected $tableGateway;

    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Usuario());

        $this->tableGateway = new TableGateway('usuario', $adapter, null, $resultSetPrototype);
    }

    /**
     * Recuperar todos os elementos da tabela Usuario
     * 
     * @return ResultSet
     */
    public function fetchAll() {

        $data = $this->tableGateway->select();

        return $data;
    }

    /**
     * Localizar linha especifico pelo id da tabela Usuario
     * 
     * @param type $id
     * @return \Model\Usuario
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado usuário de id = {$id}");
        }
        return $row;
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function save(Usuario $usuario) {
        $data = array(
            'id' => $usuario->id,
            'nome' => $usuario->nome,
            'email' => $usuario->email,
            'senha' => $usuario->senha,
            'telefone' => $usuario->telefone,
            'perfil' => $usuario->perfil,
            'setor_id' => $usuario->setor_id,    
        );

        $id = (int) $usuario->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->find($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Usuário não encontrado.');
            }
        }
    }

}
