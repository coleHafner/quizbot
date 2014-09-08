<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuizSession extends ApplicationModel {

	const ID = 'quiz_session.id';
	const SESSION_ID = 'quiz_session.session_id';
	const QUIZ_ID = 'quiz_session.quiz_id';
	const OPENED = 'quiz_session.opened';
	const CLOSED = 'quiz_session.closed';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'quiz_session';

	/**
	 * Cache of objects retrieved from the database
	 * @var QuizSession[]
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
		QuizSession::ID,
		QuizSession::SESSION_ID,
		QuizSession::QUIZ_ID,
		QuizSession::OPENED,
		QuizSession::CLOSED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'session_id',
		'quiz_id',
		'opened',
		'closed',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_id' => Model::COLUMN_TYPE_INTEGER,
		'opened' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'closed' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
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
	 * `quiz_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $quiz_id;

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
	 * @return QuizSession
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
	 * @return QuizSession
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSession::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSession::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for QuizSession::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSession::setSessionId
	 * @return QuizSession
	 */
	final function setSession_id($value) {
		return $this->setSessionId($value);
	}

	/**
	 * Gets the value of the quiz_id field
	 */
	function getQuizId() {
		return $this->quiz_id;
	}

	/**
	 * Sets the value of the quiz_id field
	 * @return QuizSession
	 */
	function setQuizId($value) {
		return $this->setColumnValue('quiz_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuizSession::getQuizId
	 * final because getQuizId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSession::getQuizId
	 */
	final function getQuiz_id() {
		return $this->getQuizId();
	}

	/**
	 * Convenience function for QuizSession::setQuizId
	 * final because setQuizId should be extended instead
	 * to ensure consistent behavior
	 * @see QuizSession::setQuizId
	 * @return QuizSession
	 */
	final function setQuiz_id($value) {
		return $this->setQuizId($value);
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
	 * @return QuizSession
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
	 * @return QuizSession
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
	 * @return QuizSession
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return QuizSession
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
	 * @return QuizSession
	 */
	static function retrieveById($value) {
		return QuizSession::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return QuizSession
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a quiz_id
	 * value that matches the one provided
	 * @return QuizSession
	 */
	static function retrieveByQuizId($value) {
		return static::retrieveByColumn('quiz_id', $value);
	}

	/**
	 * Searches the database for a row with a opened
	 * value that matches the one provided
	 * @return QuizSession
	 */
	static function retrieveByOpened($value) {
		return static::retrieveByColumn('opened', $value);
	}

	/**
	 * Searches the database for a row with a closed
	 * value that matches the one provided
	 * @return QuizSession
	 */
	static function retrieveByClosed($value) {
		return static::retrieveByColumn('closed', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return QuizSession
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->quiz_id = (null === $this->quiz_id) ? null : (int) $this->quiz_id;
		$this->opened = (null === $this->opened) ? null : (int) $this->opened;
		$this->closed = (null === $this->closed) ? null : (int) $this->closed;
		return $this;
	}

	/**
	 * @return QuizSession
	 */
	function setQuiz(Quiz $quiz = null) {
		return $this->setQuizRelatedByQuizId($quiz);
	}

	/**
	 * @return QuizSession
	 */
	function setQuizRelatedByQuizId(Quiz $quiz = null) {
		if (null === $quiz) {
			$this->setquiz_id(null);
		} else {
			if (!$quiz->getid()) {
				throw new Exception('Cannot connect a Quiz without a id');
			}
			$this->setquiz_id($quiz->getid());
		}
		return $this;
	}

	/**
	 * Returns a quiz object with a id
	 * that matches $this->quiz_id.
	 * @return Quiz
	 */
	function getQuiz() {
		return $this->getQuizRelatedByQuizId();
	}

	/**
	 * Returns a quiz object with a id
	 * that matches $this->quiz_id.
	 * @return Quiz
	 */
	function getQuizRelatedByQuizId() {
		$fk_value = $this->getquiz_id();
		if (null === $fk_value) {
			return null;
		}
		return Quiz::retrieveByPK($fk_value);
	}

	static function doSelectJoinQuiz(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinQuizRelatedByQuizId($q, $join_type);
	}

	/**
	 * @return QuizSession[]
	 */
	static function doSelectJoinQuizRelatedByQuizId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = Quiz::getTableName();
		$q->join($to_table, $this_table . '.quiz_id = ' . $to_table . '.id', $join_type);
		foreach (Quiz::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('Quiz'));
	}

	/**
	 * @return QuizSession
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return QuizSession
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
	 * @return QuizSession[]
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
	 * @return QuizSession[]
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

		$to_table = Quiz::getTableName();
		$q->join($to_table, $this_table . '.quiz_id = ' . $to_table . '.id', $join_type);
		foreach (Quiz::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Quiz';
	
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
	 * with a quiz_session_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionAttemptsRelatedByQuizSessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'quiz_session_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionAttempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionAttemptsRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionAttempt::doCount($this->getQuizSessionAttemptsRelatedByQuizSessionIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_attempt Objects(rows) from the quiz_session_attempt table
	 * with a quiz_session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionAttemptsRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionAttemptsRelatedByQuizSessionId_c = array();
		return QuizSessionAttempt::doDelete($this->getQuizSessionAttemptsRelatedByQuizSessionIdQuery($q));
	}

	protected $QuizSessionAttemptsRelatedByQuizSessionId_c = array();

	/**
	 * Returns an array of QuizSessionAttempt objects with a quiz_session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionAttempt[]
	 */
	function getQuizSessionAttemptsRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionAttemptsRelatedByQuizSessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionAttemptsRelatedByQuizSessionId_c;
		}

		$result = QuizSessionAttempt::doSelect($this->getQuizSessionAttemptsRelatedByQuizSessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionAttemptsRelatedByQuizSessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz_session_device Objects(rows) from the quiz_session_device table
	 * with a quiz_session_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionDevicesRelatedByQuizSessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_device', 'quiz_session_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionDevice Objects(rows) from the quiz_session_device table
	 * with a quiz_session_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionDevicesRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionDevice::doCount($this->getQuizSessionDevicesRelatedByQuizSessionIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_device Objects(rows) from the quiz_session_device table
	 * with a quiz_session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionDevicesRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionDevicesRelatedByQuizSessionId_c = array();
		return QuizSessionDevice::doDelete($this->getQuizSessionDevicesRelatedByQuizSessionIdQuery($q));
	}

	protected $QuizSessionDevicesRelatedByQuizSessionId_c = array();

	/**
	 * Returns an array of QuizSessionDevice objects with a quiz_session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionDevice[]
	 */
	function getQuizSessionDevicesRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionDevicesRelatedByQuizSessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionDevicesRelatedByQuizSessionId_c;
		}

		$result = QuizSessionDevice::doSelect($this->getQuizSessionDevicesRelatedByQuizSessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionDevicesRelatedByQuizSessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz_session_question Objects(rows) from the quiz_session_question table
	 * with a quiz_session_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionQuestionsRelatedByQuizSessionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_question', 'quiz_session_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionQuestion Objects(rows) from the quiz_session_question table
	 * with a quiz_session_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionQuestionsRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionQuestion::doCount($this->getQuizSessionQuestionsRelatedByQuizSessionIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_question Objects(rows) from the quiz_session_question table
	 * with a quiz_session_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionQuestionsRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionQuestionsRelatedByQuizSessionId_c = array();
		return QuizSessionQuestion::doDelete($this->getQuizSessionQuestionsRelatedByQuizSessionIdQuery($q));
	}

	protected $QuizSessionQuestionsRelatedByQuizSessionId_c = array();

	/**
	 * Returns an array of QuizSessionQuestion objects with a quiz_session_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionQuestion[]
	 */
	function getQuizSessionQuestionsRelatedByQuizSessionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionQuestionsRelatedByQuizSessionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionQuestionsRelatedByQuizSessionId_c;
		}

		$result = QuizSessionQuestion::doSelect($this->getQuizSessionQuestionsRelatedByQuizSessionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionQuestionsRelatedByQuizSessionId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for QuizSession::getQuizSessionAttemptsRelatedByquiz_session_id
	 * @return QuizSessionAttempt[]
	 * @see QuizSession::getQuizSessionAttemptsRelatedByQuizSessionId
	 */
	function getQuizSessionAttempts($extra = null) {
		return $this->getQuizSessionAttemptsRelatedByQuizSessionId($extra);
	}

	/**
	  * Convenience function for QuizSession::getQuizSessionAttemptsRelatedByquiz_session_idQuery
	  * @return Query
	  * @see QuizSession::getQuizSessionAttemptsRelatedByquiz_session_idQuery
	  */
	function getQuizSessionAttemptsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_attempt', 'quiz_session_id','id', $q);
	}

	/**
	  * Convenience function for QuizSession::deleteQuizSessionAttemptsRelatedByquiz_session_id
	  * @return int
	  * @see QuizSession::deleteQuizSessionAttemptsRelatedByquiz_session_id
	  */
	function deleteQuizSessionAttempts(Query $q = null) {
		return $this->deleteQuizSessionAttemptsRelatedByQuizSessionId($q);
	}

	/**
	  * Convenience function for QuizSession::countQuizSessionAttemptsRelatedByquiz_session_id
	  * @return int
	  * @see QuizSession::countQuizSessionAttemptsRelatedByQuizSessionId
	  */
	function countQuizSessionAttempts(Query $q = null) {
		return $this->countQuizSessionAttemptsRelatedByQuizSessionId($q);
	}

	/**
	 * Convenience function for QuizSession::getQuizSessionDevicesRelatedByquiz_session_id
	 * @return QuizSessionDevice[]
	 * @see QuizSession::getQuizSessionDevicesRelatedByQuizSessionId
	 */
	function getQuizSessionDevices($extra = null) {
		return $this->getQuizSessionDevicesRelatedByQuizSessionId($extra);
	}

	/**
	  * Convenience function for QuizSession::getQuizSessionDevicesRelatedByquiz_session_idQuery
	  * @return Query
	  * @see QuizSession::getQuizSessionDevicesRelatedByquiz_session_idQuery
	  */
	function getQuizSessionDevicesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_device', 'quiz_session_id','id', $q);
	}

	/**
	  * Convenience function for QuizSession::deleteQuizSessionDevicesRelatedByquiz_session_id
	  * @return int
	  * @see QuizSession::deleteQuizSessionDevicesRelatedByquiz_session_id
	  */
	function deleteQuizSessionDevices(Query $q = null) {
		return $this->deleteQuizSessionDevicesRelatedByQuizSessionId($q);
	}

	/**
	  * Convenience function for QuizSession::countQuizSessionDevicesRelatedByquiz_session_id
	  * @return int
	  * @see QuizSession::countQuizSessionDevicesRelatedByQuizSessionId
	  */
	function countQuizSessionDevices(Query $q = null) {
		return $this->countQuizSessionDevicesRelatedByQuizSessionId($q);
	}

	/**
	 * Convenience function for QuizSession::getQuizSessionQuestionsRelatedByquiz_session_id
	 * @return QuizSessionQuestion[]
	 * @see QuizSession::getQuizSessionQuestionsRelatedByQuizSessionId
	 */
	function getQuizSessionQuestions($extra = null) {
		return $this->getQuizSessionQuestionsRelatedByQuizSessionId($extra);
	}

	/**
	  * Convenience function for QuizSession::getQuizSessionQuestionsRelatedByquiz_session_idQuery
	  * @return Query
	  * @see QuizSession::getQuizSessionQuestionsRelatedByquiz_session_idQuery
	  */
	function getQuizSessionQuestionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_question', 'quiz_session_id','id', $q);
	}

	/**
	  * Convenience function for QuizSession::deleteQuizSessionQuestionsRelatedByquiz_session_id
	  * @return int
	  * @see QuizSession::deleteQuizSessionQuestionsRelatedByquiz_session_id
	  */
	function deleteQuizSessionQuestions(Query $q = null) {
		return $this->deleteQuizSessionQuestionsRelatedByQuizSessionId($q);
	}

	/**
	  * Convenience function for QuizSession::countQuizSessionQuestionsRelatedByquiz_session_id
	  * @return int
	  * @see QuizSession::countQuizSessionQuestionsRelatedByQuizSessionId
	  */
	function countQuizSessionQuestions(Query $q = null) {
		return $this->countQuizSessionQuestionsRelatedByQuizSessionId($q);
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
		if (null === $this->getquiz_id()) {
			$this->_validationErrors[] = 'quiz_id must not be null';
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