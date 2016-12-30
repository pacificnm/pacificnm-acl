<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-acl for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-acl/blob/master/LICENSE.md
 */
namespace Pacificnm\Acl;

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
        return include __DIR__ . '/../config/pacificnm.acl.global.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/'
                )
            )
        );
    }
}
