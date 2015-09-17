<?php

$pattern = '/config\/?/i';
$dirname = dirname(__FILE__);

define('DIR_CONFIG', $dirname);
define('DIR_CLASSES', preg_replace($pattern, '', $dirname . 'classes/'));
define('DIR_PUBLIC', preg_replace($pattern, '', $dirname . 'public/'));

set_include_path(DIR_CONFIG     . PATH_SEPARATOR .
                 DIR_CLASSES    . PATH_SEPARATOR .
                 DIR_PUBLIC     . PATH_SEPARATOR);

function __autoload($class) {
    $paths = explode(PATH_SEPARATOR, get_include_path());
    foreach ($paths as $path) {
        if (file_exists($path . $class . '.php'))
            @include $path . $class . '.php';
        if (class_exists($class, false))
            break;
    }
}

require_once 'custom.inc.php';
