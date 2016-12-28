<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Acl\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\View\Helper\Acl;
use Acl\View\Helper\AclViewHelper;

class AclViewHelperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Acl\View\Helper\AclViewHelper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclService = $realServiceLocator->get('Acl\Service\ServiceInterface');

        $roleService = $realServiceLocator->get('AclRole\Service\ServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        return new AclViewHelper($aclService, $roleService, $resourceService, $memcached);
    }
}