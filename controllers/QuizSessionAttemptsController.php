<?php

class QuizSessionAttemptsController extends LoggedInApplicationController {

	/**
	 * Returns all QuizSessionAttempt records matching the query. Examples:
	 * GET /quiz-session-attempts?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/quiz-session-attempts.json&limit=5
	 *
	 * @return QuizSessionAttempt[]
	 */
	function index() {
		$q = QuizSessionAttempt::getQuery(@$_GET);
		$this['quiz'] = !empty($_REQUEST['quiz_id']) ? Quiz::retrieveByPk($_REQUEST['quiz_id']) : null;

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'QuizSessionAttempt';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}
		return $this['quiz_session_attempts'] = $this['pager']->fetchPage();
	}

	/**
	 * Form to create or edit a QuizSessionAttempt. Example:
	 * GET /quiz-session-attempts/edit/1
	 *
	 * @return QuizSessionAttempt
	 */
	function edit($id = null) {
		return $this->getQuizSessionAttempt($id)->fromArray(@$_GET);
	}

	/**
	 * Saves a QuizSessionAttempt. Examples:
	 * POST /quiz-session-attempts/save/1
	 * POST /rest/quiz-session-attempts/.json
	 * PUT /rest/quiz-session-attempts/1.json
	 */
	function save($id = null) {
		$quiz_session_attempt = $this->getQuizSessionAttempt($id);

		try {
			$quiz_session_attempt->fromArray($_REQUEST);
			if ($quiz_session_attempt->validate()) {
				$quiz_session_attempt->save();
				$this->flash['messages'][] = 'Quiz Session Attempt saved';
				$this->redirect('quiz-session-attempts/show/' . $quiz_session_attempt->getId());
			}
			$this->flash['errors'] = $quiz_session_attempt->getValidationErrors();
		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$this->redirect('quiz-session-attempts/edit/' . $quiz_session_attempt->getId() . '?' . http_build_query($_REQUEST));
	}

	/**
	 * Returns the QuizSessionAttempt with the id. Examples:
	 * GET /quiz-session-attempts/show/1
	 * GET /rest/quiz-session-attempts/1.json
	 *
	 * @return QuizSessionAttempt
	 */
	function show($id = null) {
		return $this->getQuizSessionAttempt($id);
	}

	/**
	 * Deletes the QuizSessionAttempt with the id. Examples:
	 * GET /quiz-session-attempts/delete/1
	 * DELETE /rest/quiz-session-attempts/1.json
	 */
	function delete($id = null) {
		$quiz_session_attempt = $this->getQuizSessionAttempt($id);

		try {
			if (null !== $quiz_session_attempt && $quiz_session_attempt->delete()) {
				$this['messages'][] = 'Quiz Session Attempt deleted';
			} else {
				$this['errors'][] = 'Quiz Session Attempt could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect('quiz-session-attempts');
		}
	}

	/**
	 * @return QuizSessionAttempt
	 */
	private function getQuizSessionAttempt($id = null) {
		// look for id in param or in $_REQUEST array
		if (null === $id && isset($_REQUEST[QuizSessionAttempt::getPrimaryKey()])) {
			$id = $_REQUEST[QuizSessionAttempt::getPrimaryKey()];
		}

		if ('' === $id || null === $id) {
			// if no primary key provided, create new QuizSessionAttempt
			$this['quiz_session_attempt'] = new QuizSessionAttempt;
		} else {
			// if primary key provided, retrieve the record from the db
			$this['quiz_session_attempt'] = QuizSessionAttempt::retrieveByPK($id);
		}
		return $this['quiz_session_attempt'];
	}

}