<?php

namespace ContentEditable;

return array(
    __NAMESPACE__ => array(
        'params' => array(
            // ContentEditable related
            'js_source_path'           => '/js/ContentEditable.js',
            'css_source_path'          => '/css/ContentEditable.css',
            
            // jQuery related
            'jquery_js_source_path'    => '/js/jquery-1.8.0.min.js',
            'jquery-ui_js_source_path' => '/js/jquery-ui-1.8.23.custom.min.js',
            'jquery_ui_css_path'       => '/css/ui-lightness/jquery-ui-1.8.23.custom.css',
            ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'ContentEdit' => __DIR__ . '/../public',
            ),
        ),
    ),
);