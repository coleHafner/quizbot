<?php

if (defined('CONFIG_LOADED') && CONFIG_LOADED === true) {
	return;
}

date_default_timezone_set(@date_default_timezone_get());

// lets other scripts know that this file has been included
define('CONFIG_LOADED', true);

// directory where this file lives.  Borderline deprecated, so use APP_DIR
define('ROOT', dirname(__FILE__) . '/');

// directory where application lives, usually the same as ROOT
define('APP_DIR', ROOT);

// directory of configurations files
define('CONFIG_DIR', APP_DIR . 'config/');

// directory where libraries are located
define('LIBRARIES_DIR', APP_DIR . 'libraries/');

// directory for logs
define('LOGS_DIR', APP_DIR . 'logs/');

// directory for helpers
define('HELPERS_DIR', APP_DIR . 'helpers/');

if (!defined('SYSTEM_SALT')) {
	define('SYSTEM_SALT', '%b8$KrdSU.WF!WZ)J@qqG1mEZ.*[e#;ZDwn)eAF:v*:Y}"qhG]M1)xQ}W\6%J_Ux\`@)0a/:$:,oF:g-MiSkR?7s4{l04*5s/F-Vk_6Oc^\m}Z:=&tzoBoIOK<NaET"]');
}

// output errors to brower
ini_set('display_errors', true);

// level of errors to log/display
ini_set('error_reporting', E_ALL);

// log errors
ini_set('log_errors', true);

// file for error logging
ini_set('error_log', LOGS_DIR . 'error_log');

require_once(LIBRARIES_DIR . 'dabl/ClassLoader.php');
require_once(LIBRARIES_DIR . 'dabl/print_r2.php');

// Strip added slashes if needed
if (get_magic_quotes_gpc()) {
	require_once(LIBRARIES_DIR . 'dabl/strip_request_slashes.php');
	strip_request_slashes();
}

ClassLoader::addRepository('LIBRARIES', LIBRARIES_DIR);
ClassLoader::import('LIBRARIES:dabl');

foreach (glob(HELPERS_DIR . '/*.php') as $helper) {
	require_once $helper;
}

if (is_file(APP_DIR . 'vendor/autoload.php')) {
	require_once APP_DIR . 'vendor/autoload.php';
}

// load all config files
$config_files = glob(CONFIG_DIR . '*.php');
sort($config_files);
foreach ($config_files as $filename) {
	require_once($filename);
}

if (file_exists(APP_DIR . 'local-settings.php')) {
	require_once(APP_DIR . 'local-settings.php');
}