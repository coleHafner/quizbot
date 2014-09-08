<?php

class User extends baseUser {

	const TYPE_ADMIN = 1;
	const TYPE_USER = 2;
	const SYS_USER_EMAIL = 'system@quizbot.com';

	static $types = array(
		self::TYPE_USER => 'User',
		self::TYPE_ADMIN => 'Admin',
	);

	function __toString() {
		return $this->getFirstName() . ' ' . $this->getLastName();
	}

	function isAdmin() {
		return (bool) ($this->getType() == self::TYPE_ADMIN);
	}

	/**
	 * @param	mixed		$perm_id			id of the permission or array of ids
	 * @return	boolean
	 */
	function hasPermission($perm_id) {

		if ($this->isAdmin()) {
			return true;
		}

		foreach ($this->getRoles() as $user_role) {
			if (Role::hasPerm($user_role->getRoleId(), $perm_id)) {
				return true;
			}
		}

		return false;
	}

	function can($action, $object) {

		if ($this->isAdmin()) {
			return true;
		}

		$can = false;

		if ($object instanceof Classroom) {
			$can = $this->hasClassroomPerm($object);

		}else if ($object instanceof User) {
			$can = $this->hasStudentPerm($object);

		}else if ($object instanceof Quiz) {
			$can = $this->hasQuizPerm($object);

		}else if ($object instanceof Question) {
			$can = $this->hasQuestionPerm($object);

		}else if ($object instanceof Device) {
			$can = $this->hasDevicePerm($object);

		}else {
			throw new RuntimeException('Error: Object of type ' . get_class($object) . ' is not recognized.');
		}

		$perm_id = Perm::getPermForAction($action, $object);
		return ($this->hasPermission($perm_id) && $can);
	}

	/**
	 * Based on the account sent, check permissions to manage accounts.
	 * @param	Classroom	$classroom		Classroom in question
	 * @return	boolean
	 */
	function hasClassroomPerm(Classroom $classroom) {

		if ($this->isAdmin()) {
			return true;
		}

		//@TODO - create createdByUserId
		if ($this->teachesClassroom($classroom)) {
			return true;
		}

		return false;
	}

	/**
	 * Based on the account sent, check permissions to manage accounts.
	 * @param	Quiz	$quiz
	 * @return	boolean
	 */
	function hasQuizPerm(Quiz $quiz) {

		if ($this->isAdmin()) {
			return true;
		}

		return $this->hasClassroom($quiz->getClassroom());
	}

	/**
	 * Based on the account sent, check permissions to manage accounts.
	 * @param	Classroom	$classroom		Classroom in question
	 * @return	boolean
	 */
	function hasStudentPerm(User $student) {

		if ($this->isAdmin()) {
			return true;
		}

		$classrooms = $student->getClassrooms();

		foreach ($classrooms as $classroom) {
			if ($this->teachesClassroom($classroom)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Based on the account sent, check permissions to manage accounts.
	 * @param	Question	$question		Question
	 * @return	boolean
	 */
	function hasQuestionPerm(Question $question) {

		if ($this->isAdmin()) {
			return true;
		}

		return $this->hasQuizPerm($question->getQuiz());
	}

	/**
	 * Based on the account sent, check permissions to manage accounts.
	 * @param	Device		$device		Device
	 * @return	boolean
	 */
	function hasDevicePerm(Device $device) {

		if ($this->isAdmin()) {
			return true;
		}

		return $this->hasClassroomPerm($device->getClassroom());
	}

	/**
	 * Gets the classrooms the in which the current has the role specified.
	 * @param	int		$role_id		role
	 * @return	Classroom[]
	 */
	function getClassrooms($role_id = null) {

		$q = Query::create()->setTable(Classroom::getTableName());

		if (!$this->isAdmin()) {
			$role_id = empty($role_id) ? Role::TEACHER : $role_id;

			$q->join(Classroom::ID, UserRole::CLASSROOM_ID)
				->add(UserRole::USER_ID, $this->getId())
				->add(UserRole::ROLE_ID, $role_id)
				->add(Classroom::ARCHIVED, null)
				->groupBy(UserRole::CLASSROOM_ID);
		}

		return Classroom::doSelect($q);
	}

	/**
	 * Gets the first account this user has a role for
	 * @param	Query		$q		optional
	 * @return	Account
	 */
	function getClassroom(Query $q = null) {
		$q = $q ? clone $q : new Query;

		$q->join(Classroom::ID, UserRole::CLASSROOM_ID)
			->add(UserRole::USER_ID, $this->getId())
			->orderBy(UserRole::CLASSROOM_ID, Query::ASC);

		return Classroom::doSelectOne($q);
	}

	function getMostRecentClassroomFromSession(Query $q = null) {
		$q = $q ? clone $q : new Query;

		$q->join(Classroom::ID, Session::CLASSROOM_ID)
			->add(Session::USER_ID, $this->getId())
			->orderBy(Session::ENDED, Query::DESC);

		return Classroom::doSelectOne($q);
	}

	/**
	 * @param	Account		$account		account
	 * @return	boolean
	 */
	function hasClassroom(Classroom $classroom) {
		return $this->getClassroom(Query::create()
			->add(UserRole::CLASSROOM_ID, $classroom->getId())
		) instanceof Classroom;
	}

	/**
	 * @param	Account		$account
	 * @return	boolean
	 */
	function teachesClassroom(Classroom $classroom) {
		return $this->getClassroom(Query::create()
			->add(UserRole::CLASSROOM_ID, $classroom->getId())
			->add(UserRole::ROLE_ID, Role::TEACHER)
		) instanceof Classroom;
	}

	/**
	 * Returns all roles for this user.
	 * @return	UserRole[]
	 */
	function getRoles() {
		return $this->getUserRoles();
	}

	/**
	 * @param	int			$role_id		id of the role
	 * @param	Classroom	$classroom		classroom. optional.
	 * @return	boolean
	 */
	function hasRole($role_id, Classroom $classroom = null) {
		return $this->getUserRolesQuery()
			->add(UserRole::ROLE_ID, $role_id)
			->doCount() > 0;
	}

	/**
	 * @return	string
	 */
	function getTypeName() {
		return $this->getType() ? self::$types[$this->getType()] : null;
	}

	/**
	 * @return	boolean
	 */
	function hasAnyRole() {
		return UserRole::doCount(Query::create()->add(UserRole::USER_ID, $this->getId())) > 0;
	}

	/**
	 * Adds a role.
	 * @param	int		$role_id		id of the role
	 * @param	Session	$session		current session
	 * @param	int		$classroom_id	id of the classroom. optional.
	 * @return	boolean
	 */
	function addRole($role_id, Session $session, $classroom_id = null) {
		$classroom = $classroom_id !== null ? Classroom::retrieveByPk($classroom_id) : null;

		if (!$classroom && Role::requiresClassroom($role_id)) {
			throw new RuntimeException('Role "' . Role::getLabel($role_id) . ' requires a classroom. Cannot continue.');
		}

		$ur = new UserRole;
		$ur->setRoleId($role_id);
		$ur->setUser($this);
		$ur->setSession($session);

		if ($classroom) {
			$ur->setClassroom($classroom);
		}

		return $ur->save();
	}

	/**
	 * Deletes all user roles for this user.
	 * @return	array
	 */
	public function clearRoles() {
		return array_map(function($ur) {
			$ur->delete();
		}, $this->getUserRoles());
	}

	public function validate() {

		if (filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL) === false) {
			$this->_validationErrors[] = 'You must provide a valid email';
		}

		if (!$this->getSession()) {
			$this->_validationErrors[] = 'You must provide a session.';
		}

		if ($this->isNew()) {
			if (!$this->getSalt()) {
				$this->_validationErrors[] = 'You must provide a salt.';
			}

			if (!$this->getPassword()) {
				$this->_validationErrors[] = 'You must provide a password.';
			}
		}

		if (!$this->getFirstName()) {
			$this->_validationErrors[] = 'You must provide a first name.';
		}

		if (!$this->getLastName()) {
			$this->_validationErrors[] = 'You must provide a last	 name.';
		}

		return count($this->_validationErrors) == 0;
	}

	static function getTypes() {
		return self::$types;
	}

	/**
	 * @param	Query	$q		optional.
	 * @return	User[]
	 */
	static function getTeachers(Query $q = null) {
		$q = !$q ? new Query : $q;
		$q->add(UserRole::CLASSROOM_ID, null, Query::IS_NOT_NULL);
		return self::getUsersWithRole(Role::TEACHER, $q);
	}

	/**
	 * @param	Query	$q		optional.
	 * @return	User[]
	 */
	static function getStudents(Query $q = null) {
		$q = !$q ? new Query : $q;
		$q->add(UserRole::CLASSROOM_ID, null, Query::IS_NOT_NULL);
		return self::getUsersWithRole(Role::STUDENT, $q);
	}

	/**
	 * @param	int		$role_id	id of the role
	 * @param	Query	$q			optional.
	 * @return	User[]
	 */
	static function getUsersWithRole($role_id, Query $q = null) {
		$q = !$q ? new Query : $q;
		$q->join(User::ID, UserRole::USER_ID);
		$q->add(UserRole::ROLE_ID, $role_id);
		return User::doSelect($q);
	}

	static function encryptPassword($password, $salt) {
		if (!$password || !$salt) {
			return null;
		}

		return hash('sha512', SYSTEM_SALT . $password . $salt);
	}

	static function generateSalt() {
		$salt = '';

		for ($i = 0; $i < 100; $i++) {
			$salt .= chr(mt_rand(35, 126));
		}
		return $salt;
	}

	static function authenticateUser($email, $password) {
		$email = trim($email);
		$password = trim($password);
		$user = User::retrieveByEmail($email);

		if ($user && $user->getActive()) {

			if (defined('DEV_BYPASS') && DEV_BYPASS === true) {
				return $user;
			}

			$hash = self::encryptPassword($password, $user->getSalt());
			if ($hash == $user->getPassword()) {
				return $user;
			}
		}

		return false;
	}

	static function generatePassword($length) {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNPQRSTUWXYZ123456789";
		$pass = '';
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass .= $alphabet[$n];
		}
		return ($pass);
	}
}