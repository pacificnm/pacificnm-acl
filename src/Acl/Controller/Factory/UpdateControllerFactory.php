<?php
namespace Acl\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Controller\UpdateController;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Acl\Service\ServiceInterface');
        
        $form = $realServiceLocator->get('Acl\Form\Form');
        
        return new UpdateController($service, $form);
    }
}

