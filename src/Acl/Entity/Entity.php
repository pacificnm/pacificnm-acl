<?php
namespace Acl\Entity;

class Entity
{

    /**
     *
     * @var number
     */
    protected $aclId;

    /**
     *
     * @var string
     */
    protected $role;

    /**
     *
     * @var string
     */
    protected $resource;

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
     * @return the $role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     *
     * @return the $resource
     */
    public function getResource()
    {
        return $this->resource;
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
     * @param string $role            
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     *
     * @param string $resource            
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }
}