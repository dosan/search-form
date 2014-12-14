<?php
define('DEVELOPMENT_ENVIRONMENT', true);
define('URL', 'http://localhost/');
// Папка сайта

define('DS', DIRECTORY_SEPARATOR);
define('PASS_COM_LIB', "app".DS."libs".DS."password_compatibility_library.php");
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].DS);
define('IMAGES_PATH', $_SERVER['DOCUMENT_ROOT'].DS.'public'.DS.'img'.DS);
define('VIEWS_PATH', $_SERVER['DOCUMENT_ROOT'].DS.'app'.DS.'views'.DS);
define('CONTROLLER_PATH' , $_SERVER['DOCUMENT_ROOT'].DS.'app'.DS.'controller'.DS);
define('ROOT', dirname(dirname(__FILE__)));
define('CONNECTION_FAILED', 'Database connection could not be established.');
define('CSS_PATH' , URL.'public'.DS.'css'.DS);


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'books');
define('DB_USER', 'root');
define('DB_PASS', 'password1');
define('SES_PR' , 'test_task');