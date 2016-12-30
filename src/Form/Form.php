<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Pacificnm\Acl\Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Pacificnm\Acl\Hydrator\Hydrator;
use Pacificnm\Acl\Entity\Entity;
use Pacificnm\AclResource\Service\ServiceInterface as ResourceServiceInterface;
use Pacificnm\AclRole\Service\ServiceInterface as RoleServiceInterface;

class Form extends ZendForm implements InputFilterProviderInterface
{
    /**
     * 
     * @var ResourceServiceInterface
     */
    protected $resourceService;
    
    /**
     * 
     * @var RoleServiceInterface
     */
    protected $roleService;
    
    /**
     * 
     * @param ResourceServiceInterface $resourceService
     * @param RoleServiceInterface $roleService
     * @param string $name
     * @param array $options
     */
    public function __construct(ResourceServiceInterface $resourceService, RoleServiceInterface $roleService, $name = 'acl-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new Hydrator(false));
    
        $this->setObject(new Entity());
    
        $this->setReourceService($resourceService);
        
        $this->setRoleService($roleService);
        
        // aclId
        $this->add(array(
            'name' => 'aclId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'aclId'
            )
        ));
        
        // aclRoleId
        $this->add(array(
            'type' => 'Select',
            'name' => 'aclRoleId',
            'options' => array(
                'label' => 'Role:',
                'value_options' => $this->getRoleOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'aclRoleId'
            )
        ));
        
        // aclResourceId
        $this->add(array(
            'type' => 'Select',
            'name' => 'aclResourceId',
            'options' => array(
                'label' => 'Resource:',
                'value_options' => $this->getResourceOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'aclResourceId'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
        
    }

    /**
     * 
     * @return \AclResource\Service\ServiceInterface
     */
    public function getResourceService()
    {
        return $this->resourceService;
    }
    
    /**
     * 
     * @return \AclRole\Service\ServiceInterface
     */
    public function getRoleService()
    {
        return $this->roleService;
    }
    
    
    /**
     * 
     * @param ResourceServiceInterface $resourceService
     * @return \Acl\Form\Form
     */
    public function setReourceService(ResourceServiceInterface $resourceService)
    {
        $this->resourceService = $resourceService;
        
        return $this;
    }
    
    /**
     * 
     * @param RoleServiceInterface $roleService
     * @return \Acl\Form\Form
     */
    public function setRoleService(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
        
        return $this;
    }
    
    /**
     * 
     * @return \AclResource\Entity
     */
    protected function getResourceOptions()
    {
        $options = array();
        
        $entitys = $this->getResourceService()->getAll(array('pagination' => 'off'));
        
        foreach($entitys as $entity) {
            $options[$entity->getAclResourceId()] = $entity->getAclResourceName();
        }
        
        return $options;
    }
    
    /**
     * 
     * @return \AclRole\Entity\Entity
     */
    protected function getRoleOptions()
    {
        $options = array();
        
        $entitys = $this->getRoleService()->getAll(array('pagination' => 'off'));
        
        foreach($entitys as $entity) {
            $options[$entity->getAclRoleId()] = $entity->getAclRoleName();
        }
        
        return $options;
    }
}

