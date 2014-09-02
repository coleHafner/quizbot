<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuizSessionQuestion extends ApplicationModel {

	const ID = 'quiz_session_question.id';
	const QUIZ_SESSION_ID = 'quiz_session_question.quiz_session_id';
	const QUESTION_ID = 'quiz_session_question.question_id';
	const OPENED = 'quiz_session_question.opened';
	const CLOSED = 'quiz_session_question.closed';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'quiz_session_question';

	/**
	 * Cache of objects retrieved from the database
	 * @var QuizSessionQuestion[]
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
		QuizSessionQuestion::ID,
		QuizSessionQuestion::QUIZ_SESSION_ID,
		QuizSessionQuestion::QUESTION_ID,
		QuizSessionQuestion::OPENED,
		QuizSessionQuestion::CLOSED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'quiz_session_id',
		'question_id',
		'opened',
		'closed',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_session_id' => Model::COLUMN_TYPE_INTEGER,
		'question_id' => Model::COLUMN_TYPE_INTEGER,
		'opened' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'closed' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
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
	 * `question_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $question_id;

	/**
	 * `opened` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $opened;

	/**
	 * `closed` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $closed;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return QuizSessionQuestion
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
	 * @return QuizSessionQuestion
	 */
	function setQuizSessionId($value) {
		return $this->setColumnValue('quiz_session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionQuestion::getQuizSessionId
	 * final because getQuizSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionQuestion::getQuizSessionId
	 */
	final function getQuiz_session_id() {
		return $this->getQuizSessionId();
	}

	/**
	 * Convenience function for QuizSessionQuestion::setQuizSessionId
	 * final because setQuizSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionQuestion::setQuizSessionId
	 * @return QuizSessionQuestion
	 */
	final function setQuiz_session_id($value) {
		return $this->setQuizSessionId($value);
	}

	/**
	 * Gets the value of the question_id field
	 */
	function getQuestionId() {
		return $this->question_id;
	}

	/**
	 * Sets the value of the question_id field
	 * @return QuizSessionQuestion
	 */
	function setQuestionId($value) {
		return $this->setColumnValue('question_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSessionQuestion::getQuestionId
	 * final because getQuestionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionQuestion::getQuestionId
	 */
	final function getQuestion_id() {
		return $this->getQuestionId();
	}

	/**
	 * Convenience function for QuizSessionQuestion::setQuestionId
	 * final because setQuestionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSessionQuestion::setQuestionId
	 * @return QuizSessionQuestion
	 */
	final function setQuestion_id($value) {
		return $this->setQuestionId($value);
	}

	/**
	 * Gets the value of the opened field
	 */
	function getOpened($format = 'Y-m-d H:i:s') {
		if (null === $this->opened || null === $format) {
			return $this->opened;
		}
		return date($format, $this->opened);
	}

	/**
	 * Sets the value of the opened field
	 * @return QuizSessionQuestion
	 */
	function setOpened($value) {
		return $this->setColumnValue('opened', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the closed field
	 */
	function getClosed($format = 'Y-m-d H:i:s') {
		if (null === $this->closed || null === $format) {
			return $this->closed;
		}
		return date($format, $this->closed);
	}

	/**
	 * Sets the value of the closed field
	 * @return QuizSessionQuestion
	 */
	function setClosed($value) {
		return $this->setColumnValue('closed', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
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
	 * @return QuizSessionQuestion
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return QuizSessionQuestion
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
	 * @return QuizSessionQuestion
	 */
	static function retrieveById($value) {
		return QuizSessionQuestion::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a quiz_session_id
	 * value that matches the one provided
	 * @return QuizSessionQuestion
	 */
	static function retrieveByQuizSessionId($value) {
		return static::retrieveByColumn('quiz_session_id', $value);
	}

	/**
	 * Searches the database for a row with a question_id
	 * value that matches the one provided
	 * @return QuizSessionQuestion
	 */
	static function retrieveByQuestionId($value) {
		return static::retrieveByColumn('question_id', $value);
	}

	/**
	 * Searches the database for a row with a opened
	 * value that matches the one provided
	 * @return QuizSessionQuestion
	 */
	static function retrieveByOpened($value) {
		return static::retrieveByColumn('opened', $value);
	}

	/**
	 * Searches the database for a row with a closed
	 * value that matches the one provided
	 * @return QuizSessionQuestion
	 */
	static function retrieveByClosed($value) {
		return static::retrieveByColumn('closed', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return QuizSessionQuestion
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->quiz_session_id = (null === $this->quiz_session_id) ? null : (int) $this->quiz_session_id;
		$this->question_id = (null === $this->question_id) ? null : (int) $this->question_id;
		$this->opened = (null === $this->opened) ? null : (int) $this->opened;
		$this->closed = (null === $this->closed) ? null : (int) $this->closed;
		return $this;
	}

	/**
	 * @return QuizSessionQuestion
	 */
	function setQuestion(Question $question = null) {
		return $this->setQuestionRelatedByQuestionId($question);
	}

	/**
	 * @return QuizSessionQuestion
	 */
	function setQuestionRelatedByQuestionId(Question $question = null) {
		if (null === $question) {
			$this->setquestion_id(null);
		} else {
			if (!$question->getid()) {
				throw new Exception('Cannot connect a Question without a id');
			}
			$this->setquestion_id($question->getid());
		}
		return $this;
	}

	/**
	 * Returns a question object with a id
	 * that matches $this->question_id.
	 * @return Question
	 */
	function getQuestion() {
		return $this->getQuestionRelatedByQuestionId();
	}

	/**
	 * Returns a question object with a id
	 * that matches $this->question_id.
	 * @return Question
	 */
	function getQuestionRelatedByQuestionId() {
		$fk_value = $this->getquestion_id();
		if (null === $fk_value) {
			return null;
		}
		return Question::retrieveByPK($fk_value);
	}

	static function doSelectJoinQuestion(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinQuestionRelatedByQuestionId($q, $join_type);
	}

	/**
	 * @return QuizSessionQuestion[]
	 */
	static function doSelectJoinQuestionRelatedByQuestionId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = Question::getTableName();
		$q->join($to_table, $this_table . '.question_id = ' . $to_table . '.id', $join_type);
		foreach (Question::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('Question'));
	}

	/**
	 * @return QuizSessionQuestion
	 */
	function setQuizSession(QuizSession $quizsession = null) {
		return $this->setQuizSessionRelatedByQuizSessionId($quizsession);
	}

	/**
	 * @return QuizSessionQuestion
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
	 * @return QuizSessionQuestion[]
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
	 * @return QuizSessionQuestion[]
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

		$to_table = Question::getTableName();
		$q->join($to_table, $this_table . '.question_id = ' . $to_table . '.id', $join_type);
		foreach (Question::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Question';
	
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
	 * with a quiz_session_question_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionAttemptsRelatedByQuizSessionQuestionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'quiz_session_question_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionAttempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_question_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionAttemptsRelatedByQuizSessionQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionAttempt::doCount($this->getQuizSessionAttemptsRelatedByQuizSessionQuestionIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_attempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_question_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionAttemptsRelatedByQuizSessionQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionAttemptsRelatedByQuizSessionQuestionId_c = array();
		return QuizSessionAttempt::doDelete($this->getQuizSessionAttemptsRelatedByQuizSessionQuestionIdQuery($q));
	}

	protected $QuizSessionAttemptsRelatedByQuizSessionQuestionId_c = array();

	/**
	 * Returns an array of QuizSessionAttempt objects with a quiz_session_question_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionAttempt[]
	 */
	function getQuizSessionAttemptsRelatedByQuizSessionQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionAttemptsRelatedByQuizSessionQuestionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionAttemptsRelatedByQuizSessionQuestionId_c;
		}

		$result = QuizSessionAttempt::doSelect($this->getQuizSessionAttemptsRelatedByQuizSessionQuestionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionAttemptsRelatedByQuizSessionQuestionId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for QuizSessionQuestion::getQuizSessionAttemptsRelatedByquiz_session_question_id
	 * @return QuizSessionAttempt[]
	 * @see QuizSessionQuestion::getQuizSessionAttemptsRelatedByQuizSessionQuestionId
	 */
	function getQuizSessionAttempts($extra = null) {
		return $this->getQuizSessionAttemptsRelatedByQuizSessionQuestionId($extra);
	}

	/**
	  * Convenience function for QuizSessionQuestion::getQuizSessionAttemptsRelatedByquiz_session_question_idQuery
	  * @return Query
	  * @see QuizSessionQuestion::getQuizSessionAttemptsRelatedByquiz_session_question_idQuery
	  */
	function getQuizSessionAttemptsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'quiz_session_question_id','id', $q);
	}

	/**
	  * Convenience function for QuizSessionQuestion::deleteQuizSessionAttemptsRelatedByquiz_session_question_id
	  * @return int
	  * @see QuizSessionQuestion::deleteQuizSessionAttemptsRelatedByquiz_session_question_id
	  */
	function deleteQuizSessionAttempts(Query $q = null) {
		return $this->deleteQuizSessionAttemptsRelatedByQuizSessionQuestionId($q);
	}

	/**
	  * Convenience function for QuizSessionQuestion::countQuizSessionAttemptsRelatedByquiz_session_question_id
	  * @return int
	  * @see QuizSessionQuestion::countQuizSessionAttemptsRelatedByQuizSessionQuestionId
	  */
	function countQuizSessionAttempts(Query $q = null) {
		return $this->countQuizSessionAttemptsRelatedByQuizSessionQuestionId($q);
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
		if (null === $this->getquestion_id()) {
			$this->_validationErrors[] = 'question_id must not be null';
		}
		if (null === $this->getopened()) {
			$this->_validationErrors[] = 'opened must not be null';
		}
		if (null === $this->getclosed()) {
			$this->_validationErrors[] = 'closed must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}