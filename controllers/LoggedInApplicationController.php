<?php
abstract class LoggedInApplicationController extends ApplicationController {

	function __construct(ControllerRoute $route = null) {
		
		$this['quiz'] = !empty($_REQUEST['quiz_id']) ? Quiz::retrieveByPk($_REQUEST['quiz_id']) : null;
		parent::__construct($route);

		if (!App::isLoggedIn()) {
			$this->flash['messages'][] = 'Please log in.';
			$this->redirect('login');
		}
	}

}