<?php

class QuizSessionsController extends LoggedInApplicationController {

	public function index() {
		$q = Query::create();
		$q->join(QuizSession::QUIZ_ID, Quiz::ID);
		$q->add(Quiz::CLASSROOM_ID, App::getClassroomId());
		$q = QuizSession::getQuery(@$_GET, $q);
		$quiz = !empty($_REQUEST['quiz_id']) ? Quiz::retrieveByPK($_REQUEST['quiz_id']) : null;

		if ($quiz && App::can(Perm::ACTION_EDIT, $quiz)) {
			$q->add(QuizSession::QUIZ_ID, $quiz->getId());
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

		$this['quiz_session'] = $manager->getQuizSession()->fromArray($_REQUEST);
	}

	function show($id, $do_resume = false) {
		$manager = $this->_getSessionManager($id);
		$this['quiz_session'] = $manager->getQuizSession();
		$this['do_resume'] = $do_resume;
	}

	function question($id, $action) {

		$manager = $this->_getSessionManager($id);
		$manager->closeLastQuestion();

		$question = $manager->getPrevQuestion();

		if ($action == 'next') {
			$question = $manager->getNextQuestion();
		}

		if ($action == 'next' && !$question && $manager->sessionIsOver()) {
			$this->redirect(site_url('quiz-sessions/end') . '/' . $manager->getQuizSessionId());
		}

		$manager->addSessionQuestion($question);
		$this['question'] = $question;
		$this['quiz_session'] = $manager->getQuizSession();
	}

	function end($id) {
		$quiz_session = QuizSession::retrieveByPk($id);

		if (!$quiz_session) {
			throw new RuntimeException('Error: Quiz session with id "' . $id . '" does not exist.');
		}

		$quiz_session->close();
		$this['results'] = $quiz_session->getResults();
	}

	function results($id) {
		$quiz_session = QuizSession::retrieveByPk($id);

		if (!$quiz_session) {
			throw new RuntimeException('Error: Quiz session with id "' . $id . '" does not exist.');
		}

		$quiz_session->close();
		$this['results'] = $quiz_session->getResults();
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