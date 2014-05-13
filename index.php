<?php

/**
 * 系统调试设置
 * 项目正式部署后请设置为false
 */
define('APP_DEBUG', true);
define('APP_NAME', 'App');
define('APP_PATH', './App/');
if (!file_exists(APP_PATH .'Runtime/Data/install/install.lock')) {
	$_GET['m'] = 'install';
}
require './ThinkPHP/bootstrap.php';