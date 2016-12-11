<?php
namespace Acl\Mapper;



use Application\Mapper\AbstractMysqlMapper;
use Acl\Entity\Entity;

class MysqlMapper extends AbstractMysqlMapper implements MysqlMapperInterface
{
    /**
     * {@inheritDoc}
     * @see \Acl\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \Acl\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \Acl\Mapper\MysqlMapperInterface::getAclRule()
     */
    public function getAclRule($role, $resource)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \Acl\Mapper\MysqlMapperInterface::save()
     */
    public function save(Entity $entity)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \Acl\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(Entity $entity)
    {
        // TODO Auto-generated method stub
        
    }


   
}