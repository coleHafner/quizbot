<?php

class Role {
	const GLOBAL_ADMIN = 1;
	const TEACHER = 2;
	const STUDENT = 3;

	private static $roles = array(
		self::GLOBAL_ADMIN => 'Global Admin',
		self::TEACHER  => 'Teacher',
		self::STUDENT => 'Student'
	);

	private static $role_perms = array(
		self::GLOBAL_ADMIN => array(
			Perm::CLASSROOM_CREATE,
			Perm::CLASSROOM_EDIT,
			Perm::CLASSROOM_DELETE,
			Perm::CLASSROOMS_MANAGE,
			Perm::CLASSROOM_ACT_AS,

			Perm::DEVICE_CREATE,
			Perm::DEVICE_EDIT,
			Perm::DEVICE_DELETE,
			Perm::DEVICES_MANAGE,

			Perm::QUESTION_CREATE,
			Perm::QUESTION_EDIT,
			Perm::QUESTION_DELETE,
			Perm::QUESTIONS_MANAGE,

			Perm::QUIZ_CREATE,
			Perm::QUIZ_EDIT,
			Perm::QUIZ_DELETE,
			Perm::QUIZZES_MANAGE,

			Perm::REACTIVATE,

			Perm::RESULT_CREATE,
			Perm::RESULT_EDIT,
			Perm::RESULT_DELETE,
			Perm::RESULTS_MANAGE,

			Perm::USER_CREATE,
			Perm::USER_EDIT,
			Perm::USER_EDIT_ROLE,
			Perm::USER_DELETE,
			Perm::USERS_MANAGE
		),

		self::TEACHER => array(
			Perm::CLASSROOM_CREATE,
			Perm::CLASSROOM_EDIT,
			Perm::CLASSROOM_DELETE,
			Perm::CLASSROOM_ACT_AS,

			Perm::DEVICE_CREATE,
			Perm::DEVICES_MANAGE,

			Perm::QUESTION_CREATE,
			Perm::QUESTION_EDIT,
			Perm::QUESTION_DELETE,

			Perm::QUIZ_CREATE,
			Perm::QUIZ_EDIT,
			Perm::QUIZ_DELETE,
			Perm::QUIZZES_MANAGE,

			Perm::USER_CREATE,
			Perm::USER_EDIT,
			Perm::USER_DELETE,
			Perm::USERS_MANAGE
		),

		self::STUDENT => array(
		)
	);

	/**
	 * Determines if the role has a specified perm.
	 * @param	int			$role_id
	 * @param	mixed		$perm_id		id or array of ids
	 * @return	boolean
	 */
	static function hasPerm($role_id, $perm_id) {
		$perm_ids = is_array($perm_id) ? $perm_id : array($perm_id);
		$role_perms = !empty(self::$role_perms[$role_id]) ? self::$role_perms[$role_id] : array();

		foreach($perm_ids as $id) {
			if (in_array($perm_id, $role_perms)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @return	array
	 */
	public static function getRoles() {
		return self::$roles;
	}

	/**
	 * @return	array
	 */
	public static function getRolePerms() {
		return self::$role_perms;
	}

	/**
	 * @param	int		$role_id
	 * @return	boolean
	 */
	public static function requiresClassroom($role_id) {
		return in_array($role_id, array(self::STUDENT, self::TEACHER));
	}

	/**
	 * @param	int		$role_id
	 * @return	string
	 */
	public static function getLabel($role_id) {
		return @self::$roles[$role_id];
	}
}