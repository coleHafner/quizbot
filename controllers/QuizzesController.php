<?php

class QuizzesController extends LoggedInApplicationController {

	/**
	 * Returns all Quiz records matching the query. Examples:
	 * GET /quizzes?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/quizzes.json&limit=5
	 *
	 * @return Quiz[]
	 */
	function index() {

		$q = Query::create();

		if (!App::hasPerm(Perm::REACTIVATE)) {
			$q->add(Quiz::ARCHIVED, null);
		}

		if (!App::isAdmin()) {

			if (!App::getClassroomId()) {
				throw new RuntimeException('Error: Classroom not defined.');
			}

			$q->add(Quiz::CLASSROOM_ID, App::getClassroomId());
		}

		$q = Quiz::getQuery(@$_GET, $q);

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'Quiz';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}
		return $this['quizzes'] = $this['pager']->fetchPage();
	}

	/**
	 * Form to create or edit a Quiz. Example:
	 * GET /quizzes/edit/1
	 *
	 * @return Quiz
	 */
	function edit($id = null) {
		return $this->getQuiz($id)->fromArray(@$_GET);
	}

	/**
	 * Saves a Quiz. Examples:
	 * POST /quizzes/save/1
	 * POST /rest/quizzes/.json
	 * PUT /rest/quizzes/1.json
	 */
	function save($id = null) {
		$quiz = $this->getQuiz($id);

		try {
			$quiz->fromArray($_REQUEST);
			$quiz->setSession(App::getSession());

			if ($quiz->validate()) {
				$quiz->save();
				$this->flash['messages'][] = 'Quiz saved';
				$this->redirect('quizzes/show/' . $quiz->getId());
			}
			$this->flash['errors'] = $quiz->getValidationErrors();
		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$this->redirect('quizzes/edit/' . $quiz->getId() . '?' . http_build_query($_REQUEST));
	}

	/**
	 * Returns the Quiz with the id. Examples:
	 * GET /quizzes/show/1
	 * GET /rest/quizzes/1.json
	 *
	 * @return Quiz
	 */
	function show($id = null) {
		return $this->getQuiz($id);
	}

	/**
	 * Deletes the Quiz with the id. Examples:
	 * GET /quizzes/delete/1
	 * DELETE /rest/quizzes/1.json
	 */
	function delete($id = null) {
		$quiz = $this->getQuiz($id);

		try {
			if (null !== $quiz && $quiz->delete()) {
				$this['messages'][] = 'Quiz deleted';
			} else {
				$this['errors'][] = 'Quiz could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect('quizzes');
		}
	}

	/**
	 * @return Quiz
	 */
	private function getQuiz($id = null) {
		// look for id in param or in $_REQUEST array
		if (null === $id && isset($_REQUEST[Quiz::getPrimaryKey()])) {
			$id = $_REQUEST[Quiz::getPrimaryKey()];
		}

		if ('' === $id || null === $id) {
			// if no primary key provided, create new Quiz
			$this['quiz'] = new Quiz;
		} else {
			// if primary key provided, retrieve the record from the db
			$this['quiz'] = Quiz::retrieveByPK($id);
		}
		return $this['quiz'];
	}

}