<?php

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
			$this->setAllQuestions();
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
	 * @return	Quiz
	 */
	function getQuiz() {
		return $this->quiz;
	}

	/**
	 * @return	Question[]
	 */
	function getQuestions() {
		return $this->questions;
	}

	/**
	 * @return	QuizSessionQuestion[]
	 */
	function getSessionQuestions() {
		return $this->sessionQuestions;
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

	/**
	 * @param array $session
	 */
	function setQuiz(Quiz $quiz) {
		$this->quiz = $quiz;
	}

	/**
	 * Clears both question and sessionQuestions properties.
	 * @return boolean
	 */
	function clearAllQuestions() {
		$this->questions = array();
		$this->sessionQuestions = array();
		return true;
	}

	/**
	 * @return boolean
	 */
	function closeQuestionAtIndex($index) {
		return $this->modifyQuestionAtIndex($index, 'close');
	}

	/**
	 * @return boolean
	 */
	function openQuestionAtIndex($index) {
		return $this->modifyQuestionAtIndex($index, 'open');
	}

	/**
	 * @return	QuizSessionQuestion
	 */
	function getQuestionAtIndex($index) {
		$qsq = @$this->sessionQuestions[$index];
		return $qsq;
	}

	/**
	 * @return boolean
	 */
	function sessionIsOver() {
		$all_questions_closed = QuizSessionQuestion::doCount(Query::create()
			->add(QuizSessionQuestion::QUIZ_SESSION_ID, $this->getQuizSessionId())
			->add(QuizSessionQUestion::CLOSED, null)
		) == 0;

		return ($this->hasSessionQuestions() && $all_questions_closed);
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

		if ($qsq->isNew()) {
			$qsq->save();
		}

		$this->sessionQuestions[] = $qsq;
		return $qsq;
	}

	/**
	 * Sets questions and quiz questions.
	 */
	function setAllQuestions() {

		if (!$this->getQuiz()) {
			throw new RuntimeException('Error: Cannot set questions without quiz.');
		}

		$this->clearAllQuestions();
		$q = Query::create()->orderBy(Question::ID, Query::ASC);
		$q->add(Question::ARCHIVED, null);
		$this->questions = $this->getQuiz()->getQuestions($q);

		foreach ($this->questions as $q) {
			$this->addSessionQuestion($q);
		}
	}

	function getFirstUnclosedQuestionIndex() {
		foreach ($this->sessionQuestions as $index => $q) {
			if (!$q->isClosed()) {
				return $index;
			}
		}

		return false;
	}

	/**
	 * Either opens or closes the question at the index passed.
	 * Returns false if the question at index does not exist.
	 * @param	int			$index
	 * @param	string		$action		'open' or 'close'
	 * @return	boolean
	 */
	function modifyQuestionAtIndex($index, $action) {

		$qsq = $qsq = $this->getQuestionAtIndex($index);

		if ($qsq) {
			$outcome = $action == 'close' ? $qsq->close() : $qsq->open();
			$qsq->save();
			return true;
		}

		return false;
	}

	/**
	 * @return	int
	 */
	function getNumQuestions() {
		return count($this->questions);
	}

	/**
	 * @return	boolean
	 */
	private function hasSessionQuestions() {
		return QuizSessionQuestion::doCount(Query::create()
			->add(QuizSessionQuestion::QUIZ_SESSION_ID, $this->getQuizSessionId())
		) > 0;
	}

	/**
	 * @param	array		$request
	 * @param	Session		$session
	 * @return	QuizSessionManager
	 */
	static function create(array $request, Session $session) {
		$manager = new QuizSessionManager(new QuizSession);
		$manager->setRequest($request);
		$manager->setSession($session);

		if (!empty($manager->request['quiz_id'])) {
			$quiz = Quiz::retrieveByPk($request['quiz_id']);
			$manager->setQuiz($quiz);
		}

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
