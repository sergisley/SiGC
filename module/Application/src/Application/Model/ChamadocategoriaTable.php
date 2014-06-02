<?php
 
// namespace de localizacao do nosso model
namespace Application\Model;
 
// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;
 
class ChamadocategoriaTable
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
        $resultSetPrototype->setArrayObjectPrototype(new Chamadocategoria());
 
        $this->tableGateway = new TableGateway('chamadocategoria', $adapter, null, $resultSetPrototype);
    }
 
    /**
     * Recuperar todos os elementos da tabela chamadocategoria
     * 
     * @return ResultSet
     */
    public function fetchAll()
    {        
        $data = $this->tableGateway->select();
        
        return $data;
    }
 
    /**
     * Localizar linha especifico pelo id da tabela chamadocategoria
     * 
     * @param type $id
     * @return \Model\Chamadocategoria
     * @throws \Exception
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row){
            throw new \Exception("Não foi encontrado categoria de chamado de id = {$id}");
        }
        return $row;
    }
    
    
    public function delete($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
     
           public function save(Chamadocategoria $chamadocategoria)
     {
         $data = array(
             'id' => $chamadocategoria->id,
             'descricao' => $chamadocategoria->descricao,
             'empresa_id' => $chamadocategoria->empresa_id,
         );

         $id = (int) $chamadocategoria->id;
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