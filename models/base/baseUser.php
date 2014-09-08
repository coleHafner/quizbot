<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseUser extends ApplicationModel {

	const ID = 'user.id';
	const SESSION_ID = 'user.session_id';
	const FIRST_NAME = 'user.first_name';
	const LAST_NAME = 'user.last_name';
	const EMAIL = 'user.email';
	const PASSWORD = 'user.password';
	const SALT = 'user.salt';
	const TYPE = 'user.type';
	const ARCHIVED = 'user.archived';
	const LAST_LOGIN = 'user.last_login';
	const CREATED = 'user.created';
	const UPDATED = 'user.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'user';

	/**
	 * Cache of objects retrieved from the database
	 * @var User[]
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
		User::ID,
		User::SESSION_ID,
		User::FIRST_NAME,
		User::LAST_NAME,
		User::EMAIL,
		User::PASSWORD,
		User::SALT,
		User::TYPE,
		User::ARCHIVED,
		User::LAST_LOGIN,
		User::CREATED,
		User::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'session_id',
		'first_name',
		'last_name',
		'email',
		'password',
		'salt',
		'type',
		'archived',
		'last_login',
		'created',
		'updated',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'first_name' => Model::COLUMN_TYPE_VARCHAR,
		'last_name' => Model::COLUMN_TYPE_VARCHAR,
		'email' => Model::COLUMN_TYPE_VARCHAR,
		'password' => Model::COLUMN_TYPE_VARCHAR,
		'salt' => Model::COLUMN_TYPE_VARCHAR,
		'type' => Model::COLUMN_TYPE_INTEGER,
		'archived' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'last_login' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'created' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'updated' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `session_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $session_id;

	/**
	 * `first_name` VARCHAR
	 * @var string
	 */
	protected $first_name;

	/**
	 * `last_name` VARCHAR
	 * @var string
	 */
	protected $last_name;

	/**
	 * `email` VARCHAR NOT NULL
	 * @var string
	 */
	protected $email;

	/**
	 * `password` VARCHAR NOT NULL
	 * @var string
	 */
	protected $password;

	/**
	 * `salt` VARCHAR NOT NULL
	 * @var string
	 */
	protected $salt;

	/**
	 * `type` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $type;

	/**
	 * `archived` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $archived;

	/**
	 * `last_login` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $last_login;

	/**
	 * `created` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $created;

	/**
	 * `updated` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
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
	 * @return User
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the session_id field
	 */
	function getSessionId() {
		return $this->session_id;
	}

	/**
	 * Sets the value of the session_id field
	 * @return User
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for User::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see User::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for User::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see User::setSessionId
	 * @return User
	 */
	final function setSession_id($value) {
		return $this->setSessionId($value);
	}

	/**
	 * Gets the value of the first_name field
	 */
	function getFirstName() {
		return $this->first_name;
	}

	/**
	 * Sets the value of the first_name field
	 * @return User
	 */
	function setFirstName($value) {
		return $this->setColumnValue('first_name', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Convenience function for User::getFirstName
	 * final because getFirstName should be extended instead
	 * to ensure consistent behavior
	 * @see User::getFirstName
	 */
	final function getFirst_name() {
		return $this->getFirstName();
	}

	/**
	 * Convenience function for User::setFirstName
	 * final because setFirstName should be extended instead
	 * to ensure consistent behavior
	 * @see User::setFirstName
	 * @return User
	 */
	final function setFirst_name($value) {
		return $this->setFirstName($value);
	}

	/**
	 * Gets the value of the last_name field
	 */
	function getLastName() {
		return $this->last_name;
	}

	/**
	 * Sets the value of the last_name field
	 * @return User
	 */
	function setLastName($value) {
		return $this->setColumnValue('last_name', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Convenience function for User::getLastName
	 * final because getLastName should be extended instead
	 * to ensure consistent behavior
	 * @see User::getLastName
	 */
	final function getLast_name() {
		return $this->getLastName();
	}

	/**
	 * Convenience function for User::setLastName
	 * final because setLastName should be extended instead
	 * to ensure consistent behavior
	 * @see User::setLastName
	 * @return User
	 */
	final function setLast_name($value) {
		return $this->setLastName($value);
	}

	/**
	 * Gets the value of the email field
	 */
	function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the value of the email field
	 * @return User
	 */
	function setEmail($value) {
		return $this->setColumnValue('email', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the password field
	 */
	function getPassword() {
		return $this->password;
	}

	/**
	 * Sets the value of the password field
	 * @return User
	 */
	function setPassword($value) {
		return $this->setColumnValue('password', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the salt field
	 */
	function getSalt() {
		return $this->salt;
	}

	/**
	 * Sets the value of the salt field
	 * @return User
	 */
	function setSalt($value) {
		return $this->setColumnValue('salt', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the type field
	 */
	function getType() {
		return $this->type;
	}

	/**
	 * Sets the value of the type field
	 * @return User
	 */
	function setType($value) {
		return $this->setColumnValue('type', $value, Model::COLUMN_TYPE_INTEGER);
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
	 * @return User
	 */
	function setArchived($value) {
		return $this->setColumnValue('archived', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the last_login field
	 */
	function getLastLogin($format = 'Y-m-d H:i:s') {
		if (null === $this->last_login || null === $format) {
			return $this->last_login;
		}
		return date($format, $this->last_login);
	}

	/**
	 * Sets the value of the last_login field
	 * @return User
	 */
	function setLastLogin($value) {
		return $this->setColumnValue('last_login', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Convenience function for User::getLastLogin
	 * final because getLastLogin should be extended instead
	 * to ensure consistent behavior
	 * @see User::getLastLogin
	 */
	final function getLast_login($format = 'Y-m-d H:i:s') {
		return $this->getLastLogin($format);
	}

	/**
	 * Convenience function for User::setLastLogin
	 * final because setLastLogin should be extended instead
	 * to ensure consistent behavior
	 * @see User::setLastLogin
	 * @return User
	 */
	final function setLast_login($value) {
		return $this->setLastLogin($value);
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
	 * @return User
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
	 * @return User
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
	 * @return User
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return User
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
	 * @return User
	 */
	static function retrieveById($value) {
		return User::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a first_name
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByFirstName($value) {
		return static::retrieveByColumn('first_name', $value);
	}

	/**
	 * Searches the database for a row with a last_name
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByLastName($value) {
		return static::retrieveByColumn('last_name', $value);
	}

	/**
	 * Searches the database for a row with a email
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByEmail($value) {
		return static::retrieveByColumn('email', $value);
	}

	/**
	 * Searches the database for a row with a password
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByPassword($value) {
		return static::retrieveByColumn('password', $value);
	}

	/**
	 * Searches the database for a row with a salt
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveBySalt($value) {
		return static::retrieveByColumn('salt', $value);
	}

	/**
	 * Searches the database for a row with a type
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByType($value) {
		return static::retrieveByColumn('type', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a last_login
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByLastLogin($value) {
		return static::retrieveByColumn('last_login', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return User
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return User
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->type = (null === $this->type) ? null : (int) $this->type;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->last_login = (null === $this->last_login) ? null : (int) $this->last_login;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return User
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return User
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
	 * @return User[]
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
	 * @return User[]
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
	 * Returns a Query for selecting quiz_session_device Objects(rows) from the quiz_session_device table
	 * with a user_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionDevicesRelatedByUserIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_device', 'user_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionDevice Objects(rows) from the quiz_session_device table
	 * with a user_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionDevicesRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionDevice::doCount($this->getQuizSessionDevicesRelatedByUserIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_device Objects(rows) from the quiz_session_device table
	 * with a user_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionDevicesRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionDevicesRelatedByUserId_c = array();
		return QuizSessionDevice::doDelete($this->getQuizSessionDevicesRelatedByUserIdQuery($q));
	}

	protected $QuizSessionDevicesRelatedByUserId_c = array();

	/**
	 * Returns an array of QuizSessionDevice objects with a user_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionDevice[]
	 */
	function getQuizSessionDevicesRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionDevicesRelatedByUserId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionDevicesRelatedByUserId_c;
		}

		$result = QuizSessionDevice::doSelect($this->getQuizSessionDevicesRelatedByUserIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionDevicesRelatedByUserId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting session Objects(rows) from the session table
	 * with a user_id that matches $this->id.
	 * @return Query
	 */
	function getSessionsRelatedByUserIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('session', 'user_id', 'id', $q);
	}

	/**
	 * Returns the count of Session Objects(rows) from the session table
	 * with a user_id that matches $this->id.
	 * @return int
	 */
	function countSessionsRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Session::doCount($this->getSessionsRelatedByUserIdQuery($q));
	}

	/**
	 * Deletes the session Objects(rows) from the session table
	 * with a user_id that matches $this->id.
	 * @return int
	 */
	function deleteSessionsRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->SessionsRelatedByUserId_c = array();
		return Session::doDelete($this->getSessionsRelatedByUserIdQuery($q));
	}

	protected $SessionsRelatedByUserId_c = array();

	/**
	 * Returns an array of Session objects with a user_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Session[]
	 */
	function getSessionsRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->SessionsRelatedByUserId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->SessionsRelatedByUserId_c;
		}

		$result = Session::doSelect($this->getSessionsRelatedByUserIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->SessionsRelatedByUserId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting user_role Objects(rows) from the user_role table
	 * with a user_id that matches $this->id.
	 * @return Query
	 */
	function getUserRolesRelatedByUserIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user_role', 'user_id', 'id', $q);
	}

	/**
	 * Returns the count of UserRole Objects(rows) from the user_role table
	 * with a user_id that matches $this->id.
	 * @return int
	 */
	function countUserRolesRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return UserRole::doCount($this->getUserRolesRelatedByUserIdQuery($q));
	}

	/**
	 * Deletes the user_role Objects(rows) from the user_role table
	 * with a user_id that matches $this->id.
	 * @return int
	 */
	function deleteUserRolesRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->UserRolesRelatedByUserId_c = array();
		return UserRole::doDelete($this->getUserRolesRelatedByUserIdQuery($q));
	}

	protected $UserRolesRelatedByUserId_c = array();

	/**
	 * Returns an array of UserRole objects with a user_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return UserRole[]
	 */
	function getUserRolesRelatedByUserId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->UserRolesRelatedByUserId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->UserRolesRelatedByUserId_c;
		}

		$result = UserRole::doSelect($this->getUserRolesRelatedByUserIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->UserRolesRelatedByUserId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for User::getQuizSessionDevicesRelatedByuser_id
	 * @return QuizSessionDevice[]
	 * @see User::getQuizSessionDevicesRelatedByUserId
	 */
	function getQuizSessionDevices($extra = null) {
		return $this->getQuizSessionDevicesRelatedByUserId($extra);
	}

	/**
	  * Convenience function for User::getQuizSessionDevicesRelatedByuser_idQuery
	  * @return Query
	  * @see User::getQuizSessionDevicesRelatedByuser_idQuery
	  */
	function getQuizSessionDevicesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_device', 'user_id','id', $q);
	}

	/**
	  * Convenience function for User::deleteQuizSessionDevicesRelatedByuser_id
	  * @return int
	  * @see User::deleteQuizSessionDevicesRelatedByuser_id
	  */
	function deleteQuizSessionDevices(Query $q = null) {
		return $this->deleteQuizSessionDevicesRelatedByUserId($q);
	}

	/**
	  * Convenience function for User::countQuizSessionDevicesRelatedByuser_id
	  * @return int
	  * @see User::countQuizSessionDevicesRelatedByUserId
	  */
	function countQuizSessionDevices(Query $q = null) {
		return $this->countQuizSessionDevicesRelatedByUserId($q);
	}

	/**
	 * Convenience function for User::getSessionsRelatedByuser_id
	 * @return Session[]
	 * @see User::getSessionsRelatedByUserId
	 */
	function getSessions($extra = null) {
		return $this->getSessionsRelatedByUserId($extra);
	}

	/**
	  * Convenience function for User::getSessionsRelatedByuser_idQuery
	  * @return Query
	  * @see User::getSessionsRelatedByuser_idQuery
	  */
	function getSessionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('session', 'user_id','id', $q);
	}

	/**
	  * Convenience function for User::deleteSessionsRelatedByuser_id
	  * @return int
	  * @see User::deleteSessionsRelatedByuser_id
	  */
	function deleteSessions(Query $q = null) {
		return $this->deleteSessionsRelatedByUserId($q);
	}

	/**
	  * Convenience function for User::countSessionsRelatedByuser_id
	  * @return int
	  * @see User::countSessionsRelatedByUserId
	  */
	function countSessions(Query $q = null) {
		return $this->countSessionsRelatedByUserId($q);
	}

	/**
	 * Convenience function for User::getUserRolesRelatedByuser_id
	 * @return UserRole[]
	 * @see User::getUserRolesRelatedByUserId
	 */
	function getUserRoles($extra = null) {
		return $this->getUserRolesRelatedByUserId($extra);
	}

	/**
	  * Convenience function for User::getUserRolesRelatedByuser_idQuery
	  * @return Query
	  * @see User::getUserRolesRelatedByuser_idQuery
	  */
	function getUserRolesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user_role', 'user_id','id', $q);
	}

	/**
	  * Convenience function for User::deleteUserRolesRelatedByuser_id
	  * @return int
	  * @see User::deleteUserRolesRelatedByuser_id
	  */
	function deleteUserRoles(Query $q = null) {
		return $this->deleteUserRolesRelatedByUserId($q);
	}

	/**
	  * Convenience function for User::countUserRolesRelatedByuser_id
	  * @return int
	  * @see User::countUserRolesRelatedByUserId
	  */
	function countUserRoles(Query $q = null) {
		return $this->countUserRolesRelatedByUserId($q);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getsession_id()) {
			$this->_validationErrors[] = 'session_id must not be null';
		}
		if (null === $this->getemail()) {
			$this->_validationErrors[] = 'email must not be null';
		}
		if (null === $this->getpassword()) {
			$this->_validationErrors[] = 'password must not be null';
		}
		if (null === $this->getsalt()) {
			$this->_validationErrors[] = 'salt must not be null';
		}
		if (null === $this->gettype()) {
			$this->_validationErrors[] = 'type must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}