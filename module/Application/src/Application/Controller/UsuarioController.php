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
//entidade usuario
use Application\Model\UsuarioTable as UsuarioDAO;
use Application\Model\Usuario;
use Zend\Json\Json;

class UsuarioController extends AbstractActionController
{
    public function perfilAction()
    {
        return new ViewModel();
    }
    
    public function nomefuncionarioAction(){
        $adapter = $this->getServiceLocator()->get('AdapterDb');        
        $usuario_dao = new UsuarioDAO($adapter);
        
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }
            
           $usuario = $usuario_dao->find($id);   
                  
           $nome = $usuario->nome;
           
         $data = array(
            'nome' =>$nome,
        );

        return $this->getResponse()->setContent(Json::encode($data));
    }
    
}
