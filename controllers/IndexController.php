<?php

class IndexController extends ApplicationController {

	function index() {
		if (!App::isLoggedIn()) {
			redirect('login');
		}
	}

	function login() {
		$this->layout = 'layouts/login';
		$this['title'] = 'Login';
	}

	function doLogin() {
		$errors = array();

		if (empty($_REQUEST['username']) || empty($_REQUEST['password'])) {
			$errors[] = 'Please enter your username and password.';
		} else {
			$username = trim($_REQUEST['username']);
			$password = trim($_REQUEST['password']);
			$success = App::login($username, $password);
			if (!$success) {
				$errors[] = 'Invalid username or password';
			}
		}

		if (!empty($errors)) {
			$this->persistant['errors'] = $errors;
			if (!empty($_REQUEST['return'])) {
				$this->persistant['return'] = $_REQUEST['return'];
			}
			$this->redirect('login');
		}

		App::initSession();

		if (App::getUser() && $classroom = App::getUser()->getClassroom()) {
			App::setClassroomId($classroom->getId());
		}

		$goto = !empty($_REQUEST['return']) ? $_REQUEST['return'] : '/';
		$this->redirect($goto);
	}

	function submitAnswer($device_id, $selected_answer) {
		//check for valid device_id
	}

	function logout() {
		App::logout();
		$this->persistant['messages'][] = 'You have been logged out.';
		$this->redirect('/login');
	}
}