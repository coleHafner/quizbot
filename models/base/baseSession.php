<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseSession extends ApplicationModel {

	const ID = 'session.id';
	const USER_ID = 'session.user_id';
	const CLASSROOM_ID = 'session.classroom_id';
	const IP_ADDRESS = 'session.ip_address';
	const USER_AGENT = 'session.user_agent';
	const STARTED = 'session.started';
	const ENDED = 'session.ended';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'session';

	/**
	 * Cache of objects retrieved from the database
	 * @var Session[]
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
		Session::ID,
		Session::USER_ID,
		Session::CLASSROOM_ID,
		Session::IP_ADDRESS,
		Session::USER_AGENT,
		Session::STARTED,
		Session::ENDED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'user_id',
		'classroom_id',
		'ip_address',
		'user_agent',
		'started',
		'ended',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'user_id' => Model::COLUMN_TYPE_INTEGER,
		'classroom_id' => Model::COLUMN_TYPE_INTEGER,
		'ip_address' => Model::COLUMN_TYPE_VARCHAR,
		'user_agent' => Model::COLUMN_TYPE_VARCHAR,
		'started' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'ended' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `user_id` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $user_id;

	/**
	 * `classroom_id` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $classroom_id;

	/**
	 * `ip_address` VARCHAR
	 * @var string
	 */
	protected $ip_address;

	/**
	 * `user_agent` VARCHAR
	 * @var string
	 */
	protected $user_agent;

	/**
	 * `started` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $started;

	/**
	 * `ended` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $ended;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Session
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
	 * @return Session
	 */
	function setUserId($value) {
		return $this->setColumnValue('user_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Session::getUserId
	 * final because getUserId should be extended instead
	 * to ensure consistent behavior
	 * @see Session::getUserId
	 */
	final function getUser_id() {
		return $this->getUserId();
	}

	/**
	 * Convenience function for Session::setUserId
	 * final because setUserId should be extended instead
	 * to ensure consistent behavior
	 * @see Session::setUserId
	 * @return Session
	 */
	final function setUser_id($value) {
		return $this->setUserId($value);
	}

	/**
	 * Gets the value of the classroom_id field
	 */
	function getClassroomId() {
		return $this->classroom_id;
	}

	/**
	 * Sets the value of the classroom_id field
	 * @return Session
	 */
	function setClassroomId($value) {
		return $this->setColumnValue('classroom_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Session::getClassroomId
	 * final because getClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see Session::getClassroomId
	 */
	final function getClassroom_id() {
		return $this->getClassroomId();
	}

	/**
	 * Convenience function for Session::setClassroomId
	 * final because setClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see Session::setClassroomId
	 * @return Session
	 */
	final function setClassroom_id($value) {
		return $this->setClassroomId($value);
	}

	/**
	 * Gets the value of the ip_address field
	 */
	function getIpAddress() {
		return $this->ip_address;
	}

	/**
	 * Sets the value of the ip_address field
	 * @return Session
	 */
	function setIpAddress($value) {
		return $this->setColumnValue('ip_address', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Convenience function for Session::getIpAddress
	 * final because getIpAddress should be extended instead
	 * to ensure consistent behavior
	 * @see Session::getIpAddress
	 */
	final function getIp_address() {
		return $this->getIpAddress();
	}

	/**
	 * Convenience function for Session::setIpAddress
	 * final because setIpAddress should be extended instead
	 * to ensure consistent behavior
	 * @see Session::setIpAddress
	 * @return Session
	 */
	final function setIp_address($value) {
		return $this->setIpAddress($value);
	}

	/**
	 * Gets the value of the user_agent field
	 */
	function getUserAgent() {
		return $this->user_agent;
	}

	/**
	 * Sets the value of the user_agent field
	 * @return Session
	 */
	function setUserAgent($value) {
		return $this->setColumnValue('user_agent', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Convenience function for Session::getUserAgent
	 * final because getUserAgent should be extended instead
	 * to ensure consistent behavior
	 * @see Session::getUserAgent
	 */
	final function getUser_agent() {
		return $this->getUserAgent();
	}

	/**
	 * Convenience function for Session::setUserAgent
	 * final because setUserAgent should be extended instead
	 * to ensure consistent behavior
	 * @see Session::setUserAgent
	 * @return Session
	 */
	final function setUser_agent($value) {
		return $this->setUserAgent($value);
	}

	/**
	 * Gets the value of the started field
	 */
	function getStarted($format = 'Y-m-d H:i:s') {
		if (null === $this->started || null === $format) {
			return $this->started;
		}
		return date($format, $this->started);
	}

	/**
	 * Sets the value of the started field
	 * @return Session
	 */
	function setStarted($value) {
		return $this->setColumnValue('started', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the ended field
	 */
	function getEnded($format = 'Y-m-d H:i:s') {
		if (null === $this->ended || null === $format) {
			return $this->ended;
		}
		return date($format, $this->ended);
	}

	/**
	 * Sets the value of the ended field
	 * @return Session
	 */
	function setEnded($value) {
		return $this->setColumnValue('ended', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
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
	 * @return Session
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Session
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
	 * @return Session
	 */
	static function retrieveById($value) {
		return Session::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a user_id
	 * value that matches the one provided
	 * @return Session
	 */
	static function retrieveByUserId($value) {
		return static::retrieveByColumn('user_id', $value);
	}

	/**
	 * Searches the database for a row with a classroom_id
	 * value that matches the one provided
	 * @return Session
	 */
	static function retrieveByClassroomId($value) {
		return static::retrieveByColumn('classroom_id', $value);
	}

	/**
	 * Searches the database for a row with a ip_address
	 * value that matches the one provided
	 * @return Session
	 */
	static function retrieveByIpAddress($value) {
		return static::retrieveByColumn('ip_address', $value);
	}

	/**
	 * Searches the database for a row with a user_agent
	 * value that matches the one provided
	 * @return Session
	 */
	static function retrieveByUserAgent($value) {
		return static::retrieveByColumn('user_agent', $value);
	}

	/**
	 * Searches the database for a row with a started
	 * value that matches the one provided
	 * @return Session
	 */
	static function retrieveByStarted($value) {
		return static::retrieveByColumn('started', $value);
	}

	/**
	 * Searches the database for a row with a ended
	 * value that matches the one provided
	 * @return Session
	 */
	static function retrieveByEnded($value) {
		return static::retrieveByColumn('ended', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return Session
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->user_id = (null === $this->user_id) ? null : (int) $this->user_id;
		$this->classroom_id = (null === $this->classroom_id) ? null : (int) $this->classroom_id;
		$this->started = (null === $this->started) ? null : (int) $this->started;
		$this->ended = (null === $this->ended) ? null : (int) $this->ended;
		return $this;
	}

	/**
	 * @return Session
	 */
	function setClassroom(Classroom $classroom = null) {
		return $this->setClassroomRelatedByClassroomId($classroom);
	}

	/**
	 * @return Session
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
	 * @return Session[]
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
	 * @return Session
	 */
	function setUser(User $user = null) {
		return $this->setUserRelatedByUserId($user);
	}

	/**
	 * @return Session
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
	 * @return Session[]
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
	 * @return Session[]
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

		$to_table = Classroom::getTableName();
		$q->join($to_table, $this_table . '.classroom_id = ' . $to_table . '.id', $join_type);
		foreach (Classroom::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Classroom';
	
		$to_table = User::getTableName();
		$q->join($to_table, $this_table . '.user_id = ' . $to_table . '.id', $join_type);
		foreach (User::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'User';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns a Query for selecting classroom Objects(rows) from the classroom table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getClassroomsRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('classroom', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of Classroom Objects(rows) from the classroom table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countClassroomsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Classroom::doCount($this->getClassroomsRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the classroom Objects(rows) from the classroom table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteClassroomsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->ClassroomsRelatedBySessionId_c = array();
		return Classroom::doDelete($this->getClassroomsRelatedBySessionIdQuery($q));
	}

	protected $ClassroomsRelatedBySessionId_c = array();

	/**
	 * Returns an array of Classroom objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Classroom[]
	 */
	function getClassroomsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->ClassroomsRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->ClassroomsRelatedBySessionId_c;
		}

		$result = Classroom::doSelect($this->getClassroomsRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->ClassroomsRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting device Objects(rows) from the device table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getDevicesRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('device', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of Device Objects(rows) from the device table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countDevicesRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Device::doCount($this->getDevicesRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the device Objects(rows) from the device table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteDevicesRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->DevicesRelatedBySessionId_c = array();
		return Device::doDelete($this->getDevicesRelatedBySessionIdQuery($q));
	}

	protected $DevicesRelatedBySessionId_c = array();

	/**
	 * Returns an array of Device objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Device[]
	 */
	function getDevicesRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->DevicesRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->DevicesRelatedBySessionId_c;
		}

		$result = Device::doSelect($this->getDevicesRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->DevicesRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting question Objects(rows) from the question table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getQuestionsRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of Question Objects(rows) from the question table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countQuestionsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Question::doCount($this->getQuestionsRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the question Objects(rows) from the question table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuestionsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuestionsRelatedBySessionId_c = array();
		return Question::doDelete($this->getQuestionsRelatedBySessionIdQuery($q));
	}

	protected $QuestionsRelatedBySessionId_c = array();

	/**
	 * Returns an array of Question objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Question[]
	 */
	function getQuestionsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuestionsRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuestionsRelatedBySessionId_c;
		}

		$result = Question::doSelect($this->getQuestionsRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuestionsRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting question_answer Objects(rows) from the question_answer table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getQuestionAnswersRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question_answer', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of QuestionAnswer Objects(rows) from the question_answer table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countQuestionAnswersRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuestionAnswer::doCount($this->getQuestionAnswersRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the question_answer Objects(rows) from the question_answer table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuestionAnswersRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuestionAnswersRelatedBySessionId_c = array();
		return QuestionAnswer::doDelete($this->getQuestionAnswersRelatedBySessionIdQuery($q));
	}

	protected $QuestionAnswersRelatedBySessionId_c = array();

	/**
	 * Returns an array of QuestionAnswer objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuestionAnswer[]
	 */
	function getQuestionAnswersRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuestionAnswersRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuestionAnswersRelatedBySessionId_c;
		}

		$result = QuestionAnswer::doSelect($this->getQuestionAnswersRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuestionAnswersRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz Objects(rows) from the quiz table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getQuizsRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of Quiz Objects(rows) from the quiz table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countQuizsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Quiz::doCount($this->getQuizsRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the quiz Objects(rows) from the quiz table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizsRelatedBySessionId_c = array();
		return Quiz::doDelete($this->getQuizsRelatedBySessionIdQuery($q));
	}

	protected $QuizsRelatedBySessionId_c = array();

	/**
	 * Returns an array of Quiz objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Quiz[]
	 */
	function getQuizsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizsRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizsRelatedBySessionId_c;
		}

		$result = Quiz::doSelect($this->getQuizsRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizsRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz_session Objects(rows) from the quiz_session table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionsRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSession Objects(rows) from the quiz_session table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSession::doCount($this->getQuizSessionsRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the quiz_session Objects(rows) from the quiz_session table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionsRelatedBySessionId_c = array();
		return QuizSession::doDelete($this->getQuizSessionsRelatedBySessionIdQuery($q));
	}

	protected $QuizSessionsRelatedBySessionId_c = array();

	/**
	 * Returns an array of QuizSession objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSession[]
	 */
	function getQuizSessionsRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionsRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionsRelatedBySessionId_c;
		}

		$result = QuizSession::doSelect($this->getQuizSessionsRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionsRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting user Objects(rows) from the user table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getUsersRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of User Objects(rows) from the user table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countUsersRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return User::doCount($this->getUsersRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the user Objects(rows) from the user table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteUsersRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->UsersRelatedBySessionId_c = array();
		return User::doDelete($this->getUsersRelatedBySessionIdQuery($q));
	}

	protected $UsersRelatedBySessionId_c = array();

	/**
	 * Returns an array of User objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return User[]
	 */
	function getUsersRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->UsersRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->UsersRelatedBySessionId_c;
		}

		$result = User::doSelect($this->getUsersRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->UsersRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting user_role Objects(rows) from the user_role table
	 * with a session_id that matches $this->id.
	 * @return Query
	 */
	function getUserRolesRelatedBySessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user_role', 'session_id', 'id', $q);
	}

	/**
	 * Returns the count of UserRole Objects(rows) from the user_role table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function countUserRolesRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return UserRole::doCount($this->getUserRolesRelatedBySessionIdQuery($q));
	}

	/**
	 * Deletes the user_role Objects(rows) from the user_role table
	 * with a session_id that matches $this->id.
	 * @return int
	 */
	function deleteUserRolesRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->UserRolesRelatedBySessionId_c = array();
		return UserRole::doDelete($this->getUserRolesRelatedBySessionIdQuery($q));
	}

	protected $UserRolesRelatedBySessionId_c = array();

	/**
	 * Returns an array of UserRole objects with a session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return UserRole[]
	 */
	function getUserRolesRelatedBySessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->UserRolesRelatedBySessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->UserRolesRelatedBySessionId_c;
		}

		$result = UserRole::doSelect($this->getUserRolesRelatedBySessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->UserRolesRelatedBySessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for Session::getClassroomsRelatedBysession_id
	 * @return Classroom[]
	 * @see Session::getClassroomsRelatedBySessionId
	 */
	function getClassrooms($extra = null) {
		return $this->getClassroomsRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getClassroomsRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getClassroomsRelatedBysession_idQuery
	  */
	function getClassroomsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('classroom', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteClassroomsRelatedBysession_id
	  * @return int
	  * @see Session::deleteClassroomsRelatedBysession_id
	  */
	function deleteClassrooms(Query $q = null) {
		return $this->deleteClassroomsRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countClassroomsRelatedBysession_id
	  * @return int
	  * @see Session::countClassroomsRelatedBySessionId
	  */
	function countClassrooms(Query $q = null) {
		return $this->countClassroomsRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getDevicesRelatedBysession_id
	 * @return Device[]
	 * @see Session::getDevicesRelatedBySessionId
	 */
	function getDevices($extra = null) {
		return $this->getDevicesRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getDevicesRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getDevicesRelatedBysession_idQuery
	  */
	function getDevicesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('device', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteDevicesRelatedBysession_id
	  * @return int
	  * @see Session::deleteDevicesRelatedBysession_id
	  */
	function deleteDevices(Query $q = null) {
		return $this->deleteDevicesRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countDevicesRelatedBysession_id
	  * @return int
	  * @see Session::countDevicesRelatedBySessionId
	  */
	function countDevices(Query $q = null) {
		return $this->countDevicesRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getQuestionsRelatedBysession_id
	 * @return Question[]
	 * @see Session::getQuestionsRelatedBySessionId
	 */
	function getQuestions($extra = null) {
		return $this->getQuestionsRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getQuestionsRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getQuestionsRelatedBysession_idQuery
	  */
	function getQuestionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteQuestionsRelatedBysession_id
	  * @return int
	  * @see Session::deleteQuestionsRelatedBysession_id
	  */
	function deleteQuestions(Query $q = null) {
		return $this->deleteQuestionsRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countQuestionsRelatedBysession_id
	  * @return int
	  * @see Session::countQuestionsRelatedBySessionId
	  */
	function countQuestions(Query $q = null) {
		return $this->countQuestionsRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getQuestionAnswersRelatedBysession_id
	 * @return QuestionAnswer[]
	 * @see Session::getQuestionAnswersRelatedBySessionId
	 */
	function getQuestionAnswers($extra = null) {
		return $this->getQuestionAnswersRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getQuestionAnswersRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getQuestionAnswersRelatedBysession_idQuery
	  */
	function getQuestionAnswersQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question_answer', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteQuestionAnswersRelatedBysession_id
	  * @return int
	  * @see Session::deleteQuestionAnswersRelatedBysession_id
	  */
	function deleteQuestionAnswers(Query $q = null) {
		return $this->deleteQuestionAnswersRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countQuestionAnswersRelatedBysession_id
	  * @return int
	  * @see Session::countQuestionAnswersRelatedBySessionId
	  */
	function countQuestionAnswers(Query $q = null) {
		return $this->countQuestionAnswersRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getQuizsRelatedBysession_id
	 * @return Quiz[]
	 * @see Session::getQuizsRelatedBySessionId
	 */
	function getQuizs($extra = null) {
		return $this->getQuizsRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getQuizsRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getQuizsRelatedBysession_idQuery
	  */
	function getQuizsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteQuizsRelatedBysession_id
	  * @return int
	  * @see Session::deleteQuizsRelatedBysession_id
	  */
	function deleteQuizs(Query $q = null) {
		return $this->deleteQuizsRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countQuizsRelatedBysession_id
	  * @return int
	  * @see Session::countQuizsRelatedBySessionId
	  */
	function countQuizs(Query $q = null) {
		return $this->countQuizsRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getQuizSessionsRelatedBysession_id
	 * @return QuizSession[]
	 * @see Session::getQuizSessionsRelatedBySessionId
	 */
	function getQuizSessions($extra = null) {
		return $this->getQuizSessionsRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getQuizSessionsRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getQuizSessionsRelatedBysession_idQuery
	  */
	function getQuizSessionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteQuizSessionsRelatedBysession_id
	  * @return int
	  * @see Session::deleteQuizSessionsRelatedBysession_id
	  */
	function deleteQuizSessions(Query $q = null) {
		return $this->deleteQuizSessionsRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countQuizSessionsRelatedBysession_id
	  * @return int
	  * @see Session::countQuizSessionsRelatedBySessionId
	  */
	function countQuizSessions(Query $q = null) {
		return $this->countQuizSessionsRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getUsersRelatedBysession_id
	 * @return User[]
	 * @see Session::getUsersRelatedBySessionId
	 */
	function getUsers($extra = null) {
		return $this->getUsersRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getUsersRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getUsersRelatedBysession_idQuery
	  */
	function getUsersQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteUsersRelatedBysession_id
	  * @return int
	  * @see Session::deleteUsersRelatedBysession_id
	  */
	function deleteUsers(Query $q = null) {
		return $this->deleteUsersRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countUsersRelatedBysession_id
	  * @return int
	  * @see Session::countUsersRelatedBySessionId
	  */
	function countUsers(Query $q = null) {
		return $this->countUsersRelatedBySessionId($q);
	}

	/**
	 * Convenience function for Session::getUserRolesRelatedBysession_id
	 * @return UserRole[]
	 * @see Session::getUserRolesRelatedBySessionId
	 */
	function getUserRoles($extra = null) {
		return $this->getUserRolesRelatedBySessionId($extra);
	}

	/**
	  * Convenience function for Session::getUserRolesRelatedBysession_idQuery
	  * @return Query
	  * @see Session::getUserRolesRelatedBysession_idQuery
	  */
	function getUserRolesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user_role', 'session_id','id', $q);
	}

	/**
	  * Convenience function for Session::deleteUserRolesRelatedBysession_id
	  * @return int
	  * @see Session::deleteUserRolesRelatedBysession_id
	  */
	function deleteUserRoles(Query $q = null) {
		return $this->deleteUserRolesRelatedBySessionId($q);
	}

	/**
	  * Convenience function for Session::countUserRolesRelatedBysession_id
	  * @return int
	  * @see Session::countUserRolesRelatedBySessionId
	  */
	function countUserRoles(Query $q = null) {
		return $this->countUserRolesRelatedBySessionId($q);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		return 0 === count($this->_validationErrors);
	}

}