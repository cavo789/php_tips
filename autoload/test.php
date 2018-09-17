<?php

declare(strict_types=1);

namespace MyApp;

// Load the autoloader so we don't need anymore to make require_once()
// for loading our classes
require_once 'autoloader.php';
$autoload = new ClassLoader();

// Once ClassLoader has been called, we can do things like this
// i.e. we don't need to load our classes one by one but just call
// them. If Helpers\HTML is not yet loaded, ClassLoader::autoLoad()
// will be called by PHP with the classname (MyApp\Helpers\HTML)
// the autoLoad() function will then try to locate the HTML.php file
// in the Helpers folder. If found, the file will be required_once
// and the makeLink() function can be called.
//
// When the Helpers\HTML.php file can't be found, an exception will be
// triggered.
echo Helpers\HTML::makeLink('www.google.com', 'Google');
