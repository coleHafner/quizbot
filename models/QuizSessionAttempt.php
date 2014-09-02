<?php

class QuizSessionAttempt extends baseQuizSessionAttempt {

	/**
	 * @param	array	$params
	 * @param	Query	$q
	 * @return	Query
	 */
	public static function getQuery(array $params = array(), Query $q = null) {
		
		$q = !$q ? new Query : $q;

		if (!empty($params['quiz_id'])) {
			$q->join(QuizSessionAttempt::QUIZ_SESSION_QUESTION_ID, QuizSessionQuestion::ID);
			$q->join(QuizSessionQuestion::QUIZ_SESSION_ID, QuizSession::ID);
			$q->add(QuizSession::QUIZ_ID, $params['quiz_id']);
		}

		return parent::getQuery($params, $q);
	}

	/**
	 * @return	Question
	 */
	public function getQuestion() {
		return $this->getQuizSessionQuestion()->getQuestion();
	}

	/**
	 * @return	string
	 */
	public function getQuestionText() {
		return $this->getQuestion()->getText();
	}
}