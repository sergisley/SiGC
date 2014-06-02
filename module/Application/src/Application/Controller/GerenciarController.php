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
//imports para entidade Empresa
use Application\Model\EmpresaTable as EmpresaDAO;
use Application\Model\Empresa;
use Application\Form\EmpresaForm;
//import para entidade Usuário
use Application\Model\UsuarioTable as UsuarioDAO;
use Application\Model\Usuario;
//import para entidade Setor
use Application\Model\SetorTable as SetorDAO;
use Application\Model\Setor;

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

    public function listarempresasAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);
        $usuario_dao = new UsuarioDAO($adapter);

        try {
            $empresas = $empresa_dao->fetchAll();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
            echo 'erro bd';
        }
        $empresas->buffer();
        $empresasF = $empresas;

        $funcionarios = array();
        foreach ($empresasF as $empresaf):

            if ($empresaf->usuario_id_responsavel == 1) {

                 $funcionarios[$empresaf->usuario_id_responsavel] = 'A adicionar';
            } else {
                $usuarioResponsavel = $usuario_dao->find($empresaf->usuario_id_responsavel);

                $funcionarios[$empresaf->usuario_id_responsavel] = $usuarioResponsavel->nome;
            }
        endforeach;


        return new ViewModel(array('empresas' => $empresas,
            'responsaveis' => $funcionarios));
    }

    public function addempresasAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);



        $request = $this->getRequest();
        if ($request->isPost()) {
            $nome = $request->getPost('nome');
            $usuario_id_responsavel = $request->getPost('usuario_id_responsavel');

            $empresa = new Empresa();

            $empresa->id = 0;
            $empresa->nome = $nome;
            $empresa->usuario_id_responsavel = $usuario_id_responsavel;

            $empresa_dao->save($empresa);
        }
    }

    public function editempresasAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);
        $usuario_dao = new UsuarioDAO($adapter);

        $id = (int) $this->params()->fromRoute('id', 0);


        try {
            $empresa = $empresa_dao->find($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('gerenciar/listarempresas');
        }

        if ($empresa->usuario_id_responsavel != 1) {

            $usuarioResponsavel = $usuario_dao->find($empresa->usuario_id_responsavel);

            $responsavel = $usuarioResponsavel->nome;
        } else {
            $responsavel = 'A adicionar';
        }
        $funcionarios = $usuario_dao->findEmpresa($empresa->id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $nome = $request->getPost('nome');
            $usuario_id_responsavel = $request->getPost('usuario_id_responsavel');

            $empresa = new Empresa();

            $empresa->id = $id;
            $empresa->nome = $nome;
            $empresa->usuario_id_responsavel = $usuario_id_responsavel;

            $empresa_dao->save($empresa);


            return $this->redirect()->toRoute('gerenciar/listarempresas');
        }
        return array(
            'empresa' => $empresa,
            'responsavel' => $responsavel,
            'funcionarios' => $funcionarios,
        );
    }

    public function delempresasAction() {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $empresa_dao = new EmpresaDAO($adapter);

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            return $this->redirect()->toRoute('gerenciar/listarempresas');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $empresa_dao->delete($id);
            }

            // Redirect to list of empresas
            return $this->redirect()->toRoute('gerenciar/listarempresas');
        }

        return array(
            'id' => $id,
            'empresa' => $empresa_dao->find($id)
        );
    }
    
    /*
    public function listarsetores(){
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $setor_dao = new SetorDAO($adapter);
      

        try {
            $setores = $setor_dao->fetchAll();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
            echo 'erro bd';
        }
       
        return new ViewModel(array('setores' => $setores));
    }
    */
    
    public function addsetores(){
          return new ViewModel();
    }
    
    public function delsetores(){
          return new ViewModel();
    }
    
    public function editsetores(){
          return new ViewModel();
    }
    
    
    
    
    
    
    
    
    
    
    

}
