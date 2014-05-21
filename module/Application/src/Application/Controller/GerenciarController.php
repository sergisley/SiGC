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
//imports para Empresa
use Application\Model\EmpresaTable as EmpresaDAO;
use Application\Model\Empresa;
use Application\Form\EmpresaForm;

class GerenciarController extends AbstractActionController {

    private $dominio;

    public function __construct() {

        $this->dominio = "http://localhost:8000/";
    }

    public function listarusuariosAction() {
        return new ViewModel();
    }

    public function formularioequipamentosAction() {
        return new ViewModel();
    }

    public function formulariotipoequipamentoAction() {
        return new ViewModel();
    }

    public function formulariocategoriasAction() {
        return new ViewModel();
    }

    public function historicoequipamentoAction() {
        return new ViewModel();
    }

    public function empresasAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);

        try {
            $fetched = $empresa_dao->fetchAll();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
            echo 'erro bd';
        }

        return new ViewModel(array('empresas' => $fetched));
    }

    public function addempresasAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);

        $form = new EmpresaForm();
        $form->get('submit')->setValue('Adicionar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $empresa = new Empresa();
            $form->setInputFilter($empresa->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $empresa->exchangeArray($form->getData());
                $empresa_dao->save($empresa);

                // redirecionando para empresas
                return $this->redirect()->toRoute('gerenciar/empresas');
            }
        }
        return array('form' => $form);
    }

    public function editempresasAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);
        
          $id = (int) $this->params()->fromRoute('id', 0);
  

        try {
            $empresa = $empresa_dao->find($id);
        } catch (\Exception $ex) {
             return $this->redirect()->toRoute('gerenciar/empresas');
        }

        return array(           
            'empresa' => $empresa,
        ); 
    }
    
    public function editempresasaveAction(){
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);
        
             
          $id = (int) $this->params()->fromRoute('id', 0);
          
         $nome = $this->getRequest()->getPost('nome');
         $usuario_id_responsavel = $this->getRequest()->getPost('usuario_id_responsavel');
        
         $empresa = new Empresa();
          
         $empresa->id = $id;
         $empresa->nome = $nome;
         $empresa->usuario_id_responsavel = $usuario_id_responsavel;
         
                $empresa_dao->save($empresa);

                
          return $this->redirect()->toRoute('gerenciar/empresas');           
        
    }
    

    public function delempresasAction() {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            return $this->redirect()->toRoute('gerenciar/empresas');
            //  ($this->url('gerenciar/empresas') . '?msg=empresanotfind')
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $empresa_dao->delete($id);
            }

            // Redirect to list of empresas
            return $this->redirect()->toRoute('gerenciar/empresas');
        }

        return array(
            'id' => $id,
            'empresa' => $empresa_dao->find($id)
        );
    }

}
