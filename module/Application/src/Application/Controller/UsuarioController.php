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
use Application\Model\ChamadoTable as ChamadoDAO;
use Application\Model\Chamado;
use Application\Model\ChamadocategoriaTable as CatchamadoDAO;
use Application\Model\ChamadosubcategoriaTable as SubcatchamadoDAO;
use Application\Model\EquipamentoTable as EquipamentoDAO;
use Application\Model\EquipamentoatributoTable as AtrequipamentoDAO;
use Application\Model\EquipamentocategoriaTable as CatequipamentoDAO;
use Application\Model\EquipamentosubcategoriaTable as SubcatequipamentoDAO;
use Application\Model\EquipamentoporatributoTable as EquipXatrDAO;
use Application\Model\HistoricoTable as HistoricoDAO;
use Application\Model\Historico;
use Application\Model\SetorTable as SetorDAO;
use Application\Model\UsuarioTable as UsuarioDAO;
use Application\Model\Usuario;
use Zend\Json\Json;

class UsuarioController extends AbstractActionController {

    public function perfilAction() {
        return new ViewModel();
    }

    public function listarusuariosAction() {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $usuario_dao = new UsuarioDAO($adapter);
        $setor_dao = new SetorDAO($adapter);


        $usuarios = $usuario_dao->fetchAll();

        $usuarios->buffer();

        $usuariosF = $usuarios;

        foreach ($usuariosF as $usuarioF):

            $setor = $setor_dao->find($usuarioF->setor_id);
            $setores[$usuarioF->id] = $setor->nome;
        endforeach;

        return new ViewModel(array(
            'setores' => $setores,
            'usuarios' => $usuarios,
        ));
    }

    public function exibirusuarioAction() {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $usuario_dao = new UsuarioDAO($adapter);
        $setor_dao = new SetorDAO($adapter);
        
            $id = (int) $this->params()->fromRoute('id', 0);

            $usuario = $usuario_dao->find($id);            
            $setor = $setor_dao->find($usuario->setor_id);            
            $setor_user = $setor->nome;

            return array(
                'usuario' => $usuario,                
                'setor_user' => $setor_user,
            );        
    }
    

    public function addusuarioAction() {
 $adapter = $this->getServiceLocator()->get('AdapterDb');
        $usuario_dao = new UsuarioDAO($adapter);
        $setor_dao = new SetorDAO($adapter);

        $request = $this->getRequest();
        if ($request->isPost()) {
            
             $id = $request->getPost('id');
             $nome = $request->getPost('nome');
             $email = $request->getPost('email');
             $senha = $request->getPost('senha');
             $telefone = $request->getPost('telefone');
             $perfil = $request->getPost('perfil');
             $setor_id = $request->getPost('setor_id');
            
            $usuario = new Usuario;
            
            $usuario->id = $id;
            $usuario->nome = $nome;
            $usuario->email = $email;
            $usuario->senha = $senha;
            $usuario->telefone = $telefone;
            $usuario->perfil = $perfil;
            $usuario->setor_id = $setor_id;
            
            $usuario_dao->save($usuario);
            
            return $this->redirect()->toRoute('usuario');
            
        } else {           
            $setores = $setor_dao->fetchAll();                   
         
            return array(                
                'setores' => $setores,              
            );
        }
    }

    public function editusuarioAction() {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $usuario_dao = new UsuarioDAO($adapter);
        $setor_dao = new SetorDAO($adapter);

        $request = $this->getRequest();
        if ($request->isPost()) {
            
             $id = $request->getPost('id');
             $nome = $request->getPost('nome');
             $email = $request->getPost('email');
             $senha = $request->getPost('senha');
             $telefone = $request->getPost('telefone');
             $perfil = $request->getPost('perfil');
             $setor_id = $request->getPost('setor_id');
            
            $usuario = new Usuario;
            
            $usuario->id = $id;
            $usuario->nome = $nome;
            $usuario->email = $email;
            $usuario->senha = $senha;
            $usuario->telefone = $telefone;
            $usuario->perfil = $perfil;
            $usuario->setor_id = $setor_id;
            
            $usuario_dao->save($usuario);
            
            return $this->redirect()->toRoute('usuario');
            
        } else {
            $id = (int) $this->params()->fromRoute('id', 0);

            $usuario = $usuario_dao->find($id);
            $setores = $setor_dao->fetchAll();
            $setor = $setor_dao->find($usuario->setor_id);            
            $setor_user = $setor->nome;

            return array(
                'usuario' => $usuario,
                'setores' => $setores,
                'setor_user' => $setor_user,
            );
        }
    }

}
