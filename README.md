# ContentEditable module for Zend Framework 2

This module provides a way to make any HTML tag's inner content editable in TEXTAREA editor.

ContenEditable does not provide code to do data saving, just a very easy interface to get your website editable and edited data to your application controller.

You will have to implement data processing yourself.


Requirements:

- PHP 5.3
- Zend Framework 2
- rwoverdijk/assetmanager @ [https://github.com/RWOverdijk/AssetManager](https://github.com/RWOverdijk/AssetManager)
- jQuery
- jQuery-UI

Note: jQuery and jQuery-UI are bundled with this module and available out-of-the-box. You can override the bundled version with your own with minimal effort.

Follow me on twitter: @GajewskiArtur


## Live demo

You can go ahead and try the live demo of ContentEditable module at [http://arturgajewski.com/cedemo](http://arturgajewski.com/cedemo)

Click on any of the three columns on the front page to edit their content. Once done, click outside the div to get confirmation to save modifications. Third column will give an error status since it has a data-url that is not available.

Please note: This is a demo, no data is actually saved and will revert to original content on page reload.


## Installation with Composer

Go to your project directory and add the following line to "require" list in composer.json file:

```php
"artur-gajewski/content-editable": "dev-master"
```

Now run the Composer:

```php
php composer.phar install
```

Then add 'ContentEditable' and 'AssetManager' modules into the Module array in APPLICATION_ROOT/config/application.config.php

```php
<?php
return array(
    'modules' => array(
        ...
        'AssetManager',
        'ContentEditable',
        ...
    ),
);
```


## Adding JS and CSS files to your layout script

ContentEditable uses it's own Javascript and CSS files to generate dynamic edit capabilities within your view script.

In order to get ContentEditable working, you need to include these files where you include all your Javascript and CSS files.

```php
echo $this->getContentEditableFiles('js');
echo $this->getContentEditableFiles('css');
```

if you want to include bundled jQuery and jQuery-UI, you need to add a boolean parameter like so:

```php
echo $this->getContentEditableFiles('js', true);
echo $this->getContentEditableFiles('css', true);
```

If you want to override the bundled package with newer version, you can override the path to Javascript and CSS files in module.config.php file:

```php
'params' => array(
    // ContentEditable related
    'js_source_path'           => '/js/ContentEditable.js',
    'css_source_path'          => '/css/ContentEditable.css',

    // jQuery related
    'jquery_js_source_path'    => '/js/jquery-1.8.0.min.js',
    'jquery-ui_js_source_path' => '/js/jquery-ui-1.8.23.custom.min.js',
    'jquery_ui_css_path'       => '/css/ui-lightness/jquery-ui-1.8.23.custom.css',
    ),
```


## Making your website editable

Now all you have to do, is to add a CSS style class to all tags you wish to become editable. You will also need to include a path in the data-url attribute
to where the content needs to be sent in order to save it in the database.

```php
<div class="editable" data-url="/article/update/1432">This is my content</div>
```

When you load the page and hover your mouse on top of the "This is my content" text, you will see the cursor changes to a pointer. Now if you click on this text, it will become a TEXTAREA with raw HTML code inside. Go ahead and edit the contents and then click somewhere outside the TEXTAREA. You will be requested to confirm data update.

Once you accept the modifications you have made, a request will be made to the given data-url with a parameter "editable_content", which ofcourse contains the contents of the edited data.


## Processing editable data in controller

When ContentEditable sends data to be saved to the server, it expects to get JSON response to inform the module of succeeded data saving.

You can enable JSON formatted response by using JsonModel. Add the following line to your controller:

```php
use Zend\View\Model\JsonModel;
```

In the action used to fetch the ContentEditable data and send response back, return a JSON response that corresponds to success or failure or process:

```php
// Obtain edited content to be saved
$data = $this->getRequest()->getPost('editable_content');

// Do some processing of $data here...
        
// Return JSON response
$result = new JsonModel(
    array(
        'success' => true,
    )
); 

return $result;
```

If the response is failure, ContentEditable will inform you of such status on the web page.


## Frequently Asked Questions


###1. What if I need to have a dynamic ID in the URL that I pass in the data-url attribute?

You can make a dynamic data-url by specifying such router in your application:

```php
'content-editable' => array(
    'type' => 'segment',
    'options' => array(
        'route' => '/article/update[/:content_id]',
        'constraints' => array(
            'contentid' => '[0-9]+',
        ),
        'defaults' => array(
            'controller' => __NAMESPACE__ . '\Controller\Article',
            'action' => 'update',
        ),
    ),
),
```

Then you just put the dynamic URL into the tag's data-url attribute, for example:

```php
<div class="editable" data-url="/article/update/1432">This is my content</div>
```

You will be able to fetch both contend_id and editable_content to be used in your controller.


###2. What if I need to update article's title and content?

If you are using ContentEditable for example in a blog and you want to inform your controller of which part of the
article are you trying to save, add an extra part to your data-url:

```php
<div class="editable article_title" data-url="/article/update/1432/title">This is my article title</div>
<div class="editable article_content" data-url="/article/update/1432/content">This is my article content</div>
```

In this case of course, you would have to add the extra part to your router as well:

```php
'content-editable' => array(
    'type' => 'segment',
    'options' => array(
        'route' => '/article/update[/:content_id[/:type]]',
        'constraints' => array(
            'contentid' => '[0-9]+',
        ),
        'defaults' => array(
            'controller' => __NAMESPACE__ . '\Controller\Article',
            'action' => 'update',
        ),
    ),
),
```


###3. Why TEXTAREA and not a WYSIWYG editor?

TEXTAREA is core HTML and provides a light and easy way to edit HTML code. ContentEditable is used to edit tag contents that are based on few words as well, so using a WYSIWYG editor for this is not very optimal approach.


###4. Why is there no function to save to database out-of-the-box?

My plans are to add such capability is a future version. Stay tuned!


## Questions or comments?

Feel free to email me with any questions or comments about this module

[info@arturgajewski.com](mailto:info@arturgajewski.com)