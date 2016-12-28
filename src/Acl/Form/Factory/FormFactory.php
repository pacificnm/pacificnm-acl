<?php
namespace Acl\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Form\Form;

class FormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Acl\Form\Form
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $resourceService = $serviceLocator->get('AclResource\Service\ServiceInterface');
        
        $roleService = $serviceLocator->get('AclRole\Service\ServiceInterface');
        
        return new Form($resourceService, $roleService);
    }
}

