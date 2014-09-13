<?php

class Question extends baseQuestion {

	const TYPE_MULTIPLE_CHOICE = 1;
	const TYPE_BOOLEAN = 2;

	const ANSWER_BOOL_TRUE = 't';
	const ANSWER_BOOL_FALSE = 'f';

	private static $types = array(
		self::TYPE_MULTIPLE_CHOICE => 'Multiple Choice',
		self::TYPE_BOOLEAN => 'True/False'
	);

	/**
	 * @return	string
	 */
	public function __toString() {
		return $this->getText();
	}

	/**
	 * @return	QuestionAnswer[]
	 */
	public function getAnswers(Query $q = null) {

		if ($this->isTrueFalse()) {
			return array(
				QuestionAnswer::create()->setQuestion($this)->setText('True'),
				QuestionAnswer::create()->setQuestion($this)->setText('False')
			);
		}

		$q = !$q ? new Query : $q;
		$q->add(QuestionAnswer::ARCHIVED, null);
		return $this->getQuestionAnswers($q);
	}

	/**
	 * @return	boolean
	 */
	public function hasAnswers() {
		return $this->getNumAnswers() > 0;
	}

	/**
	 * @return	int
	 */
	public function getNumAnswers() {

		if ($this->isTrueFalse()) {
			return 2;
		}

		return Query::create()
			->setTable(QuestionAnswer::getTableName())
			->add(QuestionAnswer::QUESTION_ID, $this->getId())
			->add(QuestionAnswer::ARCHIVED, null)
			->doCount();
	}

	/**
	 * @return	boolean
	 */
	public function isMultipleChoice() {
		return $this->getType() == self::TYPE_MULTIPLE_CHOICE;
	}

	/**
	 * @return	boolean
	 */
	public function isTrueFalse() {
		return $this->getType() == self::TYPE_BOOLEAN;
	}

	public static function getTypes() {
		return self::$types;
	}

	/**
	 * Returns QuestionAnswer object if multiple choice, t or f otherwise.
	 * @return	QuestionAnswer
	 */
	public function getCorrectAnswer() {
		return $this->isMultipleChoice() ?
			QuestionAnswer::retrieveByPk($this->getCorrectAnswerId()) : $this->getCorrectAnswerBoolean();
	}

	/**
	 * @return	string
	 */
	public function getTypeName() {
		return $this->getType() ? self::$types[$this->getType()] : null;
	}

	public function clearAnswers($exclude_ids = array()) {
		$q = null;

		if ($exclude_ids) {
			$q = Query::create()
				->add(QuestionAnswer::ID, $exclude_ids, Query::NOT_IN);
		}

		array_map(function($qa) {
			$qa->delete();
		}, $this->getAnswers($q));

		$this->setCorrectAnswerId(null);
		$this->setCorrectAnswerBoolean(null);
	}

	public static function getQuery(array $params = array(), Query $q = null) {

		$q = !$q ? new Query : $q;

		if (!empty($params['quiz_id'])) {
			$q->add(Question::QUIZ_ID, $params['quiz_id']);
		}

		return parent::getQuery($params, $q);
	}
}