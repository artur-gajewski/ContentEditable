# ContentEditable module for Zend Framework 2

This module provides a way to make any HTML tag's inner content editable in TEXTAREA editor.


Requirements:

- PHP 5.3
- Zend Framework 2
- rwoverdijk/assetmanager @ [https://github.com/RWOverdijk/AssetManager](https://github.com/RWOverdijk/AssetManager)

See [https://github.com/artur-gajewski/ContentEditable](https://github.com/artur-gajewski/ContentEditable)

@Author: Artur Gajewski


## Installation with Composer

Go to your project directory and add the following line to "require" list in composer.json file:

```php
"artur-gajewski/content-editable": "dev-master"
```

Now run the Composer:

```php
php composer.phar install
```

Then add 'ContentEditable' into the Module array in APPLICATION_ROOT/config/application.config.php

```php
<?php
return array(
    'modules' => array(
        ...
        'ContentEditable',
        ...
    ),
);
```


## Adding JS and CSS files to your layout script

ContentEditable uses it's own Javascript and CSS files to generate dynamic edit capabilities within your view script.

In order to get ContentEditable working, you need to include these files where you include all your Javascript and CSS files.

```php
echo $this->getContentEditableFile('js');
echo $this->getContentEditableFile('css');
```


## Making your website editable

Now all you have to do, is to add a CSS style class to all tags you wish to become editable. You will also need to include a path in the data-url attribute
to where the content needs to be sent in order to save it in the database.

```php
<div class="editable" data-url="/article/update/1432">This is my content</div>
```

When you load the page and hover your mouse on top of the "This is my content" text, you will see the cursor changes to a pointer. Now if you click on this text, it will become a TEXTAREA with raw HTML code inside. Go ahead and edit the contents and then click somewhere outside the TEXTAREA. You will be requested to confirm data update.

Once you accept the modifications you have made, a request will be made to the given data-url with a parameter "editable_content", which ofcourse contains the contents of the edited data.


## Questions or comments?

Feel free to email me with any questions or comments about this module

[info@arturgajewski.com](mailto:info@arturgajewski.com)