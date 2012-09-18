<?php

namespace ContentEditable;

return array(
    __NAMESPACE__ => array(
        'params' => array(
            'js_source_path' => '/js/ContentEditable.js',
            'css_source_path' => '/css/ContentEditable.css'
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