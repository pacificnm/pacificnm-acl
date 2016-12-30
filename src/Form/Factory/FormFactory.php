<?php
namespace Pacificnm\Acl\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Acl\Form\Form;

class FormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Pacificnm\Acl\Form\Form
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $resourceService = $serviceLocator->get('Pacificnm\AclResource\Service\ServiceInterface');
        
        $roleService = $serviceLocator->get('Pacificnm\AclRole\Service\ServiceInterface');
        
        return new Form($resourceService, $roleService);
    }
}

