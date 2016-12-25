<?php
namespace Acl\Service;

use Acl\Mapper\MysqlMapperInterface;
use Acl\Entity\Entity;

class Service implements ServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    
    
    
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::getAclRule()
     */
    public function getAclRule($role, $resource)
    {
        return $this->mapper->getAclRule($role, $resource);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::save()
     */
    public function save(Entity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::delete()
     */
    public function delete(Entity $entity)
    {
        return $this->mapper->delete($entity);
    }
}