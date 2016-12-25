<?php
namespace Acl;

class Module
{
    public function getConsoleUsage()
    {
        return array(
            'acl --list' => 'lists all Access Controls',
            'acl --view [--id=]' => 'gets a single Acl by its id'
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }
}
