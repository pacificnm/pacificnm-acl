<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Acl\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Cache\Storage\Adapter\Memcached;
use Acl\Service\ServiceInterface as AclServiceInterface;
use AclRole\Service\ServiceInterface as RoleServiceInterface;
use AclResource\Service\ServiceInterface as ResourceInterface;

class AclViewHelper extends AbstractHelper
{

    /**
     *
     * @var \Zend\Permissions\Acl\Acl
     */
    protected $acl;

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
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param AclServiceInterface $aclService            
     * @param RoleServiceInterface $roleService            
     * @param ResourceInterface $resourceService            
     * @param Memcached $memcached            
     */
    public function __construct(AclServiceInterface $aclService, RoleServiceInterface $roleService, ResourceInterface $resourceService, Memcached $memcached)
    {
        $acl = new Acl();
        
        $this->aclService = $aclService;
        
        $this->resourceService = $resourceService;
        
        $this->roleService = $roleService;
        
        $this->memcached = $memcached;
        
        $this->setAcl($acl);
    }

    /**
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
            
            // $this->memcached->setItem($key, $roles);
        }
        
        foreach ($roles as $role) {
            if (! $this->acl->hasRole($role['acl_role_name'])) {
                $role = new GenericRole($role['acl_role_name']);
                
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
            
            // $this->memcached->setItem($key, $resources);
        }
        
        foreach ($resources as $resource) {
            if (! $this->acl->hasResource($resource['acl_resource_name'])) {
                $this->acl->addResource(new GenericResource($resource['acl_resource_name']));
            }
        }
        
        // add rules
        $key = 'acl-rules';
        
        $rules = $this->memcached->getItem($key);
        
        if (! $rules) {
            $data = array();
            
            $rules = $this->aclService->getAll(array(
                'pagination' => 'off'
            ));
            
            foreach ($rules as $rule) {
                $data[] = array(
                    'acl_role_name' => $rule->getRoleEntity()->getAclRoleName(),
                    'acl_resource_name' => $rule->getResourceEntity()->getAclResourceName()
                );
            }
            
            $rules = $data;
            // $this->memcached->setItem($key, $rules);
        }
        
        foreach ($rules as $rule) {
            $this->acl->allow($rule['acl_role_name'], $rule['acl_resource_name']);
        }
        
        return $this;
    }

    /**
     *
     * @param string $resource            
     * @param string $privilege            
     * @return boolean
     */
    public function isAllowed($resource, $privilege = null)
    {
        return $this->getAcl()->isAllowed($resource, $privilege);
    }

    /**
     *
     * @return \Zend\Permissions\Acl\Acl
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     *
     * @param unknown $acl            
     * @return \Acl\View\Helper\AclViewHelper
     */
    public function setAcl($acl)
    {
        $this->acl = $acl;
        
        return $this;
    }
}
