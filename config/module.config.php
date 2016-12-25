<?php
return array(
    'module' => array(
        'Acl' => array(
            'name' => 'Acl',
            'version' => '1.0.1',
            'install' => array(
                'require' => array(
                    'AclResource',
                    'AclRole'
                ),
                'sql' => 'sql/acl.sql'
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Acl\Controller\ConsoleController' => 'Acl\Controller\Factory\ConsoleControllerFactory',
            'Acl\Controller\CreateController' => 'Acl\Controller\Factory\CreateControllerFactory',
            'Acl\Controller\DeleteController' => 'Acl\Controller\Factory\DeleteControllerFactory',
            'Acl\Controller\IndexController' => 'Acl\Controller\Factory\IndexControllerFactory',
            'Acl\Controller\RestController' => 'Acl\Controller\Factory\RestControllerFactory',
            'Acl\Controller\UpdateController' => 'Acl\Controller\Factory\UpdateControllerFactory',
            'Acl\Controller\ViewController' => 'Acl\Controller\Factory\ViewControllerFactory'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'Acl' => 'Acl\Controller\Plugin\Factory\AclControllerPluginFactory'
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Acl\Service\ServiceInterface' => 'Acl\Service\Factory\ServiceFactory',
            'Acl\Mapper\MysqlMapperInterface' => 'Acl\Mapper\Factory\MysqlMapperFactory',
            'Acl\Form\Form' => 'Acl\Form\Factory\FormFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'acl-create' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/create',
                    'defaults' => array(
                        'controller' => 'Acl\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'acl-delete' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/delete/[:id]',
                    'defaults' => array(
                        'controller' => 'Acl\Controller\DeleteController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            ),
            'acl-index' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/acl',
                    'defaults' => array(
                        'controller' => 'Acl\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'acl-rest' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Rest',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/api/acl[/:id]',
                    'defaults' => array(
                        'controller' => 'Acl\Controller\RestController',
                    )
                )
            ),
            'acl-update' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/update/[:id]',
                    'defaults' => array(
                        'controller' => 'Acl\Controller\UpdateController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            ),
            'acl-view' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/view/[:id]',
                    'defaults' => array(
                        'controller' => 'Acl\Controller\ViewController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            )
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'acl-console-index' => array(
                    'options' => array(
                        'route' => 'acl --list',
                        'defaults' => array(
                            'controller' => 'Acl\Controller\ConsoleController',
                            'action' => 'index'
                        )
                    )
                ),
                'acl-console-view' => array(
                    'options' => array(
                        'route' => 'acl --view [--id=]',
                        'defaults' => array(
                            'controller' => 'Acl\Controller\ConsoleController',
                            'action' => 'view'
                        )
                    )
                )
            )
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'Acl' => 'Acl\View\Helper\Factory\AclViewHelperFactory',
            'AclSearchForm' => 'Acl\View\Helper\Factory\AclSearchFormFactory',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'acl' => array(
        'default' => array(
            'guest' => array(),
            'user' => array(),
            'administrator' => array(
                'acl-index',
                'acl-create',
                'acl-update',
                'acl-delete',
                'acl-view'
            )
        )
    ),
    'menu' => array(
        'default' => array(
            array(
                'name' => 'Admin',
                'route' => 'admin-index',
                'icon' => 'fa fa-gear',
                'order' => 99,
                'active' => true,
                'items' => array(
                    array(
                        'name' => 'Acl',
                        'route' => 'acl-index',
                        'icon' => 'fa fa-gear',
                        'order' => 3,
                        'active' => true,
                    )
                )
            )
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Acl',
                        'route' => 'acl-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View',
                                'route' => 'acl-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'acl-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'acl-delete',
                                        'useRouteMatch' => true,
                                    )
                                )
                            ),
                            array(
                                'label' => 'New',
                                'route' => 'acl-create',
                                'useRouteMatch' => true,
                            )
                        )
                    )
                )
            )
        )
    )
);