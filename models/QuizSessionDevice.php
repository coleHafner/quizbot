<?php

class QuizSessionDevice extends baseQuizSessionDevice {

	/**
	 * Determines if the
	 * @param	QuizSessionQuestion		$qsq
	 * @return	boolean
	 */
	function hasAnsweredQuestion(QuizSessionQuestion $qsq) {
		return QuizSessionAttempt::doCount(Query::create()
			->add(QuizSessionAttempt::QUIZ_SESSION_DEVICE_ID, $this->getId())
			->add(QuizSessionAttempt::QUIZ_SESSION_QUESTION_ID, $qsq->getId())
			->add(QuizSessionAttempt::ANSWER_CHOICE, null, Query::IS_NOT_NULL)) > 0;
	}
}