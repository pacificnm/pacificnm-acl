<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Pacificnm\Acl\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Pacificnm\Acl\Service\ServiceInterface as AclServiceInterface;
use Pacificnm\AclRole\Service\ServiceInterface as RoleServiceInterface;
use Pacificnm\AclResource\Service\ServiceInterface as ResourceServiceInterface;

class AclSearchForm extends AbstractHelper
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
     * @param AclServiceInterface $aclService            
     * @param RoleServiceInterface $roleService            
     * @param ResourceServiceInterface $resourceService            
     */
    public function __construct(AclServiceInterface $aclService, RoleServiceInterface $roleService, ResourceServiceInterface $resourceService)
    {
        $this->aclService = $aclService;
        
        $this->resourceService = $resourceService;
        
        $this->roleService = $roleService;
    }

    /**
     *
     * @param array $queryParams            
     */
    public function __invoke(array $queryParams = array())
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $data->roleEntitys = $this->getRoles();
        
        $data->resourceEntitys = $this->getResources();
        
        $data->queryParams = $queryParams;
        
        return $partialHelper('partials/acl-search-form.phtml', $data);
    }

    /**
     *
     * @return \Zend\Paginator\Paginator
     */
    protected function getRoles()
    {
        return $this->roleService->getAll(array(
            'pagination' => 'off'
        ));
    }

    /**
     *
     * @return \AclResource\Entity\Entity
     */
    protected function getResources()
    {
        return $this->resourceService->getAll(array(
            'pagination' => 'off'
        ));
    }
}

