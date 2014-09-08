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

		}else if ('Questions' == $current_controller && !App::hasPerm(Perm::QUESTIONS_MANAGE)) {
			$this['current_page'] = 'Quizzes';

		}else if (in_array($current_controller, array('QuizSessions', 'QuizSessionAttempts'))) {
			$this['current_page'] = 'Quiz Results';
		}

		$this['actions']['Dashboard'] = site_url('dashboard');

		if (App::hasPerm(Perm::QUIZZES_MANAGE)) {
			$this['actions']['Quizzes'] = site_url('quizzes');
		}

		if (App::hasPerm(Perm::STUDENTS_MANAGE) && App::getClassroom()) {
			$this['actions']['Students'] = site_url('students');
		}

		if (App::hasPerm(Perm::DEVICES_MANAGE)) {
			$this['actions']['Clickers'] = site_url('devices');
		}

		if (App::hasPerm(Perm::QUIZSESSIONS_MANAGE)) {
			$this['actions']['Quiz Results'] = site_url('quiz-sessions');
		}

		if (App::hasPerm(Perm::USERS_MANAGE)) {
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

	/**
	 * Deletes the record with the id. Examples:
	 * GET /users/delete/1
	 * DELETE /rest/users/1.json
	 */
	function delete($id = null) {
		$redirect_to = $this->getRedirectTo();
		$class_name = $this->getTargetRecordType();
		$record = $class_name::retrieveByPk($id);

		try {

			if (!$record) {
				throw new RuntimeException('No ' . $class_type . ' found for id #' . $id);
			}

			if (!App::can(Perm::ACTION_DELETE, $record)) {
				throw new RuntimeException('You do not have permission to delete ' . $class_type . ' #' . $id);
			}

			if (null !== $record && $record->delete()) {
				$this['messages'][] = $class_name . ' deleted';
			} else {
				$this['errors'][] = $class_name . ' could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect($redirect_to);
		}
	}

	/**
	 * Deletes the User with the id. Examples:
	 * GET /users/delete/1
	 * DELETE /rest/users/1.json
	 */
	function activate($id = null) {
		$redirect_to = $this->getRedirectTo();
		$class_name = $this->getTargetRecordType();
		$record = $class_name::retrieveByPk($id);

		try {

			if (!$record) {
				throw new RuntimeException('No ' . $class_type . ' found for id #' . $id);
			}

			if (!App::hasPerm(Perm::REACTIVATE)) {
				throw new RuntimeException('You do not have permission to reactivate ' . $class_type . ' #' . $id);
			}

			if (null !== $record && $record->activate()) {
				$this['messages'][] = $class_name . ' reactivated';
			} else {
				$this['errors'][] = $class_name . ' could not be reactivated';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect($redirect_to);
		}
	}

	protected function getRedirectTo() {
		return strtolower(str_replace('Controller', '', get_class($this)));
	}

	protected function getTargetRecordType() {
		$class_name = ucfirst(strtolower(str_replace('sController', '', get_class($this))));

		if ($class_name == 'Student') {
			return 'User';
		}

		if ($class_name == 'Quizze') {
			return 'Quiz';
		}

		return $class_name;
	}

}