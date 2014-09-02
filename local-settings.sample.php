<?php

if (defined('LOCAL_SETTINGS_LOADED')) {
	return;
}

//if true, all system email will log to a logs/email_log instead of sending
define('LOG_MAIL', true);

//if not null, all system email will go to this address (and no others)
define('DEV_EMAIL', 'colehafner@gmail.com');

//if true, no passwords will be required for login
define('DEV_BYPASS', true);

//makes sure this file only gets loaded once.
define('LOCAL_SETTINGS_LOADED', true);