<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
/**
 * namespace de localizacao do nosso controller
 */

namespace Application\Controller;

// import Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;
// import Zend\View
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// imort Models com alias
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
/////////////////////////
use Zend\Json\Json;
use DateTime;

class ChamadoController extends AbstractActionController {

    public function listarchamadosAction() {
        // localizar adapter do banco
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $chamado_dao = new ChamadoDAO($adapter);
        $usuario_dao = new UsuarioDAO($adapter);
        $equipamento_dao = new EquipamentoDAO($adapter);
        $sub_cat_chamado_dao = new SubcatchamadoDAO($adapter);
        $cat_chamado_dao = new CatchamadoDAO($adapter);
        try {
            $chamados = $chamado_dao->fetchAll();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
            echo 'erro bd';
        }
        $chamados->buffer();

        $chamadosF = $chamados;

        foreach ($chamadosF as $chamadoF):

            $usuario = $usuario_dao->find($chamadoF->usuario_id);
            $usuarios[$chamadoF->usuario_id] = $usuario->nome;

            if($chamadoF->usuario_id_tecnico == 0){
                 $tecnicos[$chamadoF->usuario_id_tecnico] = 'Sem Técnico';
            }else{
            $tecnico = $usuario_dao->find($chamadoF->usuario_id_tecnico);
            $tecnicos[$chamadoF->usuario_id_tecnico] = $tecnico->nome;
            }
            $equipamento = $equipamento_dao->find($chamadoF->equipamento_id);
            $equipamentos[$chamadoF->equipamento_id] = $equipamento->descricao;

            $subcategoriachamado = $sub_cat_chamado_dao->find($chamadoF->chamado_subcategoria_id);
            $subcategoriachamados[$chamadoF->chamado_subcategoria_id] = $subcategoriachamado->descricao;

            $categoriachamado = $cat_chamado_dao->find($subcategoriachamado->chamado_categoria_id);
            $categoriachamados[$chamadoF->chamado_subcategoria_id] = $categoriachamado->descricao;

        endforeach;

        return new ViewModel(array(
            'chamados' => $chamados,
            'usuarios' => $usuarios,
            'tecnicos' => $tecnicos,
            'equipamentos' => $equipamentos,
            'subcategoriachamados' => $subcategoriachamados,
            'categoriachamados' => $categoriachamados,
        ));
    }

    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function exibirchamadoAction() {

        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $chamado_dao = new ChamadoDAO($adapter);
        $usuario_dao = new UsuarioDAO($adapter);
        $sub_cat_chamado_dao = new SubcatchamadoDAO($adapter);
        $cat_chamado_dao = new CatchamadoDAO($adapter);
        $equipamento_dao = new EquipamentoDAO($adapter);
        $cat_equipamento_dao = new CatequipamentoDAO($adapter);
        $sub_cat_equipamento_dao = new SubcatequipamentoDAO($adapter);
        $historico_dao = new HistoricoDAO($adapter);

        $id = (int) $this->params()->fromRoute('id', 0);

        $chamado = $chamado_dao->find($id);

        $chamadof = $chamado;
        
        if($chamadof->usuario_id_tecnico == 0){
            $tecnico = 'Sem Técnico';
        }else{
        $tecnicoEnt = $usuario_dao->find($chamadof->usuario_id_tecnico);
        $tecnico = $tecnicoEnt->nome;
        }
        $usuarioEnt = $usuario_dao->find($chamadof->usuario_id);
        $usuario = $usuarioEnt->nome;
        $sub_cat_chamadoEnt = $sub_cat_chamado_dao->find($chamadof->chamado_subcategoria_id);
        $sub_cat_chamado = $sub_cat_chamadoEnt->descricao;
        $cat_chamadoEnt = $cat_chamado_dao->find($sub_cat_chamadoEnt->chamado_categoria_id);
        $cat_chamado = $cat_chamadoEnt->descricao;
        $equipamentoEnt = $equipamento_dao->find($chamadof->equipamento_id);
        $equipamento = $equipamentoEnt->descricao;
        $sub_cat_equipamentoEnt = $sub_cat_equipamento_dao->find($equipamentoEnt->equipamento_subcategoria_id);
        $sub_cat_equipamento = $sub_cat_equipamentoEnt->descricao;
        $cat_equipamentoEnt = $cat_equipamento_dao->find($sub_cat_equipamentoEnt->equipamento_categoria_id);
        $cat_equipamento = $cat_equipamentoEnt->descricao;
        
        $historicos = $historico_dao->fetchbychamado($id);
       

        $historicosf = $historicos->buffer();
        
        foreach ($historicosf as $historicof):
            $hist_user_id = $usuario_dao->find($historicof->usuario_id);
            $hist_users[$historicof->id] = $hist_user_id->nome;            
            $hist_perfil[$historicof->id] = $hist_user_id->perfil;
        endforeach;
        

        return array(
            'chamado' => $chamado,
            'tecnico' => $tecnico,
            'usuario' => $usuario,
            'sub_cat_chamado' => $sub_cat_chamado,
            'cat_chamado' => $cat_chamado,
            'equipamento' => $equipamento,
            'cat_equipamento' => $cat_equipamento,
            'sub_cat_equipamento' => $sub_cat_equipamento,
            'historicos' => $historicos,
            'hist_users' => $hist_users,
            'hist_perfil' => $hist_perfil,
        );
    }

//////////////////////////////////////////////////////////////////////////////////
    public function addchamadoAction() {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $chamado_dao = new ChamadoDAO($adapter);
        $historico_dao = new HistoricoDAO($adapter);
        $equipamento_dao = new EquipamentoDAO($adapter);
        $usuario_dao = new UsuarioDAO($adapter);
        $catchamado_dao = new CatchamadoDAO($adapter);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $id_usuario = $request->getPost('id_usuario');
            $equipamento_id = $request->getPost('equipamento_id');
            $chamado_subcategoria_id = $request->getPost('chamado_subcategoria_id');
            $descricao = $request->getPost('descricao');

            $chamado = new Chamado();

            $chamado->id = 0;
            $chamado->chamado_status = 'aberto';
            $chamado->usuario_id = $id_usuario;
            $chamado->usuario_id_tecnico = 0;
            $chamado->chamado_subcategoria_id = $chamado_subcategoria_id;
            $chamado->equipamento_id = $equipamento_id;

            $chamado_id = $chamado_dao->save($chamado);
                        
            $historico = new Historico;            
            
            $historico->id = 0;
            $historico->descricao = $descricao;
            $historico->acao = 'abertura';
            $historico->usuario_id = $id_usuario;
            $historico->chamado_id = $chamado_id;
            $historico->equipamento_id = $equipamento_id;

            $historico_dao->save($historico);

            return $this->redirect()->toRoute('chamado');
        } else {

            $id = (int) $this->params()->fromRoute('id', 0);

            $usuario = $usuario_dao->find($id);

            if ($usuario->perfil == 'Usuário') {
                $equipamentos = $equipamento_dao->findsetor($usuario->setor_id);
            } else {
                $equipamentos = $equipamento_dao->fetchAll();
            }

            $catchamados = $catchamado_dao->fetchAll();

            return array(
                'equipamentos' => $equipamentos,
                'catchamados' => $catchamados,
            );
        }
    }
/////////////////////////////////////////////////////////////////////////////////
    public function editchamadoAction() {
       /* $adapter = $this->getServiceLocator()->get('AdapterDb');
        $chamado_dao = new ChamadoDAO($adapter);
        $historico_dao = new HistoricoDAO($adapter);        
        $usuario_dao = new UsuarioDAO($adapter);
        $catchamado_dao = new CatchamadoDAO($adapter);
        
        $id = (int) $this->params()->fromRoute('id', 0);

        $chamado = $chamado_dao->find($id);
        
        
        
        
        */
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
/////////////////////////////////////////////////////////////////////////////////
  /* public function ajaxsubcatchamado() {
        
       return new JsonModel(array(
                'nome' => 'Douglas V. Pasqua',
                'email' => 'blablabla@bla.xyz',
        ));

       /*
       $adapter = $this->getServiceLocator()->get('AdapterDb');
        $subcatchamado_dao = SubcatchamadoDAO($adapter);

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }

        $catchamado = $subcatchamado_dao->fetchbycatchamado($id);

        $cat['ignorar'] = null;

        foreach ($catchamado as $cat) :
            $data[$cat->id] = $cat->descricao;
        endforeach;
       
        return $this->getResponse()->setContent(Json::encode($data));
        
        
    }  */
      

}
