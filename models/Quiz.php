<?php

class Quiz extends baseQuiz {

	/**
	 * @return	string
	 */
	public function getStatus() {
		return $this->getArchived() ? 'Deleted' : 'Active';
	}

	/**
	 * @return	string
	 */
	public function __toString() {
		return $this->getName();
	}

	/**
	 * @return	int
	 */
	public function getNumQuestions() {
		return Question::doCount(Query::create()
			->add(Question::QUIZ_ID, $this->getId())
			->add(Question::ARCHIVED, null)
		);
	}

	/**
	 * Returns all quizzes with at least one question.
	 * @return	Quiz[]
	 */
	static function getQuizzesEligibleForSession(Query $q = null) {

		$q = !$q ? new Query : clone $q;

		$q->join(Quiz::ID, Question::QUIZ_ID)
			->orderBy(Quiz::NAME, Query::ASC)
			->groupBy(Quiz::ID);

		return Quiz::doSelect($q);
	}
}