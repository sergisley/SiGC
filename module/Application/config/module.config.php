<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'index' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/index',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'logon' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/logon',
                            'defaults' => array(
                                'action' => 'logon'
                            )
                        )
                    ),
                ),
            ),
            // Inicio da rota para GERENCIAR
            'gerenciar' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/gerenciar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Gerenciar',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'listarusuarios' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/listarusuarios',
                            'defaults' => array(
                                'action' => 'listarusuarios'
                            )
                        )
                    ),
                    'formularioequipamentos' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/formularioequipamentos',
                            'defaults' => array(
                                'action' => 'formularioequipamentos'
                            )
                        )
                    ),
                     'formulariotipoequipamento' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/formulariotipoequipamento',
                            'defaults' => array(
                                'action' => 'formulariotipoequipamento'
                            )
                        )
                    ),
                     'formulariocategorias' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/formulariocategorias',
                            'defaults' => array(
                                'action' => 'formulariocategorias'
                            )
                        )
                    ),
                    'historicoequipamento' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/historicoequipamento',
                            'defaults' => array(
                                'action' => 'historicoequipamento'
                            )
                        )
                    ),
                ),
            ),
            // Inicio da rota para PAINEL DE CONTROLE
                'painel' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/painel',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Painel',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array( 
                    'painelcontrole' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/painelcontrole',
                            'defaults' => array(
                                'action' => 'painelcontrole'
                            )
                        )
                    ),
                ),
            ),
            // Inicio da rota para CHAMADOS
                'chamado' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/chamado',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Chamado',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'criarchamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/criarchamados',
                            'defaults' => array(
                                'action' => 'criarchamados'
                            )
                        )
                    ),
                    'formulariochamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/formulariochamados',
                            'defaults' => array(
                                'action' => 'formulariochamados'
                            )
                        )
                    ),
                    'historicochamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/historicochamados',
                            'defaults' => array(
                                'action' => 'historicochamados'
                            )
                        )
                    ),
                    'listarchamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/listarchamados',
                            'defaults' => array(
                                'action' => 'listarchamados'
                            )
                        )
                    ),
                ),
            ),
               // Inicio da rota para USUARIO LOGADO
                'usuario' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/usuario',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Usuario',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array( 
                    'perfil' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/perfil',
                            'defaults' => array(
                                'action' => 'perfil'
                            )
                        )
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Gerenciar' => 'Application\Controller\GerenciarController',
            'Application\Controller\Chamado' => 'Application\Controller\ChamadoController',
            'Application\Controller\Painel' => 'Application\Controller\PainelController',
             'Application\Controller\Usuario' => 'Application\Controller\UsuarioController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
