<?php

class StudentsController extends UsersController {
	public function index() {

		if (!App::getClassroom()) {
			$this->redirect('/');
		}

		$this['users'] = App::getClassroom()->getStudents();
	}
}