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

    public function get($type, $option) 
    {
        if ($type == 'css') {
            return $this->getCss($option);
        }
        elseif ($type == 'js') {
            return $this->getJavascript($option);
        }
        elseif ($type == 'dialog') {
            return $this->getContent($option);
        }
    }
    
    /**
     * Generate JS inclusion HTML code
     */
    public function getJavascript($includeBundledJquery = false)
    {
        $links = array();
        if ($includeBundledJquery === true) {
            $links[] = '<script type="text/javascript" src="' . $this->params['jquery_js_source_path'] . '"></script>';
        }
        $links[] = '<script type="text/javascript" src="' . $this->params['jquery-ui_js_source_path'] . '"></script>';
        $links[] = '<script type="text/javascript" src="' . $this->params['js_source_path'] . '"></script>';
        return implode("", $links);
    }
    
    /**
     * Generate CSS inclusion HTML code
     * 
     * @param string $media
     * @return string 
     */
    public function getCss($media = 'screen')
    {
        $links = array();
        $links[] = '<link href="' . $this->params['css_source_path'] . '" media="'. $media .'" rel="stylesheet" type="text/css" />';
        $links[] = '<link href="' . $this->params['jquery_ui_css_path'] . '" rel="stylesheet" type="text/css" />';
        
        return implode("", $links);
    }
    
    /**
     * Create DIV section for the jQuery-UI dialog
     * 
     * @return string 
     */
    public function getContent($options)
    {
        $id = '';
        $title = '';
        $content = '';
        
        if (!empty($options['id'])) {
            $id = $options['id'];
        }
        if (!empty($options['title'])) {
            $title = $options['title'];
        }
        if (!empty($options['content'])) {
            $content = $options['content'];
        }
        
        $html =  '<div class="CE_dialog" id="' . $id . '" title="' . $title . '">';
        $html .= '    <p id="content">' . $content . '</p>';
        $html .= '</div>';
        
        return $html;
    }
    
    
    
}
