<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseDevice extends ApplicationModel {

	const ID = 'device.id';
	const SESSION_ID = 'device.session_id';
	const CLASSROOM_ID = 'device.classroom_id';
	const USER_ID = 'device.user_id';
	const UUID = 'device.uuid';
	const NICKNAME = 'device.nickname';
	const ARCHIVED = 'device.archived';
	const CREATED = 'device.created';
	const UPDATED = 'device.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'device';

	/**
	 * Cache of objects retrieved from the database
	 * @var Device[]
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
		Device::ID,
		Device::SESSION_ID,
		Device::CLASSROOM_ID,
		Device::USER_ID,
		Device::UUID,
		Device::NICKNAME,
		Device::ARCHIVED,
		Device::CREATED,
		Device::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'session_id',
		'classroom_id',
		'user_id',
		'uuid',
		'nickname',
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
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'classroom_id' => Model::COLUMN_TYPE_INTEGER,
		'user_id' => Model::COLUMN_TYPE_INTEGER,
		'uuid' => Model::COLUMN_TYPE_VARCHAR,
		'nickname' => Model::COLUMN_TYPE_VARCHAR,
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
	 * `session_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $session_id;

	/**
	 * `classroom_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $classroom_id;

	/**
	 * `user_id` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $user_id;

	/**
	 * `uuid` VARCHAR NOT NULL
	 * @var string
	 */
	protected $uuid;

	/**
	 * `nickname` VARCHAR
	 * @var string
	 */
	protected $nickname;

	/**
	 * `archived` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $archived;

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
	 * @return Device
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
	 * @return Device
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Device::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Device::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for Device::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Device::setSessionId
	 * @return Device
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
	 * @return Device
	 */
	function setClassroomId($value) {
		return $this->setColumnValue('classroom_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Device::getClassroomId
	 * final because getClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see Device::getClassroomId
	 */
	final function getClassroom_id() {
		return $this->getClassroomId();
	}

	/**
	 * Convenience function for Device::setClassroomId
	 * final because setClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see Device::setClassroomId
	 * @return Device
	 */
	final function setClassroom_id($value) {
		return $this->setClassroomId($value);
	}

	/**
	 * Gets the value of the user_id field
	 */
	function getUserId() {
		return $this->user_id;
	}

	/**
	 * Sets the value of the user_id field
	 * @return Device
	 */
	function setUserId($value) {
		return $this->setColumnValue('user_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Device::getUserId
	 * final because getUserId should be extended instead
	 * to ensure consistent behavior
	 * @see Device::getUserId
	 */
	final function getUser_id() {
		return $this->getUserId();
	}

	/**
	 * Convenience function for Device::setUserId
	 * final because setUserId should be extended instead
	 * to ensure consistent behavior
	 * @see Device::setUserId
	 * @return Device
	 */
	final function setUser_id($value) {
		return $this->setUserId($value);
	}

	/**
	 * Gets the value of the uuid field
	 */
	function getUuid() {
		return $this->uuid;
	}

	/**
	 * Sets the value of the uuid field
	 * @return Device
	 */
	function setUuid($value) {
		return $this->setColumnValue('uuid', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the nickname field
	 */
	function getNickname() {
		return $this->nickname;
	}

	/**
	 * Sets the value of the nickname field
	 * @return Device
	 */
	function setNickname($value) {
		return $this->setColumnValue('nickname', $value, Model::COLUMN_TYPE_VARCHAR);
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
	 * @return Device
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
	 * @return Device
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
	 * @return Device
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
	 * @return Device
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Device
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
	 * @return Device
	 */
	static function retrieveById($value) {
		return Device::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a classroom_id
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByClassroomId($value) {
		return static::retrieveByColumn('classroom_id', $value);
	}

	/**
	 * Searches the database for a row with a user_id
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByUserId($value) {
		return static::retrieveByColumn('user_id', $value);
	}

	/**
	 * Searches the database for a row with a uuid
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByUuid($value) {
		return static::retrieveByColumn('uuid', $value);
	}

	/**
	 * Searches the database for a row with a nickname
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByNickname($value) {
		return static::retrieveByColumn('nickname', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return Device
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return Device
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->classroom_id = (null === $this->classroom_id) ? null : (int) $this->classroom_id;
		$this->user_id = (null === $this->user_id) ? null : (int) $this->user_id;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return Device
	 */
	function setUser(User $user = null) {
		return $this->setUserRelatedByUserId($user);
	}

	/**
	 * @return Device
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
	 * @return Device[]
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
	 * @return Device
	 */
	function setClassroom(Classroom $classroom = null) {
		return $this->setClassroomRelatedByClassroomId($classroom);
	}

	/**
	 * @return Device
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
	 * @return Device[]
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
	 * @return Device
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return Device
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
	 * @return Device[]
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
	 * @return Device[]
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
	 * Returns a Query for selecting quiz_session_attempt Objects(rows) from the quiz_session_attempt table
	 * with a device_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionAttemptsRelatedByDeviceIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'device_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionAttempt Objects(rows) from the quiz_session_attempt table
	 * with a device_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionAttemptsRelatedByDeviceId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionAttempt::doCount($this->getQuizSessionAttemptsRelatedByDeviceIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_attempt Objects(rows) from the quiz_session_attempt table
	 * with a device_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionAttemptsRelatedByDeviceId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionAttemptsRelatedByDeviceId_c = array();
		return QuizSessionAttempt::doDelete($this->getQuizSessionAttemptsRelatedByDeviceIdQuery($q));
	}

	protected $QuizSessionAttemptsRelatedByDeviceId_c = array();

	/**
	 * Returns an array of QuizSessionAttempt objects with a device_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionAttempt[]
	 */
	function getQuizSessionAttemptsRelatedByDeviceId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionAttemptsRelatedByDeviceId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionAttemptsRelatedByDeviceId_c;
		}

		$result = QuizSessionAttempt::doSelect($this->getQuizSessionAttemptsRelatedByDeviceIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionAttemptsRelatedByDeviceId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for Device::getQuizSessionAttemptsRelatedBydevice_id
	 * @return QuizSessionAttempt[]
	 * @see Device::getQuizSessionAttemptsRelatedByDeviceId
	 */
	function getQuizSessionAttempts($extra = null) {
		return $this->getQuizSessionAttemptsRelatedByDeviceId($extra);
	}

	/**
	  * Convenience function for Device::getQuizSessionAttemptsRelatedBydevice_idQuery
	  * @return Query
	  * @see Device::getQuizSessionAttemptsRelatedBydevice_idQuery
	  */
	function getQuizSessionAttemptsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'device_id','id', $q);
	}

	/**
	  * Convenience function for Device::deleteQuizSessionAttemptsRelatedBydevice_id
	  * @return int
	  * @see Device::deleteQuizSessionAttemptsRelatedBydevice_id
	  */
	function deleteQuizSessionAttempts(Query $q = null) {
		return $this->deleteQuizSessionAttemptsRelatedByDeviceId($q);
	}

	/**
	  * Convenience function for Device::countQuizSessionAttemptsRelatedBydevice_id
	  * @return int
	  * @see Device::countQuizSessionAttemptsRelatedByDeviceId
	  */
	function countQuizSessionAttempts(Query $q = null) {
		return $this->countQuizSessionAttemptsRelatedByDeviceId($q);
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
		if (null === $this->getclassroom_id()) {
			$this->_validationErrors[] = 'classroom_id must not be null';
		}
		if (null === $this->getuuid()) {
			$this->_validationErrors[] = 'uuid must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}