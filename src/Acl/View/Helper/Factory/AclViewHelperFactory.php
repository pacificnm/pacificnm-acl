<?php
namespace Acl\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\View\Helper\Acl;
use Acl\View\Helper\AclViewHelper;

class AclViewHelperFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclService = $realServiceLocator->get('Acl\Service\AclServiceInterface');

        $roleService = $realServiceLocator->get('AclRole\Service\RoleServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ResourceServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        return new AclViewHelper($aclService, $roleService, $resourceService, $memcached);
    }
}

?>