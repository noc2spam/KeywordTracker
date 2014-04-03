<?php
/*

This script is licensed under Apache 2.0. View the license here:
http://www.apache.org/licenses/LICENSE-2.0.html
Copyright Reserved to g0g0l
Contact @ Skype : noc2spam
*/

/**
 *  configuration and autoloading
 **/

function appLoad($class) {
    include dirname(__FILE__).'/Classes/' . $class . '.php';
}
spl_autoload_register('appLoad');

function exception_handler(Exception $exception) {
 
    echo "<b>Uncaught exception with message:</b> " , $exception->getMessage(), "\n<br>";
     echo '<b>Occurance: </b>'.$exception->getTraceAsString();
}

set_exception_handler('exception_handler');

define('DBHOST' , 'localhost');
define('DBNAME' , 'kwtracker');
define('DBUSER' , 'root');
define('DBPASS' , '');
