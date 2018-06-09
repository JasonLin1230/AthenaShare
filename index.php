<?php

/*
 * Author : JasonLin
 * Describe : Entry port.
 * Date : 2018/6/4.
*/


if (version_compare (PHP_VERSION, '5.3.0', '<')) {
	die ('require PHP > 5.3.0 !');
}


define ('APP_DEBUG', true);
define ('APP_PATH', './app/');

define ('BIND_MODULE', 'Kng');


require './think/ThinkPHP.php';

