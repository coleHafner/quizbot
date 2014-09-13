<?php

class QuizSessionQuestion extends baseQuizSessionQuestion {

	/**
	 * @return	QuizSessionQuestion[]
	 */
	public function getDuplicate() {
		return QuizSessionQuestion::doSelectOne(Query::create()
			->add(QuizSessionQuestion::QUESTION_ID, $this->getQuestionId())
			->add(QuizSessionQuestion::QUIZ_SESSION_ID, $this->getQuizSessionId())
		);
	}

	/**
	 * @return	QuizSessionQuestion
	 */
	public function saveOrCreate() {
		$qsq = $this->getDuplicate();

		if (!$qsq) {
			$this->setOpened(time());
			$this->setQuestionText($this->getQuestion()->getText());
			$this->save();
			return $this;
		}

		return $qsq;
	}

	/**
	 * Sets this->closed to timestamp.
	 * @param	int			$time		optional
	 * @return	QuizSessionQuestion
	 */
	public function close($time = null) {
		$time = empty($time) ? time() : $time;
		$this->setClosed(time());
		return $this;
	}

	/**
	 * @return	QuizSessionQuestion
	 */
	public function open() {
		$this->setClosed(null);
		return $this;
	}

	public function isClosed() {
		return ($this->getClosed() && $this->getOpened());
	}

	public function isOpen() {
		return !$this->getClosed();
	}

	public function allStudentsHaveAnswered() {
		foreach($this->getQuizSession()->getQuizSessionDevices() as $qsd) {
			if (!$qsd->hasAnsweredQuestion($this)) {
				return false;
			}
		}

		return true;
	}

	public function save() {
		return parent::save();
	}

}