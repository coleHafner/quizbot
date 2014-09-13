<?php

class App {

	/**
	 * @var User
	 */
	private static $_user;

	/**
	 * @var Classroom
	 */
	private static $_classroom;

	/**
	 * @var Session
	 */
	private static $_session;

	/**
	 * Starts the whole thing off.
	 * @return	null
	 */
	static function initSession() {
		if (function_exists('session_status')) {
			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}
		}

		$user = self::getUser();

		if (!$user) {
			self::$_session = $_SESSION['session_id'] = null;
			return;
		}

		$session = null;

		if (!empty($_SESSION['session_id'])) {
			$session = Session::retrieveByPK($_SESSION['session_id']);
			if (!$session || @$_SESSION['user_id'] && $session->getUserId() != $_SESSION['user_id']) {
				$session = self::$_session = $_SESSION['session_id'] = null;
			}
		}

		if (!$session) {
			$session = new Session;
			$session->setUser($user);
			$session->setIpAddress(@$_SERVER['REMOTE_ADDR']);
			$session->setUserAgent(@$_SERVER['HTTP_USER_AGENT']);
			$session->setStarted(time());
		}

		$session->setEnded(time());
		$session->save();

		if (empty(self::$_classroom)
			&& $classroom = self::getUser()->getMostRecentClassroomFromSession()) {
			self::switchClassroom($classroom);
		}

		self::$_session = $session;
		$_SESSION['session_id'] = $session->getId();
	}

	static function switchClassroom(Classroom $classroom) {

		if (!self::isLoggedIn()
			|| (self::getClassroom() && (self::getClassroom()->getId() == $classroom->getId()))
			|| (!self::getUser()->teachesClassroom($classroom) && !self::isAdmin())) {
			return false;
		}

		self::setClassroomId($classroom->getId());
		return true;
	}

	/**
	 * @return Session
	 */
	static function getSession() {
		if (self::$_session instanceof Session) {
			return self::$_session;
		}

		if (!empty($_SESSION['session_id'])
			&& $session = Session::retrieveByPk($_SESSION['session_id'])) {
			self::$_session = $session;
			return $session;
		}

		return false;
	}

	/**
	 * Logs in
	 * @return	boolean
	 */
	static function login($username, $password) {
		$user = User::authenticateUser($username, $password);
		if ($user) {
			self::$_user = $user;
			$_SESSION['user_id'] = $user->getId();
			$user->setLastLogin(CURRENT_TIMESTAMP);

			try {
				$user->save();
			} catch (Exception $e) {
				error_log($e);
			}
			return true;
		}
		return false;
	}

	/**
	 * Logs out
	 * @return	null
	 */
	static function logout() {
		$_SESSION = array();
		@session_destroy();
		self::$_session = null;
		self::$_user = null;
	}

	/**
	 * @param	int		$id
	 */
	static function setClassroomId($id) {
		$_SESSION['classroom_id'] = $id;
		self::$_classroom = Classroom::retrieveByPk($id);

		if ($session = self::getSession()) {
			$session->setClassroomId($id);
			$session->save();
		}
	}

	/**
	 *
	 * @param	int		$id
	 */
	static function setUserId($id) {
		$_SESSION['user_id'] = $id;
		self::$_user = User::retrieveByPk($id);
	}

	/**
	 * @return Classroom
	 */
	static function getClassroom() {
		return self::$_classroom instanceof Classroom ?
			self::$_classroom : Classroom::retrieveByPk(self::getClassroomId());
	}

	/**
	 * @return	int
	 */
	static function getClassroomId() {
		return !empty($_SESSION['classroom_id']) ? $_SESSION['classroom_id'] : null;
	}

	/**
	 * @return User
	 */
	static function getUser() {
		return self::$_user instanceof User ?
			self::$_user : User::retrieveByPk(self::getUserId());
	}

	/**
	 * @return	int
	 */
	static function getUserId() {
		return !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
	}

	/**
	 * @return	boolean
	 */
	static function isLoggedIn() {
		return (bool) (self::getUserId() != null);
	}

	/**
	 * @return	boolean
	 */
	static function isAdmin() {
		return (bool) (self::isLoggedIn() && self::getUser()->isAdmin());
	}

	/**
	 * Determines if the currently logged in user has the permission passed
	 * @param	int			$perm		perm id
	 * @return	boolean
	 */
	static function hasPerm($perm) {

		$user = self::getUser();

		if (!$user || !$perm) {
			return false;
		}

		return $user->hasPermission($perm);
	}

	/**
	 * Determines if the currently logged in user can perform the the action
	 * on the object passed
	 * @param	int		$action
	 * @param	mixed	$object
	 * @return	boolean
	 */
	static function can($action, $object) {

		if (App::isAdmin()) {
			return true;
		}

		$user = self::getUser();

		if (!$user || !$object || !$action) {
			return false;
		}

		return $user->can($action, $object);
	}

	/**
	 * Finds the index for the current quiz session.
	 * @return	int
	 */
	static function getQuizSessionIndex() {

		if (!array_key_exists('_quiz_session_index', $_SESSION)) {
			$_SESSION['_quiz_session_index'] = 0;
		}

		return $_SESSION['_quiz_session_index'];
	}

	static function setQuizSessionIndex($index) {
		$_SESSION['_quiz_session_index'] = $index;
	}

}