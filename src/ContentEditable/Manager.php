<?php

namespace ContentEditable;

class Manager
{
    /**
     * @var Array 
     */
    protected $params;
    
    /**
     * @var array
     */
    protected $cache;
    
    /**
     * Set the Module specific configuration parameters
     * 
     * @param Array $params
     */
    public function __construct($params) {
        $this->params = $params;
    }

    public function get($type) 
    {
        if ($type == 'css') {
            return $this->getCss();
        }
        if ($type == 'js') {
            return $this->getJavascript();
        }
    }
    
    /**
     * Generate JS inclusion HTML code
     */
    public function getJavascript()
    {
        $link = '<script type="text/javascript" src="' . $this->params['js_source_path'] . '"></script>';
        return $link;
    }
    
    /**
     * Generate CSS inclusion HTML code
     * 
     * @param string $media
     * @return string 
     */
    public function getCss($media = 'screen')
    {
        $link = '<link href="' . $this->params['css_source_path'] . '" media="'. $media .'" rel="stylesheet" type="text/css" />';
        return $link;
    }
    
}
