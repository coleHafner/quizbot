<?php

class StudentsController extends UsersController {

	public function getViewDir() {
		return 'users/';
	}


	function getQuery() {
		if (!App::getClassroom()) {
			throw new RuntimeException('Error: No classroom selected. Cannot get students.');
		}

		$q = App::getClassroom()->getStudentsQuery();
		return User::getQuery($_GET, $q);
	}
}