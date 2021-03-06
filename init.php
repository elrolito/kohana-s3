<?php defined('SYSPATH') or die('No direct script access.');

// Use Zend Autoloader
if ($path = Kohana::find_file('vendor', 'Zend-Amazon-S3/library/Zend/Loader'))
{
    ini_set('include_path',
    ini_get('include_path').PATH_SEPARATOR.dirname(dirname($path)));

    require_once 'Zend/Loader/Autoloader.php';
    Zend_Loader_Autoloader::getInstance();
}