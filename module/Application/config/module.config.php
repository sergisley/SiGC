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
            #rota literal para a index
            'index' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    #rota literal para a view contatos
                    'contatos' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => 'index/logon',
                            'defaults' => array(
                                'action' => 'logon'
                            )
                        )
                    ),
                ),
            ),
            #rota literal para o controller gerenciar
            'gerenciar' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/gerenciar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Gerenciar',
                        'action' => 'painel',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'catequipamentos' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/catequipamentos',
                            'defaults' => array(
                                'action' => 'catequipamentos'
                            )
                        )
                    ),
                    'empresas' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/empresas',
                            'defaults' => array(
                                'action' => 'empresas'
                            )
                        )
                    ),
                    'addempresas' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/addempresas',
                            'defaults' => array(
                                'action' => 'addempresas'
                            )
                        )
                    ),
                    'editempresas' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/editempresas[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'editempresas'
                            )
                        )
                    ),
                    'editempresasave' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/editempresasave[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'editempresasave'
                            )
                        )
                    ),
                    
                    'delempresas' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/delempresas',
                            'defaults' => array(
                                'action' => 'delempresas'
                            )
                        )
                    ),
                    'catchamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/catchamados',
                            'defaults' => array(
                                'action' => 'catchamados'
                            )
                        )
                    ),
                ),
            ),
            #rota para o controller usuario
            'usuario' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/usuario',
                    'defaults' => array(
                        'controller' => 'Application\Controller\usuario',
                        'action' => 'listarusuarios',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    #rota literal para action de EXEMPLO
                    'xxxxxxxxx' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/xxxxxxxx',
                            'defaults' => array(
                                'action' => 'xxxxxxxx'
                            )
                        )
                    ),
                ),
            ),
            #rota literal para o controller chamados 
            'chamado' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/chamado',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Chamado',
                        'action' => 'listarchamados',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'criarchamado' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/criarchamado',
                            'defaults' => array(
                                'action' => 'criarchamado'
                            )
                        )
                    ),
                    'chamadosabertos' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/chamadosabertos',
                            'defaults' => array(
                                'action' => 'chamadosabertos'
                            )
                        )
                    ),
                    'pesquisar' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/pesquisar',
                            'defaults' => array(
                                'action' => 'pesquisar'
                            )
                        )
                    ),
                ),
            ),
        // The following is a route to simplify getting started creating
        // new controllers and actions without needing to create a new
        // module. Simply drop new controllers in, and you can access them
        // using the path /application/:controller/:action
        /*

          'index' => array(
          'type' => 'Literal',
          'options' => array(
          'route' => '/',
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
          'chamado' => array(
          'type' => 'Literal',
          'options' => array(
          'route' => '/chamado',
          'defaults' => array(
          '__NAMESPACE__' => 'Application\Controller',
          'controller' => 'Chamado',
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
          ), */
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
