<?php
namespace Acl\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

use Zend\Cache\Storage\Adapter\Memcached;
use AclRole\Service\RoleServiceInterface;
use AclResource\Service\ResourceServiceInterface;

use Acl\Service\ServiceInterface as AclServiceInterface;


class AclViewHelper extends AbstractHelper
{

    /**
     *
     * @var \Zend\Permissions\Acl\Acl
     */
    protected $acl;

    
    public function __construct(AclServiceInterface $aclService, RoleServiceInterface $roleService, ResourceServiceInterface $resourceService, Memcached $memcached)
    {
        $acl = new Acl();
        
        // get roles roles
        $key = 'acl-roles';
        
        $roles = $memcached->getItem($key);
        
        if (! $roles) {
            
            $roles = $roleService->getAll(array(
                'pagination' => 'off'
            ))->toArray();
            
            $memcached->setItem($key, $roles);
        }
        
        // loop though and add each role
        foreach ($roles as $role) {
            if (! $acl->hasRole($role['acl_role'])) {
                $role = new GenericRole($role['acl_role']);
                
                $acl->addRole($role);
            }
        }
        
        // get resources
        $key = 'acl-resources';
        
        $resources = $memcached->getItem($key);
        
        if (! $resources) {
            $resources = $resourceService->getAll(array(
                'pagination' => 'off'
            ))->toArray();
            
            $memcached->setItem($key, $resources);
        }
        
        foreach ($resources as $resource) {
            if (! $acl->hasResource($resource['acl_resource'])) {
                $acl->addResource(new GenericResource($resource['acl_resource']));
            }
        }
        
        // get rules rules
        $key = 'acl-rules';
        
        $rules = $memcached->getItem($key);
        
        if (! $rules) {
            $rules = $aclService->getAll(array(
                'pagination' => 'off'
            ))->toArray();
            
            $memcached->setItem($key, $rules);
        }
        
        foreach ($rules as $rule) {
            $acl->allow($rule['role'], $rule['resource']);
        }
        
        // set acl
        $this->setAcl($acl);
        
        return $this;
    }

    public function isAllowed($resource, $privilege = null)
    {
        return $this->getAcl()->isAllowed($resource, $privilege);
    }

    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl($acl)
    {
        $this->acl = $acl;
    }
}
