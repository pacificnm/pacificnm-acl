<?php
namespace Acl\Controller\Factory;

use Acl\Controller\IndexController;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        return new IndexController($service);
    }
}

