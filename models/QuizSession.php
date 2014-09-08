<?php

class QuizSession extends baseQuizSession {

	/**
	 * For caching student/device relationships for new QuizSessions
	 * @var	array
	 */
	private $sessionDeviceCache = array();

	/**
	 * @return	string
	 */
	public function __toString() {
		return $this->getQuiz()->__toString();
	}

	/**
	 * @param	int		$device_id
	 * @param	int		$student_id
	 * @return	QuizSessionDevice
	 */
	public function addDevice($device_id, $student_id) {
		return QuizSessionDevice::create()
			->setDeviceId($device_id)
			->setUserId($student_id)
			->setQuizSession($this)
			->save();
	}

	/**
	 * @param	Question	$question
	 * @return	boolean
	 */
	public function hasClosedQuestion(Question $question) {
		$q = $this->getQuizSessionQuestionsQuery()
			->add(QuizSessionQuestion::QUESTION_ID, $question->getId())
			->add(QuizSessionQuestion::OPENED, null, Query::IS_NOT_NULL)
			->add(QuizSessionQuestion::CLOSED, null, Query::IS_NOT_NULL);

		return QuizSessionQuestion::doCount($q) > 0;
	}

	/**
	 * Wrapper for getQuizSessionQuestions()
	 * @param	Query		$q		optional
	 * @return	QuizSessionQuestion[]
	 */
	public function getSessionQuestions(Query $q = null) {
		return $this->getQuizSessionQuestions($q);
	}

	/**
	 * @return	boolean
	 */
	public function hasAttempts() {
		return QuizSessionAttempt::doCount($this->getQuizSessionAttemptsQuery()) > 0;
	}

	/**
	 * Removes all devices for this QuizSession (as long as there is no attempts)
	 * @return type
	 */
	public function clearDevices() {

		if ($this->hasAttempts()) {
			throw new RuntimeException('Error: Cannot do clear devices for quiz session with existing attempts.');
		}

		$q = Query::create()
			->add(QuizSessionDevice::QUIZ_SESSION_ID, $this->getId());

		return QuizSessionDevice::doDelete($q);
	}

	/**
	 * @param	Device		$device
	 * @param	User		$student
	 * @return boolean
	 */
	public function hasSessionDeviceForStudent(Device $device, User $student) {

		if ($this->isNew() && !empty($this->sessionDeviceCache[$device->getId() . '_' . $student->getId()])) {
			return true;
		}

		return QuizSessionDevice::doCount(Query::create()
			->add(QuizSessionDevice::QUIZ_SESSION_ID, $this->getId())
			->add(QuizSessionDevice::DEVICE_ID, $device->getId())
			->add(QuizSessionDevice::USER_ID, $student->getId())
		) > 0;
	}

	/**
	 * @param	array	$device_ids
	 * @param	array	$student_ids
	 * @return	array
	 */
	public function setSessionDeviceCache(array $device_ids, array $student_ids) {

		$this->sessionDeviceCache = array();

		if (!$this->isNew()) {
			throw new RuntimeException('Error: Refusing to set sessionDeviceCache for existing quizSession.');
		}

		$i = 0;

		foreach ($device_ids as $device_id) {
			$student_id = $student_ids[$i];

			if (empty($student_id)) {
				continue;
			}

			$this->sessionDeviceCache[$device_id . '_' . $student_id] = true;
			$i++;
		}

		return $this->sessionDeviceCache;
	}

	public function fromArray($array) {

		if (!empty($array['students']) && !empty($array['devices'])) {
			$this->setSessionDeviceCache($array['devices'], $array['students']);
		}

		return parent::fromArray($array);
	}

	/**
	 * @return	QuizSessionDevice[]
	 */
	public function getSessionDevices() {
		return $this->getQuizSessionDevices();
	}

}