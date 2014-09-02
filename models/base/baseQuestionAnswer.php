<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuestionAnswer extends ApplicationModel {

	const ID = 'question_answer.id';
	const QUESTION_ID = 'question_answer.question_id';
	const SESSION_ID = 'question_answer.session_id';
	const PRIORITY = 'question_answer.priority';
	const TEXT = 'question_answer.text';
	const ARCHIVED = 'question_answer.archived';
	const CREATED = 'question_answer.created';
	const UPDATED = 'question_answer.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'question_answer';

	/**
	 * Cache of objects retrieved from the database
	 * @var QuestionAnswer[]
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
		QuestionAnswer::ID,
		QuestionAnswer::QUESTION_ID,
		QuestionAnswer::SESSION_ID,
		QuestionAnswer::PRIORITY,
		QuestionAnswer::TEXT,
		QuestionAnswer::ARCHIVED,
		QuestionAnswer::CREATED,
		QuestionAnswer::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'question_id',
		'session_id',
		'priority',
		'text',
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
		'question_id' => Model::COLUMN_TYPE_INTEGER,
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'priority' => Model::COLUMN_TYPE_INTEGER,
		'text' => Model::COLUMN_TYPE_VARCHAR,
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
	 * `question_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $question_id;

	/**
	 * `session_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $session_id;

	/**
	 * `priority` INTEGER NOT NULL DEFAULT 0
	 * @var int
	 */
	protected $priority = 0;

	/**
	 * `text` VARCHAR NOT NULL
	 * @var string
	 */
	protected $text;

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
	 * @return QuestionAnswer
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the question_id field
	 */
	function getQuestionId() {
		return $this->question_id;
	}

	/**
	 * Sets the value of the question_id field
	 * @return QuestionAnswer
	 */
	function setQuestionId($value) {
		return $this->setColumnValue('question_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuestionAnswer::getQuestionId
	 * final because getQuestionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuestionAnswer::getQuestionId
	 */
	final function getQuestion_id() {
		return $this->getQuestionId();
	}

	/**
	 * Convenience function for QuestionAnswer::setQuestionId
	 * final because setQuestionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuestionAnswer::setQuestionId
	 * @return QuestionAnswer
	 */
	final function setQuestion_id($value) {
		return $this->setQuestionId($value);
	}

	/**
	 * Gets the value of the session_id field
	 */
	function getSessionId() {
		return $this->session_id;
	}

	/**
	 * Sets the value of the session_id field
	 * @return QuestionAnswer
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for QuestionAnswer::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuestionAnswer::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for QuestionAnswer::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see QuestionAnswer::setSessionId
	 * @return QuestionAnswer
	 */
	final function setSession_id($value) {
		return $this->setSessionId($value);
	}

	/**
	 * Gets the value of the priority field
	 */
	function getPriority() {
		return $this->priority;
	}

	/**
	 * Sets the value of the priority field
	 * @return QuestionAnswer
	 */
	function setPriority($value) {
		return $this->setColumnValue('priority', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the text field
	 */
	function getText() {
		return $this->text;
	}

	/**
	 * Sets the value of the text field
	 * @return QuestionAnswer
	 */
	function setText($value) {
		return $this->setColumnValue('text', $value, Model::COLUMN_TYPE_VARCHAR);
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
	 * @return QuestionAnswer
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
	 * @return QuestionAnswer
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
	 * @return QuestionAnswer
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
	 * @return QuestionAnswer
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return QuestionAnswer
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
	 * @return QuestionAnswer
	 */
	static function retrieveById($value) {
		return QuestionAnswer::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a question_id
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveByQuestionId($value) {
		return static::retrieveByColumn('question_id', $value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a priority
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveByPriority($value) {
		return static::retrieveByColumn('priority', $value);
	}

	/**
	 * Searches the database for a row with a text
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveByText($value) {
		return static::retrieveByColumn('text', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return QuestionAnswer
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return QuestionAnswer
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->question_id = (null === $this->question_id) ? null : (int) $this->question_id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->priority = (null === $this->priority) ? null : (int) $this->priority;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return QuestionAnswer
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return QuestionAnswer
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
	 * @return QuestionAnswer[]
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
	 * @return QuestionAnswer
	 */
	function setQuestion(Question $question = null) {
		return $this->setQuestionRelatedByQuestionId($question);
	}

	/**
	 * @return QuestionAnswer
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
	 * @return QuestionAnswer[]
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
	 * @return QuestionAnswer[]
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
	
		$to_table = Question::getTableName();
		$q->join($to_table, $this_table . '.question_id = ' . $to_table . '.id', $join_type);
		foreach (Question::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Question';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns a Query for selecting question Objects(rows) from the question table
	 * with a correct_answer_id that matches $this->id.
	 * @return Query
	 */
	function getQuestionsRelatedByCorrectAnswerIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question', 'correct_answer_id', 'id', $q);
	}

	/**
	 * Returns the count of Question Objects(rows) from the question table
	 * with a correct_answer_id that matches $this->id.
	 * @return int
	 */
	function countQuestionsRelatedByCorrectAnswerId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Question::doCount($this->getQuestionsRelatedByCorrectAnswerIdQuery($q));
	}

	/**
	 * Deletes the question Objects(rows) from the question table
	 * with a correct_answer_id that matches $this->id.
	 * @return int
	 */
	function deleteQuestionsRelatedByCorrectAnswerId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuestionsRelatedByCorrectAnswerId_c = array();
		return Question::doDelete($this->getQuestionsRelatedByCorrectAnswerIdQuery($q));
	}

	protected $QuestionsRelatedByCorrectAnswerId_c = array();

	/**
	 * Returns an array of Question objects with a correct_answer_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Question[]
	 */
	function getQuestionsRelatedByCorrectAnswerId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuestionsRelatedByCorrectAnswerId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuestionsRelatedByCorrectAnswerId_c;
		}

		$result = Question::doSelect($this->getQuestionsRelatedByCorrectAnswerIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuestionsRelatedByCorrectAnswerId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for QuestionAnswer::getQuestionsRelatedBycorrect_answer_id
	 * @return Question[]
	 * @see QuestionAnswer::getQuestionsRelatedByCorrectAnswerId
	 */
	function getQuestions($extra = null) {
		return $this->getQuestionsRelatedByCorrectAnswerId($extra);
	}

	/**
	  * Convenience function for QuestionAnswer::getQuestionsRelatedBycorrect_answer_idQuery
	  * @return Query
	  * @see QuestionAnswer::getQuestionsRelatedBycorrect_answer_idQuery
	  */
	function getQuestionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question', 'correct_answer_id','id', $q);
	}

	/**
	  * Convenience function for QuestionAnswer::deleteQuestionsRelatedBycorrect_answer_id
	  * @return int
	  * @see QuestionAnswer::deleteQuestionsRelatedBycorrect_answer_id
	  */
	function deleteQuestions(Query $q = null) {
		return $this->deleteQuestionsRelatedByCorrectAnswerId($q);
	}

	/**
	  * Convenience function for QuestionAnswer::countQuestionsRelatedBycorrect_answer_id
	  * @return int
	  * @see QuestionAnswer::countQuestionsRelatedByCorrectAnswerId
	  */
	function countQuestions(Query $q = null) {
		return $this->countQuestionsRelatedByCorrectAnswerId($q);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getquestion_id()) {
			$this->_validationErrors[] = 'question_id must not be null';
		}
		if (null === $this->getsession_id()) {
			$this->_validationErrors[] = 'session_id must not be null';
		}
		if (null === $this->gettext()) {
			$this->_validationErrors[] = 'text must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}