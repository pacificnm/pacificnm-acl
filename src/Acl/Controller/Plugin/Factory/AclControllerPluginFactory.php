<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Acl\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Controller\Plugin\AclControllerPlugin;

class AclControllerPluginFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Acl\Controller\Plugin\AclControllerPlugin
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclService = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        $roleService = $realServiceLocator->get('AclRole\Service\ServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        return new AclControllerPlugin($aclService, $roleService, $resourceService, $memcached);
    }
}

