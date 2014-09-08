<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuizSessionManager
 *
 * @author colehafner
 */
class QuizSessionManager {

	/**
	 * @var	array
	 */
	private $request = array();

	/**
	 * @var	Question[]
	 */
	private $questions = array();

	/**
	 * @var	QuizSessionQuestion[]
	 */
	private $sessionQuestions = array();

	/**
	 * @var	Quiz
	 */
	private $quiz = null;

	/**
	 * @var	Session
	 */
	private $session = null;

	/**
	 * @var	QuizSession
	 */
	private $quizSession = null;

	/**
	 * @var	array()
	 */
	private $_validationErrors = array();

	function __construct(QuizSession $quiz_session = null) {

		$this->quizSession = $quiz_session;

		if (!$this->quizSession || ($this->quizSession && !$this->quizSession->isNew())) {
			$this->session = $quiz_session->getSession();
			$this->quiz = $quiz_session->getQuiz();
			$this->questions = $this->setQuestions();
			$this->sessionQuestions = $this->setSessionQuestions();
		}

		return $this;
	}

	/**
	 * @return	boolean
	 */
	function validate() {

		$this->_validationErrors = array();

		if (!$this->quiz) {
			$this->_validationErrors[] = 'You must select a quiz';
		}

		$found_any_students = false;

		foreach ($this->request['students'] as $student_id) {
			if (User::doCount(Query::create()->add(User::ID, $student_id)) > 0) {
				$found_any_students = true;
				break;
			}
		}

		if (!$found_any_students) {
			$this->_validationErrors[] = 'You must assign at least one clicker.';
		}

		return count($this->_validationErrors) == 0;
	}

	/**
	 * Creates a quiz session from current properties.
	 * @return boolean
	 */
	function save() {

		$this->quizSession
			->setSession($this->session)
			->setQuiz($this->quiz)
			->setOpened(time());

		$this->quizSession->save();
		$this->quizSession->clearDevices();

		for ($i = 0; $i < count($this->request['devices']); $i++) {

			if (!$this->request['students'][$i]) {
				continue;
			}

			$this->quizSession->addDevice($this->request['devices'][$i], $this->request['students'][$i]);
		}

		return true;
	}

	/**
	 * @return	array
	 */
	function getValidationErrors() {
		return $this->_validationErrors;
	}

	/**
	 * @return	int
	 */
	function getQuizSessionId() {
		return $this->getQuizSession()->getId();
	}

	/**
	 * @return	QuizSession
	 */
	function getQuizSession() {
		return $this->quizSession;
	}

	/**
	 * @return	int
	 */
	function getQuizId() {
		return $this->getQuiz()->getId();
	}

	/**
	 *
	 * @return	Quiz
	 */
	function getQuiz() {
		return $this->quiz;
	}

	/**
	 * @return boolean
	 */
	function closeQuestions() {
		foreach ($this->getSessionQuestions() as $qsq) {
			$qsq->close();
			$qsq->save();
		}

		return true;
	}

	/**
	 * @return boolean
	 */
	function sessionIsOver() {
		if (count($this->getQuestions()) != $this->getSessionQuestions()) {
			return false;
		}

		foreach ($this->getSessionQuestions() as $qsq) {
			if (!$qsq->isClosed()
				|| ($qsq->isClosed() && !$qsq->allStudentsHaveAnswered())) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Creates new QuizSessionQuestion record only if the question doesn't already exist.
	 * @param	Question		$question
	 * @return	QuizSessionQuestion
	 */
	function addSessionQuestion(Question $question) {
		$qsq = QuizSessionQuestion::create()
			->setQuizSession($this->getQuizSession())
			->setQuestion($question)
			->setQuestionText($question->getText())
			->setOpened(time())
			->saveOrCreate();

		$qsq->setClosed(null);
		$qsq->save();
		$this->sessionQuestions[$qsq->getId()] = $qsq;
		return $qsq;
	}

	/**
	 * @return	Question[]
	 */
	function setQuestions() {

		if (!$this->getQuiz()) {
			throw new RuntimeException('Error: Cannot set questions without quiz.');
		}

		$this->questions = array();
		$q = Query::create()->orderBy(Question::ID, Query::ASC);
		$this->questions = $this->getQuiz()->getQuestions($q);
		return $this->questions;
	}

	function setSessionQuestions() {
		if (!$this->getQuizSession()) {
			throw new RuntimeException('Error: Cannot set questions without quiz session.');
		}

		$this->sessionQuestions = array();
		$q = Query::create()->orderBy(QuizSessionQuestion::QUESTION_ID, Query::ASC);
		$qsqs = $this->getQuizSession()->getSessionQuestions($q);

		foreach($qsqs as $qsq) {
			$this->sessionQuestions[$qsq->getId()] = $qsq;
		}

		return $this->sessionQuestions;
	}

	/**
	 * @return	Question[]
	 */
	function getQuestions() {
		if ($this->questions) {
			return $this->questions;
		}

		return $this->setQuestions();
	}

	/**
	 * @return	Question[]
	 */
	function getSessionQuestions() {
		if ($this->sessionQuestions) {
			return $this->sessionQuestions;
		}

		return $this->setSessionQuestions();
	}

	/**
	 * @return	Question
	 */
	function getNextQuestion() {
		return $this->getQuestion(true);
	}

	function getPrevQuestion() {
		return $this->getQuestion(false);
	}

	/**
	 * @param array $request
	 */
	function setRequest(array $request) {
		$this->request = $request;
	}

	/**
	 * @param array $session
	 */
	function setSession(Session $session) {
		$this->session = $session;
	}

	private function getCurrentIndex() {

		if (!count($this->getSessionQuestions())) {
			return 0;
		}

		$i = 0;

		foreach ($this->getSessionQuestions() as $qsq) {
			if (!$qsq->getClosed()) {
				return $i;
			}

			$i++;
		}
	}

	private function getQuestion($next) {
		$i = $this->getCurrentIndex();

		if ($i === null) {
			return null;
		}

		$target_index = $next ? $i + 1 : $i - 1;
		$questions = $this->getQuestions();

		if ($target_index <= count($questions) && $target_index > 0) {
			return $questions[$target_index];
		}

		return null;
	}

	/**
	 * @param	array		$request
	 * @param	Session		$session
	 * @return	QuizSessionManager
	 */
	static function create(array $request, Session $session) {
		$manager = new QuizSessionManager(new QuizSession);
		$manager->request = $request;
		$manager->session = $session;
		$manager->quiz = Quiz::retrieveByPk(@$request['quiz_id']);
		return $manager;
	}

	/**
	 * @param	QuizSession		$quiz_session
	 * @return	QuizSessionManager
	 */
	static function hydrate(QuizSession $quiz_session) {
		return new QuizSessionManager($quiz_session);
	}

}
