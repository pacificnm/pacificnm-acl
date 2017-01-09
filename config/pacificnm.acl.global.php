<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
return array(
    'module' => array(
        'Acl' => array(
            'name' => 'Acl',
            'version' => '1.0.6',
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
            'Pacificnm\Acl\Controller\ConsoleController' => 'Pacificnm\Acl\Controller\Factory\ConsoleControllerFactory',
            'Pacificnm\Acl\Controller\CreateController' => 'Pacificnm\Acl\Controller\Factory\CreateControllerFactory',
            'Pacificnm\Acl\Controller\DeleteController' => 'Pacificnm\Acl\Controller\Factory\DeleteControllerFactory',
            'Pacificnm\Acl\Controller\IndexController' => 'Pacificnm\Acl\Controller\Factory\IndexControllerFactory',
            'Pacificnm\Acl\Controller\RestController' => 'Pacificnm\Acl\Controller\Factory\RestControllerFactory',
            'Pacificnm\Acl\Controller\UpdateController' => 'Pacificnm\Acl\Controller\Factory\UpdateControllerFactory',
            'Pacificnm\Acl\Controller\ViewController' => 'Pacificnm\Acl\Controller\Factory\ViewControllerFactory'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'Acl' => 'Pacificnm\Acl\Controller\Plugin\Factory\AclControllerPluginFactory'
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Pacificnm\Acl\Service\ServiceInterface' => 'Pacificnm\Acl\Service\Factory\ServiceFactory',
            'Pacificnm\Acl\Mapper\MysqlMapperInterface' => 'Pacificnm\Acl\Mapper\Factory\MysqlMapperFactory',
            'Pacificnm\Acl\Form\Form' => 'Pacificnm\Acl\Form\Factory\FormFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'acl-create' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'icon' => 'fa fa-lock',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/create',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Acl\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'acl-delete' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'icon' => 'fa fa-lock',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/delete/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Acl\Controller\DeleteController',
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
                'icon' => 'fa fa-lock',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/acl',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Acl\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'acl-rest' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Rest',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'icon' => 'fa fa-lock',
                'layout' => 'rest',
                'type' => 'segment',
                'options' => array(
                    'route' => '/api/acl[/:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Acl\Controller\RestController',
                    )
                )
            ),
            'acl-update' => array(
                'pageTitle' => 'Acl',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'acl-index',
                'icon' => 'fa fa-lock',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/update/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Acl\Controller\UpdateController',
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
                'icon' => 'fa fa-lock',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/acl/view/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Acl\Controller\ViewController',
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
                            'controller' => 'Pacificnm\Acl\Controller\ConsoleController',
                            'action' => 'index'
                        )
                    )
                ),
                'acl-console-view' => array(
                    'options' => array(
                        'route' => 'acl --view [--id=]',
                        'defaults' => array(
                            'controller' => 'Pacificnm\Acl\Controller\ConsoleController',
                            'action' => 'view'
                        )
                    )
                )
            )
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'Acl' => 'Pacificnm\Acl\View\Helper\Factory\AclViewHelperFactory',
            'AclSearchForm' => 'Pacificnm\Acl\View\Helper\Factory\AclSearchFormFactory',
        )
    ),
    'view_manager' => array(
        'controller_map' => array(
            'Pacificnm\Acl' => true
        ),
        'template_map' => array(
            'pacificnm/acl/create/index' => __DIR__ . '/../view/acl/create/index.phtml',
            'pacificnm/acl/delete/index' => __DIR__ . '/../view/acl/delete/index.phtml',
            'pacificnm/acl/index/index' => __DIR__ . '/../view/acl/index/index.phtml',
            'pacificnm/acl/update/index' => __DIR__ . '/../view/acl/update/index.phtml',
            'pacificnm/acl/view/index' => __DIR__ . '/../view/acl/view/index.phtml',
        ),
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
                'location' => 'left',
                'active' => true,
                'items' => array(
                    array(
                        'name' => 'Acl',
                        'route' => 'acl-index',
                        'icon' => 'fa fa-lock',
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