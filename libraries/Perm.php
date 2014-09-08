<?php

class Perm {

	const CLASSROOM_CREATE = 9;
	const CLASSROOM_EDIT = 10;
	const CLASSROOM_EDIT_TEACHER = 27;
	const CLASSROOM_DELETE = 11;
	const CLASSROOMS_MANAGE = 12;
	const CLASSROOM_ACT_AS = 26;

	const DEVICE_CREATE = 5;
	const DEVICE_EDIT = 6;
	const DEVICE_EDIT_UUID = 29;
	const DEVICE_EDIT_CLASSROOM = 30;
	const DEVICE_DELETE = 7;
	const DEVICES_MANAGE = 8;

	const QUESTION_CREATE = 13;
	const QUESTION_EDIT = 14;
	const QUESTION_DELETE = 15;
	const QUESTIONS_MANAGE = 16;

	const QUIZ_CREATE = 1;
	const QUIZ_EDIT = 2;
	const QUIZ_DELETE = 3;
	const QUIZZES_MANAGE = 4;

	const REACTIVATE = 28;

	const RESULT_CREATE = 22;
	const RESULT_EDIT = 23;
	const RESULT_DELETE = 24;
	const RESULTS_MANAGE = 25;

	const STUDENT_CREATE = 32;
	const STUDENT_EDIT = 33;
	const STUDENT_DELETE = 34;
	const STUDENTS_MANAGE = 35;

	const USER_CREATE = 17;
	const USER_EDIT = 18;
	const USER_EDIT_TYPE = 31;
	const USER_EDIT_ROLE = 19;
	const USER_DELETE = 20;
	const USERS_MANAGE = 21;

	const ACTION_CREATE = 1;
	const ACTION_EDIT = 2;
	const ACTION_DELETE = 3;



	private static $Action_labels = array(
		self::ACTION_CREATE => 'Create',
		self::ACTION_EDIT => 'Edit',
		self::ACTION_DELETE => 'Delete'
	);

	private static $Perm_labels = array(
		self::CLASSROOM_CREATE => 'Create Classroom',
		self::CLASSROOM_EDIT => 'Edit Classroom',
		self::CLASSROOM_DELETE => 'Delete Classroom',
		self::CLASSROOMS_MANAGE => 'Manage Classrooms',
		self::CLASSROOM_ACT_AS => 'Act As Classroom',

		self::DEVICE_CREATE => 'Create Device',
		self::DEVICE_EDIT => 'Edit Device',
		self::DEVICE_EDIT_UUID => 'Edit Device UUID',
		self::DEVICE_EDIT_CLASSROOM => 'Edit Device Classrom',
		self::DEVICE_DELETE => 'Delete Device',
		self::DEVICES_MANAGE => 'Manage Devices',

		self::QUESTION_CREATE => 'Create Question',
		self::QUESTION_EDIT => 'Edit Question',
		self::QUESTION_DELETE => 'Delete Question',
		self::QUESTIONS_MANAGE => 'Manage Questions',

		self::QUIZ_CREATE => 'Create Quiz',
		self::QUIZ_EDIT => 'Edit Quiz',
		self::QUIZ_DELETE => 'Delete Quiz',
		self::QUIZZES_MANAGE => 'Manage Quizzes',

		self::REACTIVATE => 'Reactivate a record',

		self::RESULT_CREATE => 'Create Result',
		self::RESULT_EDIT => 'Edit Result',
		self::RESULT_DELETE => 'Delete Result',
		self::RESULTS_MANAGE => 'Manage Results',

		self::STUDENT_CREATE => 'Create Student',
		self::STUDENT_EDIT => 'Edit Student',
		self::STUDENT_DELETE => 'Delete Student',
		self::STUDENTS_MANAGE => 'Manage Students',

		self::USER_CREATE => 'Create User',
		self::USER_EDIT => 'Edit User',
		self::USER_EDIT_TYPE => 'Edit User Type',
		self::USER_EDIT_ROLE => 'Edit User Role',
		self::USER_DELETE => 'Delete User',
		self::USERS_MANAGE => 'Manage Users'
	);

	/**
	 * @return	array
	 */
	static function getPermLabels() {
		return self::$Perm_labels;
	}

	/**
	 * @return	array
	 */
	static function getActionLabels() {
		return self::$Action_labels;
	}

	/**
	 * @param	int		$action
	 * @param	mixed	$object		Acction, Dashboard, or Widget
	 * @return	int
	 */
	static function getPermForAction($action, $object) {
		$obj_type = strtoupper(get_class($object));
		$action = strtoupper(self::$Action_labels[$action]);
		$constant_name = 'Perm::' . $obj_type . '_' . $action;
		return constant($constant_name);
	}
}
