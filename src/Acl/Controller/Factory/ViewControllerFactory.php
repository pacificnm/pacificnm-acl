<?php
namespace Acl\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Acl\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Acl\Service\ServiceInterface');
                
        return new ViewController($service);
    }
}

