<?php
namespace Acl\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Controller\ConsoleController;

class ConsoleControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Acl\Controller\ConsoleController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $console = $realServiceLocator->get('console');
        
        $service = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        return new ConsoleController($console, $service);
    }
}

