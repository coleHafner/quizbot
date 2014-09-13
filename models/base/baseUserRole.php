<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseUserRole extends ApplicationModel {

	const ID = 'user_role.id';
	const USER_ID = 'user_role.user_id';
	const ROLE_ID = 'user_role.role_id';
	const SESSION_ID = 'user_role.session_id';
	const CLASSROOM_ID = 'user_role.classroom_id';
	const ARCHIVED = 'user_role.archived';
	const CREATED = 'user_role.created';
	const UPDATED = 'user_role.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'user_role';

	/**
	 * Cache of objects retrieved from the database
	 * @var UserRole[]
	 */
	protected static $_instancePool = array();

	protected static $_instancePoolCount = 0;

	protected static $_poolEnabled = true;

	/**
	 * Array of objects to batch insert
	 */
	protected static $_insertBatch = array();

	/**
	 * Maximum size of the insert batch
	 */
	protected static $_insertBatchSize = 500;

	/**
	 * Array of all primary keys
	 * @var string[]
	 */
	protected static $_primaryKeys = array(
		'id',
	);

	/**
	 * string name of the primary key column
	 * @var string
	 */
	protected static $_primaryKey = 'id';

	/**
	 * true if primary key is an auto-increment column
	 * @var bool
	 */
	protected static $_isAutoIncrement = true;

	/**
	 * array of all fully-qualified(table.column) columns
	 * @var string[]
	 */
	protected static $_columns = array(
		UserRole::ID,
		UserRole::USER_ID,
		UserRole::ROLE_ID,
		UserRole::SESSION_ID,
		UserRole::CLASSROOM_ID,
		UserRole::ARCHIVED,
		UserRole::CREATED,
		UserRole::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'user_id',
		'role_id',
		'session_id',
		'classroom_id',
		'archived',
		'created',
		'updated',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'user_id' => Model::COLUMN_TYPE_INTEGER,
		'role_id' => Model::COLUMN_TYPE_INTEGER,
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'classroom_id' => Model::COLUMN_TYPE_INTEGER,
		'archived' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'created' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'updated' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `user_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $user_id;

	/**
	 * `role_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $role_id;

	/**
	 * `session_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $session_id;

	/**
	 * `classroom_id` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $classroom_id;

	/**
	 * `archived` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $archived;

	/**
	 * `created` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $created;

	/**
	 * `updated` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $updated;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return UserRole
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the user_id field
	 */
	function getUserId() {
		return $this->user_id;
	}

	/**
	 * Sets the value of the user_id field
	 * @return UserRole
	 */
	function setUserId($value) {
		return $this->setColumnValue('user_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for UserRole::getUserId
	 * final because getUserId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::getUserId
	 */
	final function getUser_id() {
		return $this->getUserId();
	}

	/**
	 * Convenience function for UserRole::setUserId
	 * final because setUserId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::setUserId
	 * @return UserRole
	 */
	final function setUser_id($value) {
		return $this->setUserId($value);
	}

	/**
	 * Gets the value of the role_id field
	 */
	function getRoleId() {
		return $this->role_id;
	}

	/**
	 * Sets the value of the role_id field
	 * @return UserRole
	 */
	function setRoleId($value) {
		return $this->setColumnValue('role_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for UserRole::getRoleId
	 * final because getRoleId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::getRoleId
	 */
	final function getRole_id() {
		return $this->getRoleId();
	}

	/**
	 * Convenience function for UserRole::setRoleId
	 * final because setRoleId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::setRoleId
	 * @return UserRole
	 */
	final function setRole_id($value) {
		return $this->setRoleId($value);
	}

	/**
	 * Gets the value of the session_id field
	 */
	function getSessionId() {
		return $this->session_id;
	}

	/**
	 * Sets the value of the session_id field
	 * @return UserRole
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for UserRole::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for UserRole::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::setSessionId
	 * @return UserRole
	 */
	final function setSession_id($value) {
		return $this->setSessionId($value);
	}

	/**
	 * Gets the value of the classroom_id field
	 */
	function getClassroomId() {
		return $this->classroom_id;
	}

	/**
	 * Sets the value of the classroom_id field
	 * @return UserRole
	 */
	function setClassroomId($value) {
		return $this->setColumnValue('classroom_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for UserRole::getClassroomId
	 * final because getClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::getClassroomId
	 */
	final function getClassroom_id() {
		return $this->getClassroomId();
	}

	/**
	 * Convenience function for UserRole::setClassroomId
	 * final because setClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see UserRole::setClassroomId
	 * @return UserRole
	 */
	final function setClassroom_id($value) {
		return $this->setClassroomId($value);
	}

	/**
	 * Gets the value of the archived field
	 */
	function getArchived($format = 'Y-m-d H:i:s') {
		if (null === $this->archived || null === $format) {
			return $this->archived;
		}
		return date($format, $this->archived);
	}

	/**
	 * Sets the value of the archived field
	 * @return UserRole
	 */
	function setArchived($value) {
		return $this->setColumnValue('archived', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the created field
	 */
	function getCreated($format = 'Y-m-d H:i:s') {
		if (null === $this->created || null === $format) {
			return $this->created;
		}
		return date($format, $this->created);
	}

	/**
	 * Sets the value of the created field
	 * @return UserRole
	 */
	function setCreated($value) {
		return $this->setColumnValue('created', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the updated field
	 */
	function getUpdated($format = 'Y-m-d H:i:s') {
		if (null === $this->updated || null === $format) {
			return $this->updated;
		}
		return date($format, $this->updated);
	}

	/**
	 * Sets the value of the updated field
	 * @return UserRole
	 */
	function setUpdated($value) {
		return $this->setColumnValue('updated', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_connection');
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return UserRole
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return UserRole
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		if (static::$_poolEnabled) {
			$pool_instance = static::retrieveFromPool($id);
			if (null !== $pool_instance) {
				return $pool_instance;
			}
		}
		$q = new Query;
		$q->add('id', $id);
		return static::doSelectOne($q);
	}

	/**
	 * Searches the database for a row with a id
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveById($value) {
		return UserRole::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a user_id
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveByUserId($value) {
		return static::retrieveByColumn('user_id', $value);
	}

	/**
	 * Searches the database for a row with a role_id
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveByRoleId($value) {
		return static::retrieveByColumn('role_id', $value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a classroom_id
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveByClassroomId($value) {
		return static::retrieveByColumn('classroom_id', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return UserRole
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return UserRole
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->user_id = (null === $this->user_id) ? null : (int) $this->user_id;
		$this->role_id = (null === $this->role_id) ? null : (int) $this->role_id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->classroom_id = (null === $this->classroom_id) ? null : (int) $this->classroom_id;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return UserRole
	 */
	function setUser(User $user = null) {
		return $this->setUserRelatedByUserId($user);
	}

	/**
	 * @return UserRole
	 */
	function setUserRelatedByUserId(User $user = null) {
		if (null === $user) {
			$this->setuser_id(null);
		} else {
			if (!$user->getid()) {
				throw new Exception('Cannot connect a User without a id');
			}
			$this->setuser_id($user->getid());
		}
		return $this;
	}

	/**
	 * Returns a user object with a id
	 * that matches $this->user_id.
	 * @return User
	 */
	function getUser() {
		return $this->getUserRelatedByUserId();
	}

	/**
	 * Returns a user object with a id
	 * that matches $this->user_id.
	 * @return User
	 */
	function getUserRelatedByUserId() {
		$fk_value = $this->getuser_id();
		if (null === $fk_value) {
			return null;
		}
		return User::retrieveByPK($fk_value);
	}

	static function doSelectJoinUser(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinUserRelatedByUserId($q, $join_type);
	}

	/**
	 * @return UserRole[]
	 */
	static function doSelectJoinUserRelatedByUserId(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : static::getTableName();
		if (!$columns) {
			if ($alias) {
				foreach (static::getColumns() as $column_name) {
					$columns[] = $alias . '.' . $column_name;
				}
			} else {
				$columns = static::getColumns();
			}
		}

		$to_table = User::getTableName();
		$q->join($to_table, $this_table . '.user_id = ' . $to_table . '.id', $join_type);
		foreach (User::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('User'));
	}

	/**
	 * @return UserRole
	 */
	function setClassroom(Classroom $classroom = null) {
		return $this->setClassroomRelatedByClassroomId($classroom);
	}

	/**
	 * @return UserRole
	 */
	function setClassroomRelatedByClassroomId(Classroom $classroom = null) {
		if (null === $classroom) {
			$this->setclassroom_id(null);
		} else {
			if (!$classroom->getid()) {
				throw new Exception('Cannot connect a Classroom without a id');
			}
			$this->setclassroom_id($classroom->getid());
		}
		return $this;
	}

	/**
	 * Returns a classroom object with a id
	 * that matches $this->classroom_id.
	 * @return Classroom
	 */
	function getClassroom() {
		return $this->getClassroomRelatedByClassroomId();
	}

	/**
	 * Returns a classroom object with a id
	 * that matches $this->classroom_id.
	 * @return Classroom
	 */
	function getClassroomRelatedByClassroomId() {
		$fk_value = $this->getclassroom_id();
		if (null === $fk_value) {
			return null;
		}
		return Classroom::retrieveByPK($fk_value);
	}

	static function doSelectJoinClassroom(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinClassroomRelatedByClassroomId($q, $join_type);
	}

	/**
	 * @return UserRole[]
	 */
	static function doSelectJoinClassroomRelatedByClassroomId(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : static::getTableName();
		if (!$columns) {
			if ($alias) {
				foreach (static::getColumns() as $column_name) {
					$columns[] = $alias . '.' . $column_name;
				}
			} else {
				$columns = static::getColumns();
			}
		}

		$to_table = Classroom::getTableName();
		$q->join($to_table, $this_table . '.classroom_id = ' . $to_table . '.id', $join_type);
		foreach (Classroom::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('Classroom'));
	}

	/**
	 * @return UserRole
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return UserRole
	 */
	function setSessionRelatedBySessionId(Session $session = null) {
		if (null === $session) {
			$this->setsession_id(null);
		} else {
			if (!$session->getid()) {
				throw new Exception('Cannot connect a Session without a id');
			}
			$this->setsession_id($session->getid());
		}
		return $this;
	}

	/**
	 * Returns a session object with a id
	 * that matches $this->session_id.
	 * @return Session
	 */
	function getSession() {
		return $this->getSessionRelatedBySessionId();
	}

	/**
	 * Returns a session object with a id
	 * that matches $this->session_id.
	 * @return Session
	 */
	function getSessionRelatedBySessionId() {
		$fk_value = $this->getsession_id();
		if (null === $fk_value) {
			return null;
		}
		return Session::retrieveByPK($fk_value);
	}

	static function doSelectJoinSession(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinSessionRelatedBySessionId($q, $join_type);
	}

	/**
	 * @return UserRole[]
	 */
	static function doSelectJoinSessionRelatedBySessionId(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : static::getTableName();
		if (!$columns) {
			if ($alias) {
				foreach (static::getColumns() as $column_name) {
					$columns[] = $alias . '.' . $column_name;
				}
			} else {
				$columns = static::getColumns();
			}
		}

		$to_table = Session::getTableName();
		$q->join($to_table, $this_table . '.session_id = ' . $to_table . '.id', $join_type);
		foreach (Session::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('Session'));
	}

	/**
	 * @return UserRole[]
	 */
	static function doSelectJoinAll(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : static::getTableName();
		if (!$columns) {
			if ($alias) {
				foreach (static::getColumns() as $column_name) {
					$columns[] = $alias . '.' . $column_name;
				}
			} else {
				$columns = static::getColumns();
			}
		}

		$to_table = User::getTableName();
		$q->join($to_table, $this_table . '.user_id = ' . $to_table . '.id', $join_type);
		foreach (User::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'User';
	
		$to_table = Classroom::getTableName();
		$q->join($to_table, $this_table . '.classroom_id = ' . $to_table . '.id', $join_type);
		foreach (Classroom::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Classroom';
	
		$to_table = Session::getTableName();
		$q->join($to_table, $this_table . '.session_id = ' . $to_table . '.id', $join_type);
		foreach (Session::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Session';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getuser_id()) {
			$this->_validationErrors[] = 'user_id must not be null';
		}
		if (null === $this->getrole_id()) {
			$this->_validationErrors[] = 'role_id must not be null';
		}
		if (null === $this->getsession_id()) {
			$this->_validationErrors[] = 'session_id must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}