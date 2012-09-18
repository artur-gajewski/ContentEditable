<?php

namespace ContentEditable\Service;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    ContentEditable\Manager;

/**
* ContentEdit service manager factory
*/
class Factory implements FactoryInterface
{
    /**
     * Factory method for ContentEditable Manager service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ContentEditable\Manager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');
        $params = $config['ContentEditable']['params'];
        
        $manager = new Manager($params);
        return $manager;
    }
}