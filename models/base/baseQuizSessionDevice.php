<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuizSessionDevice extends ApplicationModel {

	const ID = 'quiz_session_device.id';
	const QUIZ_SESSION_ID = 'quiz_session_device.quiz_session_id';
	const DEVICE_ID = 'quiz_session_device.device_id';
	const USER_ID = 'quiz_session_device.user_id';
	const CREATED = 'quiz_session_device.created';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'quiz_session_device';

	/**
	 * Cache of objects retrieved from the database
	 * @var QuizSessionDevice[]
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
		QuizSessionDevice::ID,
		QuizSessionDevice::QUIZ_SESSION_ID,
		QuizSessionDevice::DEVICE_ID,
		QuizSessionDevice::USER_ID,
		QuizSessionDevice::CREATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'quiz_session_id',
		'device_id',
		'user_id',
		'created',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_session_id' => Model::COLUMN_TYPE_INTEGER,
		'device_id' => Model::COLUMN_TYPE_INTEGER,
		'user_id' => Model::COLUMN_TYPE_INTEGER,
		'created' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `quiz_session_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $quiz_session_id;

	/**
	 * `device_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $device_id;

	/**
	 * `user_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $user_id;

	/**
	 * `created` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $created;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return QuizSessionDevice
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the quiz_session_id field
	 */
	function getQuizSessionId() {
		return $this->quiz_session_id;
	}

	/**
	 * Sets the value of the quiz_session_id field
	 * @return QuizSessionDevice
	 */
	function setQuizSessionId($value) {
		return $this->setColumnValue('quiz_session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionDevice::getQuizSessionId
	 * final because getQuizSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionDevice::getQuizSessionId
	 */
	final function getQuiz_session_id() {
		return $this->getQuizSessionId();
	}

	/**
	 * Convenience function for QuizSessionDevice::setQuizSessionId
	 * final because setQuizSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionDevice::setQuizSessionId
	 * @return QuizSessionDevice
	 */
	final function setQuiz_session_id($value) {
		return $this->setQuizSessionId($value);
	}

	/**
	 * Gets the value of the device_id field
	 */
	function getDeviceId() {
		return $this->device_id;
	}

	/**
	 * Sets the value of the device_id field
	 * @return QuizSessionDevice
	 */
	function setDeviceId($value) {
		return $this->setColumnValue('device_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionDevice::getDeviceId
	 * final because getDeviceId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionDevice::getDeviceId
	 */
	final function getDevice_id() {
		return $this->getDeviceId();
	}

	/**
	 * Convenience function for QuizSessionDevice::setDeviceId
	 * final because setDeviceId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionDevice::setDeviceId
	 * @return QuizSessionDevice
	 */
	final function setDevice_id($value) {
		return $this->setDeviceId($value);
	}

	/**
	 * Gets the value of the user_id field
	 */
	function getUserId() {
		return $this->user_id;
	}

	/**
	 * Sets the value of the user_id field
	 * @return QuizSessionDevice
	 */
	function setUserId($value) {
		return $this->setColumnValue('user_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionDevice::getUserId
	 * final because getUserId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionDevice::getUserId
	 */
	final function getUser_id() {
		return $this->getUserId();
	}

	/**
	 * Convenience function for QuizSessionDevice::setUserId
	 * final because setUserId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionDevice::setUserId
	 * @return QuizSessionDevice
	 */
	final function setUser_id($value) {
		return $this->setUserId($value);
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
	 * @return QuizSessionDevice
	 */
	function setCreated($value) {
		return $this->setColumnValue('created', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
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
	 * @return QuizSessionDevice
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return QuizSessionDevice
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
	 * @return QuizSessionDevice
	 */
	static function retrieveById($value) {
		return QuizSessionDevice::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a quiz_session_id
	 * value that matches the one provided
	 * @return QuizSessionDevice
	 */
	static function retrieveByQuizSessionId($value) {
		return static::retrieveByColumn('quiz_session_id', $value);
	}

	/**
	 * Searches the database for a row with a device_id
	 * value that matches the one provided
	 * @return QuizSessionDevice
	 */
	static function retrieveByDeviceId($value) {
		return static::retrieveByColumn('device_id', $value);
	}

	/**
	 * Searches the database for a row with a user_id
	 * value that matches the one provided
	 * @return QuizSessionDevice
	 */
	static function retrieveByUserId($value) {
		return static::retrieveByColumn('user_id', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return QuizSessionDevice
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return QuizSessionDevice
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->quiz_session_id = (null === $this->quiz_session_id) ? null : (int) $this->quiz_session_id;
		$this->device_id = (null === $this->device_id) ? null : (int) $this->device_id;
		$this->user_id = (null === $this->user_id) ? null : (int) $this->user_id;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		return $this;
	}

	/**
	 * @return QuizSessionDevice
	 */
	function setDevice(Device $device = null) {
		return $this->setDeviceRelatedByDeviceId($device);
	}

	/**
	 * @return QuizSessionDevice
	 */
	function setDeviceRelatedByDeviceId(Device $device = null) {
		if (null === $device) {
			$this->setdevice_id(null);
		} else {
			if (!$device->getid()) {
				throw new Exception('Cannot connect a Device without a id');
			}
			$this->setdevice_id($device->getid());
		}
		return $this;
	}

	/**
	 * Returns a device object with a id
	 * that matches $this->device_id.
	 * @return Device
	 */
	function getDevice() {
		return $this->getDeviceRelatedByDeviceId();
	}

	/**
	 * Returns a device object with a id
	 * that matches $this->device_id.
	 * @return Device
	 */
	function getDeviceRelatedByDeviceId() {
		$fk_value = $this->getdevice_id();
		if (null === $fk_value) {
			return null;
		}
		return Device::retrieveByPK($fk_value);
	}

	static function doSelectJoinDevice(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinDeviceRelatedByDeviceId($q, $join_type);
	}

	/**
	 * @return QuizSessionDevice[]
	 */
	static function doSelectJoinDeviceRelatedByDeviceId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = Device::getTableName();
		$q->join($to_table, $this_table . '.device_id = ' . $to_table . '.id', $join_type);
		foreach (Device::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('Device'));
	}

	/**
	 * @return QuizSessionDevice
	 */
	function setUser(User $user = null) {
		return $this->setUserRelatedByUserId($user);
	}

	/**
	 * @return QuizSessionDevice
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
	 * @return QuizSessionDevice[]
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
	 * @return QuizSessionDevice
	 */
	function setQuizSession(QuizSession $quizsession = null) {
		return $this->setQuizSessionRelatedByQuizSessionId($quizsession);
	}

	/**
	 * @return QuizSessionDevice
	 */
	function setQuizSessionRelatedByQuizSessionId(QuizSession $quizsession = null) {
		if (null === $quizsession) {
			$this->setquiz_session_id(null);
		} else {
			if (!$quizsession->getid()) {
				throw new Exception('Cannot connect a QuizSession without a id');
			}
			$this->setquiz_session_id($quizsession->getid());
		}
		return $this;
	}

	/**
	 * Returns a quiz_session object with a id
	 * that matches $this->quiz_session_id.
	 * @return QuizSession
	 */
	function getQuizSession() {
		return $this->getQuizSessionRelatedByQuizSessionId();
	}

	/**
	 * Returns a quiz_session object with a id
	 * that matches $this->quiz_session_id.
	 * @return QuizSession
	 */
	function getQuizSessionRelatedByQuizSessionId() {
		$fk_value = $this->getquiz_session_id();
		if (null === $fk_value) {
			return null;
		}
		return QuizSession::retrieveByPK($fk_value);
	}

	static function doSelectJoinQuizSession(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinQuizSessionRelatedByQuizSessionId($q, $join_type);
	}

	/**
	 * @return QuizSessionDevice[]
	 */
	static function doSelectJoinQuizSessionRelatedByQuizSessionId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = QuizSession::getTableName();
		$q->join($to_table, $this_table . '.quiz_session_id = ' . $to_table . '.id', $join_type);
		foreach (QuizSession::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('QuizSession'));
	}

	/**
	 * @return QuizSessionDevice[]
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

		$to_table = Device::getTableName();
		$q->join($to_table, $this_table . '.device_id = ' . $to_table . '.id', $join_type);
		foreach (Device::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Device';
	
		$to_table = User::getTableName();
		$q->join($to_table, $this_table . '.user_id = ' . $to_table . '.id', $join_type);
		foreach (User::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'User';
	
		$to_table = QuizSession::getTableName();
		$q->join($to_table, $this_table . '.quiz_session_id = ' . $to_table . '.id', $join_type);
		foreach (QuizSession::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'QuizSession';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns a Query for selecting quiz_session_attempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_device_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionAttemptsRelatedByQuizSessionDeviceIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'quiz_session_device_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionAttempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_device_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionAttemptsRelatedByQuizSessionDeviceId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionAttempt::doCount($this->getQuizSessionAttemptsRelatedByQuizSessionDeviceIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_attempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_device_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionAttemptsRelatedByQuizSessionDeviceId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionAttemptsRelatedByQuizSessionDeviceId_c = array();
		return QuizSessionAttempt::doDelete($this->getQuizSessionAttemptsRelatedByQuizSessionDeviceIdQuery($q));
	}

	protected $QuizSessionAttemptsRelatedByQuizSessionDeviceId_c = array();

	/**
	 * Returns an array of QuizSessionAttempt objects with a quiz_session_device_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionAttempt[]
	 */
	function getQuizSessionAttemptsRelatedByQuizSessionDeviceId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionAttemptsRelatedByQuizSessionDeviceId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionAttemptsRelatedByQuizSessionDeviceId_c;
		}

		$result = QuizSessionAttempt::doSelect($this->getQuizSessionAttemptsRelatedByQuizSessionDeviceIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionAttemptsRelatedByQuizSessionDeviceId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for QuizSessionDevice::getQuizSessionAttemptsRelatedByquiz_session_device_id
	 * @return QuizSessionAttempt[]
	 * @see QuizSessionDevice::getQuizSessionAttemptsRelatedByQuizSessionDeviceId
	 */
	function getQuizSessionAttempts($extra = null) {
		return $this->getQuizSessionAttemptsRelatedByQuizSessionDeviceId($extra);
	}

	/**
	  * Convenience function for QuizSessionDevice::getQuizSessionAttemptsRelatedByquiz_session_device_idQuery
	  * @return Query
	  * @see QuizSessionDevice::getQuizSessionAttemptsRelatedByquiz_session_device_idQuery
	  */
	function getQuizSessionAttemptsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'quiz_session_device_id','id', $q);
	}

	/**
	  * Convenience function for QuizSessionDevice::deleteQuizSessionAttemptsRelatedByquiz_session_device_id
	  * @return int
	  * @see QuizSessionDevice::deleteQuizSessionAttemptsRelatedByquiz_session_device_id
	  */
	function deleteQuizSessionAttempts(Query $q = null) {
		return $this->deleteQuizSessionAttemptsRelatedByQuizSessionDeviceId($q);
	}

	/**
	  * Convenience function for QuizSessionDevice::countQuizSessionAttemptsRelatedByquiz_session_device_id
	  * @return int
	  * @see QuizSessionDevice::countQuizSessionAttemptsRelatedByQuizSessionDeviceId
	  */
	function countQuizSessionAttempts(Query $q = null) {
		return $this->countQuizSessionAttemptsRelatedByQuizSessionDeviceId($q);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getquiz_session_id()) {
			$this->_validationErrors[] = 'quiz_session_id must not be null';
		}
		if (null === $this->getdevice_id()) {
			$this->_validationErrors[] = 'device_id must not be null';
		}
		if (null === $this->getuser_id()) {
			$this->_validationErrors[] = 'user_id must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}