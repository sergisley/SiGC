<?php
 
// namespace de localizacao do nosso model
namespace Application\Model;
 
// import Zend\Db
use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;
 
class EmpresaTable
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
        $resultSetPrototype->setArrayObjectPrototype(new Empresa());
 
        $this->tableGateway = new TableGateway('empresa', $adapter, null, $resultSetPrototype);
    }
 
    /**
     * Recuperar todos os elementos da tabela empresa
     * 
     * @return ResultSet
     */
    public function fetchAll()
    {
        
        $data = $this->tableGateway->select();
        
        return $data;
    }
 
    /**
     * Localizar linha especifico pelo id da tabela empresa
     * 
     * @param type $id
     * @return \Model\empresa
     * @throws \Exception
     */
    public function find($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row){
            throw new \Exception("Não foi encontrado empresa de id = {$id}");
        }
        return $row;
    }
    
    
    public function delete($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
     
      public function save(Empresa $empresa)
     {
         $data = array(
             'id' => $empresa->id,
             'nome'  => $empresa->nome,
            'usuario_id_responsavel' => $empresa->usuario_id_responsavel,
         );

         $id = (int) $empresa->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
        //     if ($this->find($id)) {
                // throw new \Exception('Empresa encontrada!!!');
                 $this->tableGateway->update($data, array('id' => $id));
       //      } else {
        //         throw new \Exception('Empresa não encontrada');
          //   }
         }
     }
     
}