<?php
namespace Acl\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        $form = $realServiceLocator->get('Acl\Form\Form');
        
        return new CreateController($service, $form);
    }
}

