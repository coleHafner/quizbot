<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseQuestion extends ApplicationModel {

	const ID = 'question.id';
	const SESSION_ID = 'question.session_id';
	const QUIZ_ID = 'question.quiz_id';
	const CORRECT_ANSWER_ID = 'question.correct_answer_id';
	const CORRECT_ANSWER_BOOLEAN = 'question.correct_answer_boolean';
	const TYPE = 'question.type';
	const TEXT = 'question.text';
	const ARCHIVED = 'question.archived';
	const CREATED = 'question.created';
	const UPDATED = 'question.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'question';

	/**
	 * Cache of objects retrieved from the database
	 * @var Question[]
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
		Question::ID,
		Question::SESSION_ID,
		Question::QUIZ_ID,
		Question::CORRECT_ANSWER_ID,
		Question::CORRECT_ANSWER_BOOLEAN,
		Question::TYPE,
		Question::TEXT,
		Question::ARCHIVED,
		Question::CREATED,
		Question::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'session_id',
		'quiz_id',
		'correct_answer_id',
		'correct_answer_boolean',
		'type',
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
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'quiz_id' => Model::COLUMN_TYPE_INTEGER,
		'correct_answer_id' => Model::COLUMN_TYPE_INTEGER,
		'correct_answer_boolean' => Model::COLUMN_TYPE_VARCHAR,
		'type' => Model::COLUMN_TYPE_INTEGER,
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
	 * `correct_answer_id` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $correct_answer_id;

	/**
	 * `correct_answer_boolean` VARCHAR
	 * @var string
	 */
	protected $correct_answer_boolean;

	/**
	 * `type` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $type;

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
	 * @return Question
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
	 * @return Question
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Question::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Question::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for Question::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Question::setSessionId
	 * @return Question
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
	 * @return Question
	 */
	function setQuizId($value) {
		return $this->setColumnValue('quiz_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Question::getQuizId
	 * final because getQuizId should be extended instead
	 * to ensure consistent behavior
	 * @see Question::getQuizId
	 */
	final function getQuiz_id() {
		return $this->getQuizId();
	}

	/**
	 * Convenience function for Question::setQuizId
	 * final because setQuizId should be extended instead
	 * to ensure consistent behavior
	 * @see Question::setQuizId
	 * @return Question
	 */
	final function setQuiz_id($value) {
		return $this->setQuizId($value);
	}

	/**
	 * Gets the value of the correct_answer_id field
	 */
	function getCorrectAnswerId() {
		return $this->correct_answer_id;
	}

	/**
	 * Sets the value of the correct_answer_id field
	 * @return Question
	 */
	function setCorrectAnswerId($value) {
		return $this->setColumnValue('correct_answer_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Question::getCorrectAnswerId
	 * final because getCorrectAnswerId should be extended instead
	 * to ensure consistent behavior
	 * @see Question::getCorrectAnswerId
	 */
	final function getCorrect_answer_id() {
		return $this->getCorrectAnswerId();
	}

	/**
	 * Convenience function for Question::setCorrectAnswerId
	 * final because setCorrectAnswerId should be extended instead
	 * to ensure consistent behavior
	 * @see Question::setCorrectAnswerId
	 * @return Question
	 */
	final function setCorrect_answer_id($value) {
		return $this->setCorrectAnswerId($value);
	}

	/**
	 * Gets the value of the correct_answer_boolean field
	 */
	function getCorrectAnswerBoolean() {
		return $this->correct_answer_boolean;
	}

	/**
	 * Sets the value of the correct_answer_boolean field
	 * @return Question
	 */
	function setCorrectAnswerBoolean($value) {
		return $this->setColumnValue('correct_answer_boolean', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Convenience function for Question::getCorrectAnswerBoolean
	 * final because getCorrectAnswerBoolean should be extended instead
	 * to ensure consistent behavior
	 * @see Question::getCorrectAnswerBoolean
	 */
	final function getCorrect_answer_boolean() {
		return $this->getCorrectAnswerBoolean();
	}

	/**
	 * Convenience function for Question::setCorrectAnswerBoolean
	 * final because setCorrectAnswerBoolean should be extended instead
	 * to ensure consistent behavior
	 * @see Question::setCorrectAnswerBoolean
	 * @return Question
	 */
	final function setCorrect_answer_boolean($value) {
		return $this->setCorrectAnswerBoolean($value);
	}

	/**
	 * Gets the value of the type field
	 */
	function getType() {
		return $this->type;
	}

	/**
	 * Sets the value of the type field
	 * @return Question
	 */
	function setType($value) {
		return $this->setColumnValue('type', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the text field
	 */
	function getText() {
		return $this->text;
	}

	/**
	 * Sets the value of the text field
	 * @return Question
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
	 * @return Question
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
	 * @return Question
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
	 * @return Question
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
	 * @return Question
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Question
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
	 * @return Question
	 */
	static function retrieveById($value) {
		return Question::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a quiz_id
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByQuizId($value) {
		return static::retrieveByColumn('quiz_id', $value);
	}

	/**
	 * Searches the database for a row with a correct_answer_id
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByCorrectAnswerId($value) {
		return static::retrieveByColumn('correct_answer_id', $value);
	}

	/**
	 * Searches the database for a row with a correct_answer_boolean
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByCorrectAnswerBoolean($value) {
		return static::retrieveByColumn('correct_answer_boolean', $value);
	}

	/**
	 * Searches the database for a row with a type
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByType($value) {
		return static::retrieveByColumn('type', $value);
	}

	/**
	 * Searches the database for a row with a text
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByText($value) {
		return static::retrieveByColumn('text', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return Question
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return Question
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->quiz_id = (null === $this->quiz_id) ? null : (int) $this->quiz_id;
		$this->correct_answer_id = (null === $this->correct_answer_id) ? null : (int) $this->correct_answer_id;
		$this->type = (null === $this->type) ? null : (int) $this->type;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return Question
	 */
	function setCorrectAnswer(QuestionAnswer $questionanswer = null) {
		return $this->setQuestionAnswerRelatedByCorrectAnswerId($questionanswer);
	}

	/**
	 * @return Question
	 */
	function setQuestionAnswerRelatedByCorrectAnswerId(QuestionAnswer $questionanswer = null) {
		if (null === $questionanswer) {
			$this->setcorrect_answer_id(null);
		} else {
			if (!$questionanswer->getid()) {
				throw new Exception('Cannot connect a QuestionAnswer without a id');
			}
			$this->setcorrect_answer_id($questionanswer->getid());
		}
		return $this;
	}

	/**
	 * Returns a question_answer object with a id
	 * that matches $this->correct_answer_id.
	 * @return QuestionAnswer
	 */
	function getCorrectAnswer() {
		return $this->getQuestionAnswerRelatedByCorrectAnswerId();
	}

	/**
	 * Returns a question_answer object with a id
	 * that matches $this->correct_answer_id.
	 * @return QuestionAnswer
	 */
	function getQuestionAnswerRelatedByCorrectAnswerId() {
		$fk_value = $this->getcorrect_answer_id();
		if (null === $fk_value) {
			return null;
		}
		return QuestionAnswer::retrieveByPK($fk_value);
	}

	static function doSelectJoinCorrectAnswer(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinQuestionAnswerRelatedByCorrectAnswerId($q, $join_type);
	}

	/**
	 * Returns a question_answer object with a id
	 * that matches $this->correct_answer_id.
	 * @return QuestionAnswer
	 */
	function getQuestionAnswer() {
		return $this->getQuestionAnswerRelatedByCorrectAnswerId();
	}

	/**
	 * @return Question
	 */
	function setQuestionAnswer(QuestionAnswer $questionanswer = null) {
		return $this->setQuestionAnswerRelatedByCorrectAnswerId($questionanswer);
	}

	/**
	 * @return Question[]
	 */
	static function doSelectJoinQuestionAnswerRelatedByCorrectAnswerId(Query $q = null, $join_type = Query::LEFT_JOIN) {
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

		$to_table = QuestionAnswer::getTableName();
		$q->join($to_table, $this_table . '.correct_answer_id = ' . $to_table . '.id', $join_type);
		foreach (QuestionAnswer::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('QuestionAnswer'));
	}

	/**
	 * @return Question
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return Question
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
	 * @return Question[]
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
	 * @return Question
	 */
	function setQuiz(Quiz $quiz = null) {
		return $this->setQuizRelatedByQuizId($quiz);
	}

	/**
	 * @return Question
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
	 * @return Question[]
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
	 * @return Question[]
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

		$to_table = QuestionAnswer::getTableName();
		$q->join($to_table, $this_table . '.correct_answer_id = ' . $to_table . '.id', $join_type);
		foreach (QuestionAnswer::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'QuestionAnswer';
	
		$to_table = Session::getTableName();
		$q->join($to_table, $this_table . '.session_id = ' . $to_table . '.id', $join_type);
		foreach (Session::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Session';
	
		$to_table = Quiz::getTableName();
		$q->join($to_table, $this_table . '.quiz_id = ' . $to_table . '.id', $join_type);
		foreach (Quiz::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Quiz';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns a Query for selecting question_answer Objects(rows) from the question_answer table
	 * with a question_id that matches $this->id.
	 * @return Query
	 */
	function getQuestionAnswersRelatedByQuestionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question_answer', 'question_id', 'id', $q);
	}

	/**
	 * Returns the count of QuestionAnswer Objects(rows) from the question_answer table
	 * with a question_id that matches $this->id.
	 * @return int
	 */
	function countQuestionAnswersRelatedByQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuestionAnswer::doCount($this->getQuestionAnswersRelatedByQuestionIdQuery($q));
	}

	/**
	 * Deletes the question_answer Objects(rows) from the question_answer table
	 * with a question_id that matches $this->id.
	 * @return int
	 */
	function deleteQuestionAnswersRelatedByQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuestionAnswersRelatedByQuestionId_c = array();
		return QuestionAnswer::doDelete($this->getQuestionAnswersRelatedByQuestionIdQuery($q));
	}

	protected $QuestionAnswersRelatedByQuestionId_c = array();

	/**
	 * Returns an array of QuestionAnswer objects with a question_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuestionAnswer[]
	 */
	function getQuestionAnswersRelatedByQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuestionAnswersRelatedByQuestionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuestionAnswersRelatedByQuestionId_c;
		}

		$result = QuestionAnswer::doSelect($this->getQuestionAnswersRelatedByQuestionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuestionAnswersRelatedByQuestionId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz_session_question Objects(rows) from the quiz_session_question table
	 * with a question_id that matches $this->id.
	 * @return Query
	 */
	function getQuizSessionQuestionsRelatedByQuestionIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_question', 'question_id', 'id', $q);
	}

	/**
	 * Returns the count of QuizSessionQuestion Objects(rows) from the quiz_session_question table
	 * with a question_id that matches $this->id.
	 * @return int
	 */
	function countQuizSessionQuestionsRelatedByQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return QuizSessionQuestion::doCount($this->getQuizSessionQuestionsRelatedByQuestionIdQuery($q));
	}

	/**
	 * Deletes the quiz_session_question Objects(rows) from the quiz_session_question table
	 * with a question_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizSessionQuestionsRelatedByQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizSessionQuestionsRelatedByQuestionId_c = array();
		return QuizSessionQuestion::doDelete($this->getQuizSessionQuestionsRelatedByQuestionIdQuery($q));
	}

	protected $QuizSessionQuestionsRelatedByQuestionId_c = array();

	/**
	 * Returns an array of QuizSessionQuestion objects with a question_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return QuizSessionQuestion[]
	 */
	function getQuizSessionQuestionsRelatedByQuestionId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizSessionQuestionsRelatedByQuestionId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizSessionQuestionsRelatedByQuestionId_c;
		}

		$result = QuizSessionQuestion::doSelect($this->getQuizSessionQuestionsRelatedByQuestionIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizSessionQuestionsRelatedByQuestionId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for Question::getQuestionAnswersRelatedByquestion_id
	 * @return QuestionAnswer[]
	 * @see Question::getQuestionAnswersRelatedByQuestionId
	 */
	function getQuestionAnswers($extra = null) {
		return $this->getQuestionAnswersRelatedByQuestionId($extra);
	}

	/**
	  * Convenience function for Question::getQuestionAnswersRelatedByquestion_idQuery
	  * @return Query
	  * @see Question::getQuestionAnswersRelatedByquestion_idQuery
	  */
	function getQuestionAnswersQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('question_answer', 'question_id','id', $q);
	}

	/**
	  * Convenience function for Question::deleteQuestionAnswersRelatedByquestion_id
	  * @return int
	  * @see Question::deleteQuestionAnswersRelatedByquestion_id
	  */
	function deleteQuestionAnswers(Query $q = null) {
		return $this->deleteQuestionAnswersRelatedByQuestionId($q);
	}

	/**
	  * Convenience function for Question::countQuestionAnswersRelatedByquestion_id
	  * @return int
	  * @see Question::countQuestionAnswersRelatedByQuestionId
	  */
	function countQuestionAnswers(Query $q = null) {
		return $this->countQuestionAnswersRelatedByQuestionId($q);
	}

	/**
	 * Convenience function for Question::getQuizSessionQuestionsRelatedByquestion_id
	 * @return QuizSessionQuestion[]
	 * @see Question::getQuizSessionQuestionsRelatedByQuestionId
	 */
	function getQuizSessionQuestions($extra = null) {
		return $this->getQuizSessionQuestionsRelatedByQuestionId($extra);
	}

	/**
	  * Convenience function for Question::getQuizSessionQuestionsRelatedByquestion_idQuery
	  * @return Query
	  * @see Question::getQuizSessionQuestionsRelatedByquestion_idQuery
	  */
	function getQuizSessionQuestionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz_session_question', 'question_id','id', $q);
	}

	/**
	  * Convenience function for Question::deleteQuizSessionQuestionsRelatedByquestion_id
	  * @return int
	  * @see Question::deleteQuizSessionQuestionsRelatedByquestion_id
	  */
	function deleteQuizSessionQuestions(Query $q = null) {
		return $this->deleteQuizSessionQuestionsRelatedByQuestionId($q);
	}

	/**
	  * Convenience function for Question::countQuizSessionQuestionsRelatedByquestion_id
	  * @return int
	  * @see Question::countQuizSessionQuestionsRelatedByQuestionId
	  */
	function countQuizSessionQuestions(Query $q = null) {
		return $this->countQuizSessionQuestionsRelatedByQuestionId($q);
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
		if (null === $this->gettype()) {
			$this->_validationErrors[] = 'type must not be null';
		}
		if (null === $this->gettext()) {
			$this->_validationErrors[] = 'text must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}