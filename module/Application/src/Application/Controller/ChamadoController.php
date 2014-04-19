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
use Application\Model\ChamadoTable as ModelChamado;

class ChamadoController extends AbstractActionController {

    private $dominio;

    public function __construct() {

        $this->dominio = "http://localhost:8000/";
    }

    public function criarchamadoAction() {
        return new ViewModel();
    }

    /**
     * action listarchamados
     * @return \Zend\View\Model\ViewModel
     */
    public function listarchamadosAction() {
        // localizar adapter do banco
        $adapter = $this->getServiceLocator()->get('AdapterDb');

        // model ChamadoTable instanciado
        $modelChamado = new ModelChamado($adapter); // alias para ChamadoTable

        try {
            $fetched = (array) $modelChamado->fetchAll();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());

            return $this->redirect()->toRoute('index');
        }

        // enviar para view o array com key Chamado e value com todos os chamados
        return new ViewModel(array('chamado' => $fetched));
    }

    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function chamadosabertosAction() {
        return new ViewModel();
    }

    public function pesquisarAction() {
        return new ViewModel();
    }

}
