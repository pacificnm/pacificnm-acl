<?php
namespace Acl\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\View\Helper\Acl;
use Acl\View\Helper\AclViewHelper;

class AclViewHelperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\View\Helper\AclViewHelper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclService = $realServiceLocator->get('Acl\Service\ServiceInterface');

        $roleService = $realServiceLocator->get('AclRole\Service\ServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        return new AclViewHelper($aclService, $roleService, $resourceService, $memcached);
    }
}