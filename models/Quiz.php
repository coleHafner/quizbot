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
}