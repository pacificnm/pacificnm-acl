<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Pacificnm\Acl\Controller;

use Zend\View\Model\ViewModel;
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Acl\Service\ServiceInterface;
use Pacificnm\Acl\Form\Form;

class UpdateController extends AbstractApplicationController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @var Form
     */
    protected $form;

    /**
     *
     * @param ServiceInterface $service            
     * @param Form $form            
     */
    public function __construct(ServiceInterface $service, Form $form)
    {
        $this->service = $service;
        
        $this->form = $form;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Application\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('id');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('object was not found');
            
            return $this->redirect()->toRoute('acl-index');
        }
        
        if ($request->isPost()) {
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
                
                $aclEntity = $this->service->save($entity);
                
                $this->getEventManager()->trigger('aclUpdate', $this, array(
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'requestUrl' => $this->getRequest()
                        ->getUri(),
                    'aclEntity' => $aclEntity
                ));
                
                $this->flashMessenger()->addSuccessMessage('Object was saved');
                
                return $this->redirect()->toRoute('acl-view', array(
                    'id' => $aclEntity->getAclId()
                ));
            }
        }
        
        $this->form->bind($entity);
        
        return new ViewModel(array(
            'entity' => $entity,
            'form' => $this->form
        ));
    }
}

