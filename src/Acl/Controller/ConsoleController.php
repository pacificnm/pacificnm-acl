<?php
namespace Acl\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface;
use RuntimeException;
use Zend\Console\Request as ConsoleRequest;
use Acl\Service\ServiceInterface;

class ConsoleController extends AbstractActionController
{

    /**
     *
     * @var AdapterInterface
     */
    protected $console;

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @param AdapterInterface $console            
     * @param ServiceInterface $service            
     */
    public function __construct(AdapterInterface $console, ServiceInterface $service)
    {
        $this->console = $console;
        
        $this->service = $service;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        $table = new \Zend\Text\Table\Table(array(
            'columnWidths' => array(
                10,
                30,
                20,
                30
            )
        ));
        
        $entitys = $this->service->getAll(array(
            'pagination' => 'off'
        ));
        
        $table->appendRow(array(
            'ACL ID',
            'ACL Role',
            'ACL Rule',
            'ACL Resource'
        ));
        
        foreach ($entitys as $entity) {
            $table->appendRow(array(
                $entity->getAclId(),
                $entity->getRoleEntity()
                    ->getAclRoleName(),
                'Allow',
                $entity->getResourceEntity()
                    ->getAclResourceName()
            ));
        }
        
        echo $table;
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Comleted acl list at {$end}\n");
    }

    public function viewAction()
    {
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        $id = $this->params('id');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            throw new \RuntimeException('Object not found');
        }
        
        $table = new \Zend\Text\Table\Table(array(
            'columnWidths' => array(
                10,
                30,
                20,
                30
            )
        ));
        
        $table->appendRow(array(
            'ACL ID',
            'ACL Role',
            'ACL Rule',
            'ACL Resource'
        ));
        
        $table->appendRow(array(
            $entity->getAclId(),
            $entity->getRoleEntity()
                ->getAclRoleName(),
            'Allow',
            $entity->getResourceEntity()
                ->getAclResourceName()
        ));
        
        echo $table;
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Comleted acl list at {$end}\n");
    }
}
