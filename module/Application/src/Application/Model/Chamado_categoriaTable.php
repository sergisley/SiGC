<?php
 
// namespace de localizacao do nosso model
namespace Application\Model;
 
// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;
 
class Chamado_categoriaTable
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
        $resultSetPrototype->setArrayObjectPrototype(new Chamado_categoria());
 
        $this->tableGateway = new TableGateway('chamado_categoria', $adapter, null, $resultSetPrototype);
    }
 
    /**
     * Recuperar todos os elementos da tabela chamado_categoria
     * 
     * @return ResultSet
     */
    public function fetchAll()
    {        
        $data = $this->tableGateway->select();
        
        return $data;
    }
 
    /**
     * Localizar linha especifico pelo id da tabela chamado_categoria
     * 
     * @param type $id
     * @return \Model\Chamado_categoria
     * @throws \Exception
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row){
            throw new \Exception("Não foi encontrado chamado_categoria de id = {$id}");
        }
        return $row;
    }
    
    
    public function delete($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
     
           public function save(Chamado_categoria $chamado_categoria)
     {
         $data = array(
             'id' => $chamado_categoria->id,
             'descricao' => $chamado_categoria->descricao,
             'empresa_id' => $chamado_categoria->empresa_id,
         );

         $id = (int) $chamado_categoria->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->find($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Categoria de chamado não encontrada');
             }
         }
     }
     
}