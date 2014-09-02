<?php

abstract class ApplicationController extends Controller {

	function __construct(ControllerRoute $route = null) {
		parent::__construct($route);
		$this['title'] = !empty($this['title']) ? $this['title'] . ' | Quizbot' : 'Quizbot';

		$current_controller = str_replace('Controller', '', get_class($this));
		$this['current_page'] = StringFormat::titleCase($current_controller, ' ');
		$this['actions'] = array();

		if ('Index' == $current_controller) {
			$this['current_page'] = 'Home';

		}else if ('Devices' == $current_controller) {
			$this['current_page'] = 'Clickers';

		}else if ('QuizSessionAttempts' == $current_controller) {
			$this['current_page'] = 'Results';
		}

		if (App::hasPerm(Perm::QUIZZES_MANAGE)) {
			$this['actions']['Quizzes'] = site_url('quizzes');
		}

		if (App::hasPerm(Perm::RESULTS_MANAGE)) {
			$this['actions']['Results'] = site_url('quiz-session-attempts');
		}
		
		if (App::hasPerm(Perm::USERS_MANAGE) && App::getClassroom()) {
			$this['actions']['Students'] = site_url('users');
		}

		if (App::hasPerm(Perm::DEVICES_MANAGE)) {
			$this['actions']['Clickers'] = site_url('devices');
		}

		if (App::hasPerm(Perm::USERS_MANAGE) && App::isAdmin()) {
			$this['actions']['Users'] = site_url('users');
		}

		if (App::hasPerm(Perm::CLASSROOMS_MANAGE)) {
			$this['actions']['Classrooms'] = site_url('classrooms');
		}

		if (App::hasPerm(Perm::QUESTIONS_MANAGE)) {
			$this['actions']['Questions'] = site_url('questions');
		}


	}

	public function doAction($action_name = null, $params = array()) {
		if ($this->outputFormat != 'html') {
			unset($this['title'], $this['current_page'], $this['actions']);
		}

		if (in_array($this->outputFormat, array('json', 'jsonp', 'xml'), true)) {
			try {
				return parent::doAction($action_name, $params);
			} catch (Exception $e) {
				error_log($e);
				$this['errors'][] = $e->getMessage();
				if (!$this->loadView) {
					return;
				}
				$this->loadView('');
			}
		} else {
			return parent::doAction($action_name, $params);
		}
	}

}