<?php

namespace ContentEditable\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

class ContentEditable extends AbstractHelper
{
    /**
     * @var ContentEditable Service
     */
    protected $service;
    
    /**
     * @var array $params
     */
    protected $params;
    
    /**
     * Called upon invoke
     * 
     * @param integer $id
     * @return ContentEditable\Helper
     */
    public function __invoke($type)
    {
        $link = $this->service->get(strtolower($type));
        return $link;
    }

    /**
     * Get ContentEditable service.
     *
     * @return $this->service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set ContentEditable service.
     *
     * @param $service
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
    
    /**
     * Get ContentEditable params.
     *
     * @return $this->params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set ContentEditable params.
     *
     * @param array $params
     */
    public function setParams(Array $params)
    {
        $this->params = $params;
        return $this;
    }
    
}