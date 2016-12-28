<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Acl\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\AbstractMysqlMapper;
use Acl\Entity\Entity;
use Zend\Hydrator\HydratorInterface;

class MysqlMapper extends AbstractMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param Entity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, Entity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Acl\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('acl');
        
        $this->filter($filter);
        
        $this->joinResource()->joinRole();
        
        // if pagination is disabled
        if (array_key_exists('pagination', $filter)) {
            if ($filter['pagination'] == 'off') {
                return $this->getRows();
            }
        }
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Acl\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('acl');
        
        $this->joinResource()->joinRole();
        
        $this->select->where(array(
            'acl.acl_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Acl\Mapper\MysqlMapperInterface::getAclRule()
     */
    public function getAclRule($role, $resource)
    {
        $this->select = $this->readSql->select('acl');
        
        $this->joinResource()->joinRole();
        
        $this->select->where(array(
            'acl.acl_role_id = ?' => $role
        ));
        
        $this->select->where(array(
            'acl.acl_resource_id = ?' => $resource
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Acl\Mapper\MysqlMapperInterface::save()
     */
    public function save(Entity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getAclId()) {
            $this->update = new Update('acl');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'acl.acl_id = ?' => $entity->getAclId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('acl');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setAclId($id);
        }
        
        return $this->get($entity->getAclId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Acl\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(Entity $entity)
    {
        $this->delete = new Delete('acl');
        
        $this->delete->where(array(
            'acl.acl_id = ?' => $entity->getAclId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param unknown $filter            
     * @return \Acl\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // aclRoleId
        if (array_key_exists('aclRoleId', $filter) && is_numeric($filter['aclRoleId'])) {
            $this->select->where(array(
                'acl.acl_role_id = ?' => $filter['aclRoleId']
            ));
        }
        
        // aclResourceId
        if(array_key_exists('aclResourceId', $filter) && is_numeric($filter['aclResourceId'])) {
            $this->select->where(array(
                'acl.acl_resource_id = ?' => $filter['aclResourceId']
            ));
        }
        return $this;
    }

    /**
     *
     * @return \Acl\Mapper\MysqlMapper
     */
    protected function joinRole()
    {
        $this->select->join('acl_role', 'acl.acl_role_id = acl_role.acl_role_id', array(
            'acl_role_name'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \Acl\Mapper\MysqlMapper
     */
    protected function joinResource()
    {
        $this->select->join('acl_resource', 'acl.acl_resource_id = acl_resource.acl_resource_id', array(
            'acl_resource_name'
        ), 'inner');
        
        return $this;
    }
}