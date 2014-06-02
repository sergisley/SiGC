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
// imort Model\ChamadoTable com alias
use Application\Model\ChamadoTable as ChamadoDAO;
use Application\Model\ChamadocategoriaTable as CatchamadoDAO;
use Application\Model\ChamadosubcategoriaTable as SubcatchamadoDAO;
use Application\Model\EquipamentoTable as EquipamentoDAO;
use Application\Model\EquipamentoatributoTable as AtrequipamentoDAO;
use Application\Model\EquipamentocategoriaTable as CatequipamentoDAO;
use Application\Model\EquipamentosubcategoriaTable as SubcatequipamentoDAO;
use Application\Model\EquipamentoporatributoTable as EquipXatrDAO;
use Application\Model\HistoricoTable as HistoricoDAO;
use Application\Model\SetorTable as SetorDAO;
use Application\Model\UsuarioTable as UsuarioDAO;

class ChamadoController extends AbstractActionController {

    public function listarchamadosAction() {
        // localizar adapter do banco
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        $modelChamado = new ChamadoDAO($adapter);
        $usuario_dao = new UsuarioDAO($adapter);
        $equipamento_dao = new EquipamentoDAO($adapter);
        $sub_cat_chamado_dao = new SubcatchamadoDAO($adapter);
        $cat_chamado_dao = new CatchamadoDAO($adapter);
        try {
            $chamados = $modelChamado->fetchAll();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
            echo 'erro bd';
        }
        $chamados->buffer();

        $chamadosF = $chamados;

        foreach ($chamadosF as $chamadoF):

            $usuario = $usuario_dao->find($chamadoF->usuario_id);
            $usuarios[$chamadoF->usuario_id] = $usuario->nome;

            $tecnico = $usuario_dao->find($chamadoF->usuario_id_tecnico);
            $tecnicos[$chamadoF->usuario_id_tecnico] = $tecnico->nome;

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

        $id = (int) $this->params()->fromRoute('id', 0);

        $chamado = $chamado_dao->find($id);

        $chamadof = $chamado;

        $tecnicoEnt = $usuario_dao->find($chamadof->usuario_id_tecnico);
        $tecnico = $tecnicoEnt->nome;
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

        return array(
            'chamado' => $chamado,
            'tecnico' => $tecnico,
            'usuario' => $usuario,
            'sub_cat_chamado' => $sub_cat_chamado,
            'cat_chamado' => $cat_chamado,
            'equipamento' => $equipamento,
            'cat_equipamento' => $cat_equipamento,
            'sub_cat_equipamento' => $sub_cat_equipamento,
        );
    }

    public function pesquisarAction() {
        return new ViewModel();
    }

}
