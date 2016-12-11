<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Cache\Storage\Adapter\Memcached;
use Acl\Service\AclServiceInterface;
use AclRole\Service\RoleServiceInterface;
use AclResource\Service\ResourceServiceInterface;

class AclControllerPlugin extends AbstractPlugin
{

    /**
     *
     * @var AclServiceInterface
     */
    protected $aclService;

    /**
     *
     * @var RoleServiceInterface
     */
    protected $roleService;

    /**
     *
     * @var ResourceServiceInterface
     */
    protected $resourceService;

    /**
     *
     * @var \Zend\Permissions\Acl\Acl
     */
    protected $acl;

    /**
     *
     * @var string
     */
    protected $module;

    /**
     *
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param AclServiceInterface $aclService            
     * @param RoleServiceInterface $roleService            
     * @param ResourceServiceInterface $resourceService            
     * @param Memcached $memcached            
     */
    public function __construct(AclServiceInterface $aclService, RoleServiceInterface $roleService, ResourceServiceInterface $resourceService, Memcached $memcached)
    {
        $this->acl = new Acl();
        
        $this->aclService = $aclService;
        
        $this->roleService = $roleService;
        
        $this->resourceService = $resourceService;
        
        $this->memcached = $memcached;
    }

    /**
     *
     * @param string $module            
     * @throws \Exception
     * @return \Application\Controller\Plugin\Acl
     */
    public function __invoke()
    {
        
        // add roles
        $key = 'acl-roles';
        
        $roles = $this->memcached->getItem($key);
        
        if (! $roles) {
            $roles = $this->roleService->getAll(array(
                'pagination' => 'off'
            ))->toArray();
            
            $this->memcached->setItem($key, $roles);
        }
        
        foreach ($roles as $role) {
            if (! $this->acl->hasRole($role['acl_role'])) {
                $role = new GenericRole($role['acl_role']);
                
                $this->acl->addRole($role);
            }
        }
        
        // add resources
        $key = 'acl-resources';
        
        $resources = $this->memcached->getItem($key);
        
        if (! $resources) {
            $resources = $this->resourceService->getAll(array(
                'pagination' => 'off'
            ))->toArray();
            
            $this->memcached->setItem($key, $resources);
        }
        
        foreach ($resources as $resource) {
            if (! $this->acl->hasResource($resource['acl_resource'])) {
                $this->acl->addResource(new GenericResource($resource['acl_resource']));
            }
        }
        
        // add rules
        $key = 'acl-rules';
        
        $rules = $this->memcached->getItem($key);
        
        if (! $rules) {
            $rules = $this->aclService->getAll(array(
                'pagination' => 'off'
            ))->toArray();
            
            $this->memcached->setItem($key, $rules);
        }
        
        foreach ($rules as $rule) {
            $this->acl->allow($rule['role'], $rule['resource']);
        }
        
        return $this;
    }

    /**
     *
     * @param string $role            
     * @param string $route            
     * @return boolean
     */
    public function checkAcl($role, $route)
    {
        if ($this->acl->isAllowed($role, $route)) {
            return true;
        }
        
        return false;
    }

    public function getAcl()
    {
        return $this->acl;
    }
}