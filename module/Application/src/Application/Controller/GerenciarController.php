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
use Application\Model\EmpresaTable as EmpresaChamado;

class GerenciarController extends AbstractActionController
{
   private $dominio;
   
   public function __construct() {
       
       $this->dominio = "http://localhost:8000/"; 
   }
    
   
   
    public function listarusuariosAction()
    {
        return new ViewModel();
         
    }
    
     public function formularioequipamentosAction()
    {
        return new ViewModel();
         
    }
    public function formulariotipoequipamentoAction()
    {
        return new ViewModel();
         
    }
    public function formulariocategoriasAction()
    {
        return new ViewModel();
         
    }
     public function historicoequipamentoAction()
    {
        return new ViewModel();
         
    }
    public function empresasAction(){
      
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresaChamado = new EmpresaChamado($adapter);
        try {
            $fetched = $empresaChamado->fetchAll();
            
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
            echo 'erro bd';
            //return $this->redirect()->toRoute('index');
        }
        
        return new ViewModel(array('empresas' => $fetched));       
        // return new ViewModel();
    }
    
    
    
    
    
}
