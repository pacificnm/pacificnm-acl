<?php
namespace Acl\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\View\Helper\AclSearchForm;

class AclSearchFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\View\Helper\AclSearchForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclService = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        $roleService = $realServiceLocator->get('AclRole\Service\ServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ServiceInterface');
        
        return new AclSearchForm($aclService, $roleService, $resourceService);
    }
}

