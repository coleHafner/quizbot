<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuiz extends ApplicationModel {

	const ID = 'quiz.id';
	const SESSION_ID = 'quiz.session_id';
	const CLASSROOM_ID = 'quiz.classroom_id';
	const NAME = 'quiz.name';
	const ARCHIVED = 'quiz.archived';
	const CREATED = 'quiz.created';
	const UPDATED = 'quiz.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'quiz';

	/**
	 * Cache of objects retrieved from the database
	 * @var Quiz[]
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
		Quiz::ID,
		Quiz::SESSION_ID,
		Quiz::CLASSROOM_ID,
		Quiz::NAME,
		Quiz::ARCHIVED,
		Quiz::CREATED,
		Quiz::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'session_id',
		'classroom_id',
		'name',
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
		'name' => Model::COLUMN_TYPE_VARCHAR,
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
	 * `name` VARCHAR NOT NULL
	 * @var string
	 */
	protected $name;

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
	 * @return Quiz
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
	 * @return Quiz
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Quiz::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Quiz::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for Quiz::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Quiz::setSessionId
	 * @return Quiz
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
	 * @return Quiz
	 */
	function setClassroomId($value) {
		return $this->setColumnValue('classroom_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Quiz::getClassroomId
	 * final because getClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see Quiz::getClassroomId
	 */
	final function getClassroom_id() {
		return $this->getClassroomId();
	}

	/**
	 * Convenience function for Quiz::setClassroomId
	 * final because setClassroomId should be extended instead
	 * to ensure consistent behavior
	 * @see Quiz::setClassroomId
	 * @return Quiz
	 */
	final function setClassroom_id($value) {
		return $this->setClassroomId($value);
	}

	/**
	 * Gets the value of the name field
	 */
	function getName() {
		return $this->name;
	}

	/**
	 * Sets the value of the name field
	 * @return Quiz
	 */
	function setName($value) {
		return $this->setColumnValue('name', $value, Model::COLUMN_TYPE_VARCHAR);
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
	 * @return Quiz
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
	 * @return Quiz
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
	 * @return Quiz
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
	 * @return Quiz
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Quiz
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
	 * @return Quiz
	 */
	static function retrieveById($value) {
		return Quiz::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return Quiz
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a classroom_id
	 * value that matches the one provided
	 * @return Quiz
	 */
	static function retrieveByClassroomId($value) {
		return static::retrieveByColumn('classroom_id', $value);
	}

	/**
	 * Searches the database for a row with a name
	 * value that matches the one provided
	 * @return Quiz
	 */
	static function retrieveByName($value) {
		return static::retrieveByColumn('name', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return Quiz
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return Quiz
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return Quiz
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return Quiz
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->classroom_id = (null === $this->classroom_id) ? null : (int) $this->classroom_id;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return Quiz
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return Quiz
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
	 * @return Quiz[]
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
	 * @return Quiz
	 */
	function setClassroom(Classroom $classroom = null) {
		return $this->setClassroomRelatedByClassroomId($classroom);
	}

	/**
	 * @return Quiz
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
	 * @return Quiz[]
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
	 * @return Quiz[]
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
	
		$to_table = Classroom::getTableName();
		$q->join($to_table, $this_table . '.classroom_id = ' . $to_table . '.id', $join_type);
		foreach (Classroom::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Classroom';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns a Query for selecting question Objects(rows) from the question table
	 * with a quiz_id that matches $this->id.
	 * @return Query
	 */
	function getQuestionsRelatedByQuizIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question', 'quiz_id', 'id', $q);
	}

	/**
	 * Returns the count of Question Objects(rows) from the question table
	 * with a quiz_id that matches $this->id.
	 * @return int
	 */
	function countQuestionsRelatedByQuizId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Question::doCount($this->getQuestionsRelatedByQuizIdQuery($q));
	}

	/**
	 * Deletes the question Objects(rows) from the question table
	 * with a quiz_id that matches $this->id.
	 * @return int
	 */
	function deleteQuestionsRelatedByQuizId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuestionsRelatedByQuizId_c = array();
		return Question::doDelete($this->getQuestionsRelatedByQuizIdQuery($q));
	}

	protected $QuestionsRelatedByQuizId_c = array();

	/**
	 * Returns an array of Question objects with a quiz_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Question[]
	 */
	function getQuestionsRelatedByQuizId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuestionsRelatedByQuizId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuestionsRelatedByQuizId_c;
		}

		$result = Question::doSelect($this->getQuestionsRelatedByQuizIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuestionsRelatedByQuizId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz_session Objects(rows) from the quiz_session table
	 * with a quiz_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionsRelatedByQuizIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session', 'quiz_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSession Objects(rows) from the quiz_session table
	 * with a quiz_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionsRelatedByQuizId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSession::doCount($this->getQuizSessionsRelatedByQuizIdQuery($q));
	}

	/**
	 * Deletes the quiz_session Objects(rows) from the quiz_session table
	 * with a quiz_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionsRelatedByQuizId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionsRelatedByQuizId_c = array();
		return QuizSession::doDelete($this->getQuizSessionsRelatedByQuizIdQuery($q));
	}

	protected $QuizSessionsRelatedByQuizId_c = array();

	/**
	 * Returns an array of QuizSession objects with a quiz_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSession[]
	 */
	function getQuizSessionsRelatedByQuizId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionsRelatedByQuizId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionsRelatedByQuizId_c;
		}

		$result = QuizSession::doSelect($this->getQuizSessionsRelatedByQuizIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionsRelatedByQuizId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for Quiz::getQuestionsRelatedByquiz_id
	 * @return Question[]
	 * @see Quiz::getQuestionsRelatedByQuizId
	 */
	function getQuestions($extra = null) {
		return $this->getQuestionsRelatedByQuizId($extra);
	}

	/**
	  * Convenience function for Quiz::getQuestionsRelatedByquiz_idQuery
	  * @return Query
	  * @see Quiz::getQuestionsRelatedByquiz_idQuery
	  */
	function getQuestionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question', 'quiz_id','id', $q);
	}

	/**
	  * Convenience function for Quiz::deleteQuestionsRelatedByquiz_id
	  * @return int
	  * @see Quiz::deleteQuestionsRelatedByquiz_id
	  */
	function deleteQuestions(Query $q = null) {
		return $this->deleteQuestionsRelatedByQuizId($q);
	}

	/**
	  * Convenience function for Quiz::countQuestionsRelatedByquiz_id
	  * @return int
	  * @see Quiz::countQuestionsRelatedByQuizId
	  */
	function countQuestions(Query $q = null) {
		return $this->countQuestionsRelatedByQuizId($q);
	}

	/**
	 * Convenience function for Quiz::getQuizSessionsRelatedByquiz_id
	 * @return QuizSession[]
	 * @see Quiz::getQuizSessionsRelatedByQuizId
	 */
	function getQuizSessions($extra = null) {
		return $this->getQuizSessionsRelatedByQuizId($extra);
	}

	/**
	  * Convenience function for Quiz::getQuizSessionsRelatedByquiz_idQuery
	  * @return Query
	  * @see Quiz::getQuizSessionsRelatedByquiz_idQuery
	  */
	function getQuizSessionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session', 'quiz_id','id', $q);
	}

	/**
	  * Convenience function for Quiz::deleteQuizSessionsRelatedByquiz_id
	  * @return int
	  * @see Quiz::deleteQuizSessionsRelatedByquiz_id
	  */
	function deleteQuizSessions(Query $q = null) {
		return $this->deleteQuizSessionsRelatedByQuizId($q);
	}

	/**
	  * Convenience function for Quiz::countQuizSessionsRelatedByquiz_id
	  * @return int
	  * @see Quiz::countQuizSessionsRelatedByQuizId
	  */
	function countQuizSessions(Query $q = null) {
		return $this->countQuizSessionsRelatedByQuizId($q);
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
		if (null === $this->getname()) {
			$this->_validationErrors[] = 'name must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}