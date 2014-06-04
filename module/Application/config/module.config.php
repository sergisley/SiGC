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
                    'listarsetores' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/listarsetores',
                            'defaults' => array(
                                'action' => 'listarsetores'
                            )
                        )
                    ),
                    'addsetores' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/addsetores',
                            'defaults' => array(
                                'action' => 'addsetores'
                            )
                        )
                    ),
                    'editsetores' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/editsetores[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'editsetores'
                            )
                        )
                    ),
                    'delsetores' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/delsetores[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'delsetores'
                            )
                        )
                    ),
                    'exibirequipamento' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/exibirequipamento[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'exibirequipamento'
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
                    'exibirusuario' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/exibirusuario[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'exibirusuario'
                            )
                        )
                    ),
                    'addusuario' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/addusuario',
                            'defaults' => array(
                                'action' => 'addusuario'
                            )
                        )
                    ),

                     'editusuario' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/editusuario[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'editusuario'
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
                    #
                    'exibirchamado' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/exibirchamado[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'exibirchamado'
                            )
                        )
                    ),
                    'movechamado' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/movechamado[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'action' => 'movechamado'
                            )
                        )
                    ),
                    'addchamado' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/addchamado[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),                            
                            'defaults' => array(
                                'action' => 'addchamado'
                            )
                        )
                    ),                    
                    'listarcatchamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/listarcatchamados',
                            'defaults' => array(
                                'action' => 'listarcatchamados'
                            )
                        )
                    ),
                    'editcatchamados' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/editcatchamados[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),                       
                            'defaults' => array(
                                'action' => 'editcatchamados'
                            )
                        )
                    ),
                    'delcatchamados' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/delcatchamados[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),                       
                            'defaults' => array(
                                'action' => 'delcatchamados'
                            )
                        )
                    ),
                    'addcatchamados' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/addcatchamados',                       
                            'defaults' => array(
                                'action' => 'addcatchamados'
                            )
                        )
                    ),
                    
                    'listarsubcatchamados' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/listarsubcatchamados[/:id]',
                            'constraints' => array(
                                'Id' => '[0-9]+',
                            ),                       
                            'defaults' => array(
                                'action' => 'listarsubcatchamados'
                            )
                        )
                    ),  
                ),
            ),
        ),
    ),
    ////////////////////////////////////////////////////////////////////////
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
