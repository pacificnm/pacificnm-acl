<?php
namespace Acl\Controller;

use Application\Controller\AbstractApplicationController;
use Acl\Service\ServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractApplicationController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @param ServiceInterface $service            
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
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
            $this->flashmessenger()->addErrorMessage('Object was not found.');
            return $this->redirect()->toRoute('acl-index');
        }
        
        if ($request->isPost()) {
            
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->service->delete($entity);
                
                $this->getEventManager()->trigger('aclDelete', $this, array(
                    'authId' => $this->identity() ->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'aclEntity' => $entity
                ));
                
                $this->flashmessenger()->addSuccessMessage('Object was deleted');
                
                return $this->redirect()->toRoute('acl-index');
            }
            
            return $this->redirect()->toRoute('acl-view', array(
                'id' => $id
            ));
        }
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

