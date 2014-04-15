<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ChamadoController extends AbstractActionController
{
   private $dominio;
   
   public function __construct() {
       
       $this->dominio = "http://localhost:8000/"; 
   }
    
     public function criarchamadoAction()
    {
        return new ViewModel();
    }
  
    
          /**
 * action index
 * @return \Zend\View\Model\ViewModel
 */

    public function listarchamadosAction()
    {
 
    /**
     * função anônima para var_dump estilizado
     */
    $myVarDump = function($nome_linha = "Nome da Linha", $data = null, $caracter = ' - ') {
                echo str_repeat($caracter, 100) . '<br/>' . ucwords($nome_linha) . '<pre><br/>';
                var_dump($data);
                echo '</pre>' . str_repeat($caracter, 100) . '<br/><br/>';
            };
 
    /**
     * conexão com banco
     */
    $adapter = new \Zend\Db\Adapter\Adapter(array(
        'driver'    => 'Pdo_Mysql',
        'database'  => 'sigc_db',
        'username'  => 'root',
        'password'  => 'root'
    ));
 
    /**
     * obter nome do sehema do nosso banco
     */
    $myVarDump(
            "Nome Schema", 
            $adapter->getCurrentSchema()
    );
 
    /**
     * contar quantidade de elementos da nossa tabela
     */
    $myVarDump(
            "Quantidade elementos tabela chamados", 
            $adapter->query("SELECT * FROM `chamado`")->execute()->count()
    );
 
    /**
     * montar objeto sql e executar
     */
    $sql        = new \Zend\Db\Sql\Sql($adapter);
    $select     = $sql->select()->from('chamado');
    $statement  = $sql->prepareStatementForSqlObject($select);
    $resultsSql = $statement->execute();
    $myVarDump(
            "Objet Sql com Select executado",
            $resultsSql
    );
 
    /**
     * motar objeto resultset com objeto sql e mostrar resultado em array
     */
    $resultSet = new \Zend\Db\ResultSet\ResultSet;
    $resultSet->initialize($resultsSql);
    $myVarDump(
            "Resultado do Objeto Sql para Array ",
            $resultSet->toArray()
    );
    die(); 
        
        
        
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
     public function chamadosabertosAction()
    {
        return new ViewModel();
    }
    public function pesquisarAction()
    {
        return new ViewModel();
    } 
     
    
    
}
