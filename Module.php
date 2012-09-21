<?php

namespace ContentEditable;

use ContentEditable\View\Helper\ContentEdit;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ContentEditable' => 'ContentEditable\Service\Factory',
            )
        ); 
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'getContentEditableFile' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $config = $locator->get('Configuration');
                    $params = $config['ContentEditable']['params'];
                    
                    $viewHelper = new View\Helper\ContentEditable();
                    $viewHelper->setService($locator->get('ContentEditable'));
                    $viewHelper->setParams($params);
                    
                    return $viewHelper;
                },
                'getContentEditableContent' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $config = $locator->get('Configuration');
                    $params = $config['ContentEditable']['params'];
                    
                    $viewHelper = new View\Helper\ContentEditable();
                    $viewHelper->setService($locator->get('ContentEditable'));
                    $viewHelper->setParams($params);
                    
                    return $viewHelper;
                },
            ),
        );

    }


    
}