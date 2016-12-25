<?php
namespace Acl\Controller;

use Application\Controller\AbstractApplicationController;
use Acl\Service\ServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractApplicationController
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
        
        $id = $this->params()->fromRoute('id');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('object was not found');
            
            return $this->redirect()->toRoute('acl-index');
        }
        
        $this->getEventManager()->trigger('aclView', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'requestUrl' => $this->getRequest()->getUri(),
            'aclEntity' => $entity
        ));
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

