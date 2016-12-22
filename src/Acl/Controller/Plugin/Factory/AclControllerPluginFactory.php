<?php
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

