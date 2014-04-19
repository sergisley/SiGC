<?php
 
// namespace de localizacao do nosso model
namespace Application\Model;
 
// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;
 
class ChamadoTable
{
    protected $tableGateway;
 
    /**
     * Contrutor com dependencia do Adapter do Banco
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Chamado());
 
        $this->tableGateway = new TableGateway('chamado', $adapter, null, $resultSetPrototype);
    }
 
    /**
     * Recuperar todos os elementos da tabela chamado
     * 
     * @return ResultSet
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
 
    /**
     * Localizar linha especifico pelo id da tabela chamado
     * 
     * @param type $id
     * @return \Model\Chamado
     * @throws \Exception
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row)
            throw new \Exception("Não foi encontrado chamado de id = {$id}");
 
        return $row;
    }
}