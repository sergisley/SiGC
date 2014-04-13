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

class GerenciarController extends AbstractActionController
{
   private $dominio;
   
   public function __construct() {
       
       $this->dominio = "http://localhost:8000/"; 
   }
    
   
   
    public function painelAction()
    {
        return new ViewModel();
         
    }
    
     public function auditoriaAction()
    {
        return new ViewModel();
         
    }
    public function catequipamentosAction()
    {
        return new ViewModel();
         
    }
    public function catchamadosAction()
    {
        return new ViewModel();
         
    }
    
    
    
    
    
    
}
