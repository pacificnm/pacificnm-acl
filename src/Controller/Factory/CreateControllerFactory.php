<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Pacificnm\Acl\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Acl\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Acl\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Pacificnm\Acl\Service\ServiceInterface');
        
        $form = $realServiceLocator->get('Pacificnm\Acl\Form\Form');
        
        return new CreateController($service, $form);
    }
}

