<?php

class QuizSessionsController extends LoggedInApplicationController {

	public function index() {
		$q = Query::create();
		$q->join(QuizSession::QUIZ_ID, Quiz::ID);
		$q->add(Quiz::CLASSROOM_ID, App::getClassroomId());
		$q->orderBy(QuizSession::OPENED, Query::DESC);
		$q = QuizSession::getQuery(@$_GET, $q);
		$quiz = !empty($_REQUEST['quiz_id']) ? Quiz::retrieveByPK($_REQUEST['quiz_id']) : null;

		if ($quiz && App::can(Perm::ACTION_EDIT, $quiz)) {
			$q->add(QuizSession::QUIZ_ID, $quiz->getId());
			$q->add(QuizSession::CLOSED, null, Query::IS_NOT_NULL);
		}

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'QuizSession';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}

		return $this['quiz_sessions'] = $this['pager']->fetchPage();
	}

	public function edit($id = null) {

		$quiz_session = $id ? QuizSession::retrieveByPk($id) : null;

		if ($quiz_session) {
			$manager = new QuizSessionManager($quiz_session);
		}else {
			$manager = QuizSessionManager::create($_REQUEST, App::getSession(), $id);
		}

		$this['quizzes'] = App::getClassroom()->getQuizzesEligibleForSession();
		$this['quiz_session'] = $manager->getQuizSession()->fromArray($_REQUEST);
	}

	function show($id, $do_resume = false) {
		$manager = $this->_getSessionManager($id);
		$this['quiz_session'] = $manager->getQuizSession();
		$this['do_resume'] = $do_resume;
	}

	function start($id, $resume = false) {
		$manager = $this->_getSessionManager($id);
		$manager->setAllQuestions();
		$resume = (int) $resume;
		$index = App::setQuizSessionIndex(0);
		$this->redirect(site_url('quiz-sessions/switch-question/' . $manager->getQuizSessionId() . '/next/' . $resume));
	}

	function switchQuestion($id, $direction = 'next', $resume = false) {

		$manager = $this->_getSessionManager($id);

		if ($resume == true) {
			$index = $manager->getFirstUnclosedQuestionIndex();
		}else {

			$index = App::getQuizSessionIndex();

			if ($index < 0) {
				$index = 0;
			}

			$manager->closeQuestionAtIndex($index);
			$index = $direction == 'prev' ? $index - 1 : $index + 1;
		}

		$is_last_question = $index > $manager->getNumQuestions();

		if (($is_last_question && $manager->sessionIsOver())) {
			$this->redirect(site_url('quiz-sessions/results/' . $manager->getQuizSessionId()));
		}

		$session_question = $manager->getQuestionAtIndex($index);
		$question = $session_question->getQuestion();
		App::setQuizSessionIndex($index);
		$manager->openQuestionAtIndex($index);
		$this->redirect(site_url('quiz-sessions/question/' . $manager->getQuizSessionId() . '/' . $question->getId()));
	}

	function question($session_id, $question_id) {
		$manager = $this->_getSessionManager($session_id);
		$question = Question::retrieveByPk($question_id);

		if (!$question) {
			throw new RuntimeException('Error: QUestion with id #' . $question_id . ' does not exist.');
		}

		$i = App::getQuizSessionIndex();
		$this['prev_question'] = $manager->getQuestionAtIndex($i - 1);
		$this['next_question'] = $manager->getQuestionAtIndex($i + 1);
		$this['quiz_session'] = $manager->getQuizSession();
		$this['question_num'] = ($i + 1);
		$this['question'] = $question;
		$this['answers'] = $question->getAnswers();
	}

	function results($id) {
		$quiz_session = QuizSession::retrieveByPk($id);

		if (!$quiz_session) {
			throw new RuntimeException('Error: Quiz session with id "' . $id . '" does not exist.');
		}

		$quiz_session->close();
		$this['results'] = $quiz_session->getPercentageCorrect();
	}

	/**
	 * Saves a QuizSessionAttempt. Examples:
	 * POST /quiz-session-attempts/save/1
	 * POST /rest/quiz-session-attempts/.json
	 * PUT /rest/quiz-session-attempts/1.json
	 */
	function save($id = null) {
		$conn = QuizSession::getConnection();
		$conn->beginTransaction();

		try {
			$id = !$id ? @$_REQUEST[QuizSession::getPrimaryKey()] : $id;

			if (!empty($id)) {
				$manager = $this->_getSessionManager($id);
				$manager->setRequest($_REQUEST);
				$manager->setSession(App::getSession());
			}else {
				$manager = QuizSessionManager::create($_REQUEST, App::getSession());
			}

			if ($manager->validate()) {
				$manager->save();
				$conn->commit();
				$this->redirect(site_url('quiz-sessions/show/' . $manager->getQuizSessionId()));
			}

			$this->flash['errors'] = $manager->getValidationErrors();

		}catch(Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$conn->rollback();
		$this->redirect(site_url('quiz-sessions/edit') . '?' . http_build_query($_REQUEST));
	}

	/**
	 * @param	int			$id		id of the current quiz_session
	 * @return	QuizSessionManager
	 * @throws	RuntimeException
	 */
	private function _getSessionManager($id) {
		$quiz_session = QuizSession::retrieveByPk($id);

		if (!$quiz_session) {
			throw new RuntimeException('Error: Quiz session with id "' . $id . '" does not exist.');
		}

		$this['manager'] = QuizSessionManager::hydrate($quiz_session);
		return $this['manager'];
	}

}