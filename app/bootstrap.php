<?php

(function(){
    if (defined('BOOST_T')) {
        throw new ErrorException("boot filed!");
        exit;
    }

    define('BOOTS_T', microtime(true));
    define('DS', DIRECTORY_SEPARATOR);
    define('PS', PATH_SEPARATOR);
    define('DOT', ".");
    define('ROOTPATH', realpath(dirname(__DIR__)));
    define('APP_PATH', ROOTPATH.DS."app");
    define('SRC_PATH', ROOTPATH.DS."src");
})();

$loader = require __DIR__."/../vendor/autoload.php";

use Tracy\Debugger;


define('BOOSTED_T', microtime(true));


Debugger::enable();



return $loader; 