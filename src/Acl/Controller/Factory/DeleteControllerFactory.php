<?php
namespace Acl\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        return new DeleteController($service);
    
    }
}

