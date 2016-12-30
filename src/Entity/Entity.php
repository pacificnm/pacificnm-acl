<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Pacificnm\Acl\Entity;

use Pacificnm\AclResource\Entity\Entity as ResourceEntity;
use Pacificnm\AclRole\Entity\Entity as RoleEntity;

class Entity
{

    /**
     *
     * @var number
     */
    protected $aclId;

    /**
     *
     * @var number
     */
    protected $aclRoleId;

    /**
     *
     * @var number
     */
    protected $aclResourceId;

    /**
     *
     * @var ResourceEntity
     */
    protected $resourceEntity;

    /**
     *
     * @var RoleEntity
     */
    protected $roleEntity;

    /**
     *
     * @return the $aclId
     */
    public function getAclId()
    {
        return $this->aclId;
    }

    /**
     *
     * @return the $aclRoleId
     */
    public function getAclRoleId()
    {
        return $this->aclRoleId;
    }

    /**
     *
     * @return the $aclResourceId
     */
    public function getAclResourceId()
    {
        return $this->aclResourceId;
    }

    /**
     *
     * @return the $resourceEntity
     */
    public function getResourceEntity()
    {
        return $this->resourceEntity;
    }

    /**
     *
     * @return the $roleEntity
     */
    public function getRoleEntity()
    {
        return $this->roleEntity;
    }

    /**
     *
     * @param number $aclId            
     */
    public function setAclId($aclId)
    {
        $this->aclId = $aclId;
    }

    /**
     *
     * @param number $aclRoleId            
     */
    public function setAclRoleId($aclRoleId)
    {
        $this->aclRoleId = $aclRoleId;
    }

    /**
     *
     * @param number $aclResourceId            
     */
    public function setAclResourceId($aclResourceId)
    {
        $this->aclResourceId = $aclResourceId;
    }

    /**
     *
     * @param \AclResource\Entity\Entity $resourceEntity            
     */
    public function setResourceEntity($resourceEntity)
    {
        $this->resourceEntity = $resourceEntity;
    }

    /**
     *
     * @param \AclRole\Entity\Entity $roleEntity            
     */
    public function setRoleEntity($roleEntity)
    {
        $this->roleEntity = $roleEntity;
    }
}