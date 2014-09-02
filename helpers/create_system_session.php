<?php

if (function_exists('create_system_session')) {
	return;
}

/**
 * @return	Session
 */
function create_system_session() {
	$system_user = User::retrieveByEmail(User::SYS_USER_EMAIL);

	if (!$system_user) {
		throw new RuntimeException('Error: No system user exists. Cannot do task.');
	}

	$session = new Session;
	$session->setuser($system_user);
	$session->setUserAgent('CLI');
	$session->setIpAddress('127.0.0.1');
	$session->setStarted(time());
	$session->save();
	return $session;
}
