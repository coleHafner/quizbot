<?php

class QuizSessionQuestion extends baseQuizSessionQuestion {

	/**
	 * @return	QuizSessionQuestion[]
	 */
	public function getDuplicates() {
		$q = Query::create()
			->add(QuizSessionQuestion::QUESTION_ID, $this->getQuestionId())
			->add(QuizSessionQuestion::QUIZ_SESSION_ID, $this->getQuizSessionId());

		return QuizSessionQuestion::doSelect();

	}

	/**
	 * @return	QuizSessionQuestion
	 */
	public function saveOrCreate() {
		$qsqs = $this->getDuplicates();

		if (!$qsqs) {
			$this->setOpened(time());
			$this->setQuestionText($this->getQuestion()->getText());
			$this->save();
			return $this;
		}

		return array_shift($qsqs);
	}

	/**
	 * Sets this->closed to timestamp.
	 * @param	int			$time		optional
	 * @return	QuizSessionQuestion
	 */
	public function close($time = null) {
		$time = empty($time) ? time() : $time;
		$this->setClosed($time);
		return $this;
	}

	public function isClosed() {
		return ($this->getClosed() && $this->getOpened());
	}

	public function allStudentsHaveAnswered() {
		foreach($this->getQuizSession()->getQuizSessionDevices() as $qsd) {
			if (!$qsd->hasAnsweredQuestion($this)) {
				return false;
			}
		}

		return true;
	}

}