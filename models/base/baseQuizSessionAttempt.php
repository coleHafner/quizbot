<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuizSessionAttempt extends ApplicationModel {

	const ID = 'quiz_session_attempt.id';
	const QUIZ_SESSION_QUESTION_ID = 'quiz_session_attempt.quiz_session_question_id';
	const DEVICE_ID = 'quiz_session_attempt.device_id';
	const USER_ID = 'quiz_session_attempt.user_id';
	const ANSWER_CHOICE = 'quiz_session_attempt.answer_choice';
	const ANSWER_TEXT = 'quiz_session_attempt.answer_text';
	const CREATED = 'quiz_session_attempt.created';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'quiz_session_attempt';

	/**
	 * Cache of objects retrieved from the database
	 * @var QuizSessionAttempt[]
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
		QuizSessionAttempt::ID,
		QuizSessionAttempt::QUIZ_SESSION_QUESTION_ID,
		QuizSessionAttempt::DEVICE_ID,
		QuizSessionAttempt::USER_ID,
		QuizSessionAttempt::ANSWER_CHOICE,
		QuizSessionAttempt::ANSWER_TEXT,
		QuizSessionAttempt::CREATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'quiz_session_question_id',
		'device_id',
		'user_id',
		'answer_choice',
		'answer_text',
		'created',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_session_question_id' => Model::COLUMN_TYPE_INTEGER,
		'device_id' => Model::COLUMN_TYPE_INTEGER,
		'user_id' => Model::COLUMN_TYPE_INTEGER,
		'answer_choice' => Model::COLUMN_TYPE_INTEGER,
		'answer_text' => Model::COLUMN_TYPE_VARCHAR,
		'created' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `quiz_session_question_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $quiz_session_question_id;

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
	 * `answer_choice` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $answer_choice;

	/**
	 * `answer_text` VARCHAR NOT NULL
	 * @var string
	 */
	protected $answer_text;

	/**
	 * `created` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
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
	 * @return QuizSessionAttempt
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the quiz_session_question_id field
	 */
	function getQuizSessionQuestionId() {
		return $this->quiz_session_question_id;
	}

	/**
	 * Sets the value of the quiz_session_question_id field
	 * @return QuizSessionAttempt
	 */
	function setQuizSessionQuestionId($value) {
		return $this->setColumnValue('quiz_session_question_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getQuizSessionQuestionId
	 * final because getQuizSessionQuestionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getQuizSessionQuestionId
	 */
	final function getQuiz_session_question_id() {
		return $this->getQuizSessionQuestionId();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setQuizSessionQuestionId
	 * final because setQuizSessionQuestionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setQuizSessionQuestionId
	 * @return QuizSessionAttempt
	 */
	final function setQuiz_session_question_id($value) {
		return $this->setQuizSessionQuestionId($value);
	}

	/**
	 * Gets the value of the device_id field
	 */
	function getDeviceId() {
		return $this->device_id;
	}

	/**
	 * Sets the value of the device_id field
	 * @return QuizSessionAttempt
	 */
	function setDeviceId($value) {
		return $this->setColumnValue('device_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getDeviceId
	 * final because getDeviceId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getDeviceId
	 */
	final function getDevice_id() {
		return $this->getDeviceId();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setDeviceId
	 * final because setDeviceId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setDeviceId
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt
	 */
	function setUserId($value) {
		return $this->setColumnValue('user_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getUserId
	 * final because getUserId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getUserId
	 */
	final function getUser_id() {
		return $this->getUserId();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setUserId
	 * final because setUserId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setUserId
	 * @return QuizSessionAttempt
	 */
	final function setUser_id($value) {
		return $this->setUserId($value);
	}

	/**
	 * Gets the value of the answer_choice field
	 */
	function getAnswerChoice() {
		return $this->answer_choice;
	}

	/**
	 * Sets the value of the answer_choice field
	 * @return QuizSessionAttempt
	 */
	function setAnswerChoice($value) {
		return $this->setColumnValue('answer_choice', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getAnswerChoice
	 * final because getAnswerChoice should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getAnswerChoice
	 */
	final function getAnswer_choice() {
		return $this->getAnswerChoice();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setAnswerChoice
	 * final because setAnswerChoice should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setAnswerChoice
	 * @return QuizSessionAttempt
	 */
	final function setAnswer_choice($value) {
		return $this->setAnswerChoice($value);
	}

	/**
	 * Gets the value of the answer_text field
	 */
	function getAnswerText() {
		return $this->answer_text;
	}

	/**
	 * Sets the value of the answer_text field
	 * @return QuizSessionAttempt
	 */
	function setAnswerText($value) {
		return $this->setColumnValue('answer_text', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getAnswerText
	 * final because getAnswerText should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getAnswerText
	 */
	final function getAnswer_text() {
		return $this->getAnswerText();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setAnswerText
	 * final because setAnswerText should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setAnswerText
	 * @return QuizSessionAttempt
	 */
	final function setAnswer_text($value) {
		return $this->setAnswerText($value);
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
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt
	 */
	static function retrieveById($value) {
		return QuizSessionAttempt::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a quiz_session_question_id
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByQuizSessionQuestionId($value) {
		return static::retrieveByColumn('quiz_session_question_id', $value);
	}

	/**
	 * Searches the database for a row with a device_id
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByDeviceId($value) {
		return static::retrieveByColumn('device_id', $value);
	}

	/**
	 * Searches the database for a row with a user_id
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByUserId($value) {
		return static::retrieveByColumn('user_id', $value);
	}

	/**
	 * Searches the database for a row with a answer_choice
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByAnswerChoice($value) {
		return static::retrieveByColumn('answer_choice', $value);
	}

	/**
	 * Searches the database for a row with a answer_text
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByAnswerText($value) {
		return static::retrieveByColumn('answer_text', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return QuizSessionAttempt
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->quiz_session_question_id = (null === $this->quiz_session_question_id) ? null : (int) $this->quiz_session_question_id;
		$this->device_id = (null === $this->device_id) ? null : (int) $this->device_id;
		$this->user_id = (null === $this->user_id) ? null : (int) $this->user_id;
		$this->answer_choice = (null === $this->answer_choice) ? null : (int) $this->answer_choice;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		return $this;
	}

	/**
	 * @return QuizSessionAttempt
	 */
	function setQuizSessionQuestion(QuizSessionQuestion $quizsessionquestion = null) {
		return $this->setQuizSessionQuestionRelatedByQuizSessionQuestionId($quizsessionquestion);
	}

	/**
	 * @return QuizSessionAttempt
	 */
	function setQuizSessionQuestionRelatedByQuizSessionQuestionId(QuizSessionQuestion $quizsessionquestion = null) {
		if (null === $quizsessionquestion) {
			$this->setquiz_session_question_id(null);
		} else {
			if (!$quizsessionquestion->getid()) {
				throw new Exception('Cannot connect a QuizSessionQuestion without a id');
			}
			$this->setquiz_session_question_id($quizsessionquestion->getid());
		}
		return $this;
	}

	/**
	 * Returns a quiz_session_question object with a id
	 * that matches $this->quiz_session_question_id.
	 * @return QuizSessionQuestion
	 */
	function getQuizSessionQuestion() {
		return $this->getQuizSessionQuestionRelatedByQuizSessionQuestionId();
	}

	/**
	 * Returns a quiz_session_question object with a id
	 * that matches $this->quiz_session_question_id.
	 * @return QuizSessionQuestion
	 */
	function getQuizSessionQuestionRelatedByQuizSessionQuestionId() {
		$fk_value = $this->getquiz_session_question_id();
		if (null === $fk_value) {
			return null;
		}
		return QuizSessionQuestion::retrieveByPK($fk_value);
	}

	static function doSelectJoinQuizSessionQuestion(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinQuizSessionQuestionRelatedByQuizSessionQuestionId($q, $join_type);
	}

	/**
	 * @return QuizSessionAttempt[]
	 */
	static function doSelectJoinQuizSessionQuestionRelatedByQuizSessionQuestionId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = QuizSessionQuestion::getTableName();
		$q->join($to_table, $this_table . '.quiz_session_question_id = ' . $to_table . '.id', $join_type);
		foreach (QuizSessionQuestion::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('QuizSessionQuestion'));
	}

	/**
	 * @return QuizSessionAttempt
	 */
	function setDevice(Device $device = null) {
		return $this->setDeviceRelatedByDeviceId($device);
	}

	/**
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt[]
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
	 * @return QuizSessionAttempt
	 */
	function setUser(User $user = null) {
		return $this->setUserRelatedByUserId($user);
	}

	/**
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt[]
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
	 * @return QuizSessionAttempt[]
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

		$to_table = QuizSessionQuestion::getTableName();
		$q->join($to_table, $this_table . '.quiz_session_question_id = ' . $to_table . '.id', $join_type);
		foreach (QuizSessionQuestion::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'QuizSessionQuestion';
	
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
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getquiz_session_question_id()) {
			$this->_validationErrors[] = 'quiz_session_question_id must not be null';
		}
		if (null === $this->getdevice_id()) {
			$this->_validationErrors[] = 'device_id must not be null';
		}
		if (null === $this->getuser_id()) {
			$this->_validationErrors[] = 'user_id must not be null';
		}
		if (null === $this->getanswer_choice()) {
			$this->_validationErrors[] = 'answer_choice must not be null';
		}
		if (null === $this->getanswer_text()) {
			$this->_validationErrors[] = 'answer_text must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}