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
	const QUIZ_SESSION_ID = 'quiz_session_attempt.quiz_session_id';
	const QUIZ_SESSION_QUESTION_ID = 'quiz_session_attempt.quiz_session_question_id';
	const QUIZ_SESSION_DEVICE_ID = 'quiz_session_attempt.quiz_session_device_id';
	const ANSWER_CHOICE = 'quiz_session_attempt.answer_choice';
	const ANSWER_TEXT = 'quiz_session_attempt.answer_text';
	const CORRECT = 'quiz_session_attempt.correct';
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
		QuizSessionAttempt::QUIZ_SESSION_ID,
		QuizSessionAttempt::QUIZ_SESSION_QUESTION_ID,
		QuizSessionAttempt::QUIZ_SESSION_DEVICE_ID,
		QuizSessionAttempt::ANSWER_CHOICE,
		QuizSessionAttempt::ANSWER_TEXT,
		QuizSessionAttempt::CORRECT,
		QuizSessionAttempt::CREATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'quiz_session_id',
		'quiz_session_question_id',
		'quiz_session_device_id',
		'answer_choice',
		'answer_text',
		'correct',
		'created',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_session_id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_session_question_id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_session_device_id' => Model::COLUMN_TYPE_INTEGER,
		'answer_choice' => Model::COLUMN_TYPE_INTEGER,
		'answer_text' => Model::COLUMN_TYPE_VARCHAR,
		'correct' => Model::COLUMN_TYPE_TINYINT,
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
	 * `quiz_session_question_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $quiz_session_question_id;

	/**
	 * `quiz_session_device_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $quiz_session_device_id;

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
	 * `correct` TINYINT NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $correct;

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
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt
	 */
	function setQuizSessionId($value) {
		return $this->setColumnValue('quiz_session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getQuizSessionId
	 * final because getQuizSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getQuizSessionId
	 */
	final function getQuiz_session_id() {
		return $this->getQuizSessionId();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setQuizSessionId
	 * final because setQuizSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setQuizSessionId
	 * @return QuizSessionAttempt
	 */
	final function setQuiz_session_id($value) {
		return $this->setQuizSessionId($value);
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
	 * Gets the value of the quiz_session_device_id field
	 */
	function getQuizSessionDeviceId() {
		return $this->quiz_session_device_id;
	}

	/**
	 * Sets the value of the quiz_session_device_id field
	 * @return QuizSessionAttempt
	 */
	function setQuizSessionDeviceId($value) {
		return $this->setColumnValue('quiz_session_device_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionAttempt::getQuizSessionDeviceId
	 * final because getQuizSessionDeviceId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::getQuizSessionDeviceId
	 */
	final function getQuiz_session_device_id() {
		return $this->getQuizSessionDeviceId();
	}

	/**
	 * Convenience function for QuizSessionAttempt::setQuizSessionDeviceId
	 * final because setQuizSessionDeviceId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionAttempt::setQuizSessionDeviceId
	 * @return QuizSessionAttempt
	 */
	final function setQuiz_session_device_id($value) {
		return $this->setQuizSessionDeviceId($value);
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
	 * Gets the value of the correct field
	 */
	function getCorrect() {
		return $this->correct;
	}

	/**
	 * Sets the value of the correct field
	 * @return QuizSessionAttempt
	 */
	function setCorrect($value) {
		return $this->setColumnValue('correct', $value, Model::COLUMN_TYPE_TINYINT);
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
	 * Searches the database for a row with a quiz_session_id
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByQuizSessionId($value) {
		return static::retrieveByColumn('quiz_session_id', $value);
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
	 * Searches the database for a row with a quiz_session_device_id
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByQuizSessionDeviceId($value) {
		return static::retrieveByColumn('quiz_session_device_id', $value);
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
	 * Searches the database for a row with a correct
	 * value that matches the one provided
	 * @return QuizSessionAttempt
	 */
	static function retrieveByCorrect($value) {
		return static::retrieveByColumn('correct', $value);
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
		$this->quiz_session_id = (null === $this->quiz_session_id) ? null : (int) $this->quiz_session_id;
		$this->quiz_session_question_id = (null === $this->quiz_session_question_id) ? null : (int) $this->quiz_session_question_id;
		$this->quiz_session_device_id = (null === $this->quiz_session_device_id) ? null : (int) $this->quiz_session_device_id;
		$this->answer_choice = (null === $this->answer_choice) ? null : (int) $this->answer_choice;
		$this->correct = (null === $this->correct) ? null : (int) $this->correct;
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
	function setQuizSessionDevice(QuizSessionDevice $quizsessiondevice = null) {
		return $this->setQuizSessionDeviceRelatedByQuizSessionDeviceId($quizsessiondevice);
	}

	/**
	 * @return QuizSessionAttempt
	 */
	function setQuizSessionDeviceRelatedByQuizSessionDeviceId(QuizSessionDevice $quizsessiondevice = null) {
		if (null === $quizsessiondevice) {
			$this->setquiz_session_device_id(null);
		} else {
			if (!$quizsessiondevice->getid()) {
				throw new Exception('Cannot connect a QuizSessionDevice without a id');
			}
			$this->setquiz_session_device_id($quizsessiondevice->getid());
		}
		return $this;
	}

	/**
	 * Returns a quiz_session_device object with a id
	 * that matches $this->quiz_session_device_id.
	 * @return QuizSessionDevice
	 */
	function getQuizSessionDevice() {
		return $this->getQuizSessionDeviceRelatedByQuizSessionDeviceId();
	}

	/**
	 * Returns a quiz_session_device object with a id
	 * that matches $this->quiz_session_device_id.
	 * @return QuizSessionDevice
	 */
	function getQuizSessionDeviceRelatedByQuizSessionDeviceId() {
		$fk_value = $this->getquiz_session_device_id();
		if (null === $fk_value) {
			return null;
		}
		return QuizSessionDevice::retrieveByPK($fk_value);
	}

	static function doSelectJoinQuizSessionDevice(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinQuizSessionDeviceRelatedByQuizSessionDeviceId($q, $join_type);
	}

	/**
	 * @return QuizSessionAttempt[]
	 */
	static function doSelectJoinQuizSessionDeviceRelatedByQuizSessionDeviceId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = QuizSessionDevice::getTableName();
		$q->join($to_table, $this_table . '.quiz_session_device_id = ' . $to_table . '.id', $join_type);
		foreach (QuizSessionDevice::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('QuizSessionDevice'));
	}

	/**
	 * @return QuizSessionAttempt
	 */
	function setQuizSession(QuizSession $quizsession = null) {
		return $this->setQuizSessionRelatedByQuizSessionId($quizsession);
	}

	/**
	 * @return QuizSessionAttempt
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
	 * @return QuizSessionAttempt[]
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
	
		$to_table = QuizSessionDevice::getTableName();
		$q->join($to_table, $this_table . '.quiz_session_device_id = ' . $to_table . '.id', $join_type);
		foreach (QuizSessionDevice::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'QuizSessionDevice';
	
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
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getquiz_session_id()) {
			$this->_validationErrors[] = 'quiz_session_id must not be null';
		}
		if (null === $this->getquiz_session_question_id()) {
			$this->_validationErrors[] = 'quiz_session_question_id must not be null';
		}
		if (null === $this->getquiz_session_device_id()) {
			$this->_validationErrors[] = 'quiz_session_device_id must not be null';
		}
		if (null === $this->getanswer_choice()) {
			$this->_validationErrors[] = 'answer_choice must not be null';
		}
		if (null === $this->getanswer_text()) {
			$this->_validationErrors[] = 'answer_text must not be null';
		}
		if (null === $this->getcorrect()) {
			$this->_validationErrors[] = 'correct must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}