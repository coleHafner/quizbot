<?php

class QuestionsController extends LoggedInApplicationController {

	public function __construct(ControllerRoute $route = null) {
		parent::__construct($route);
	}

	/**
	 * Returns all Question records matching the query. Examples:
	 * GET /questions?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/questions.json&limit=5
	 *
	 * @return Question[]
	 */
	function index() {

		$q = null;

		if (!App::hasPerm(Perm::REACTIVATE)) {
			$q = Query::create()->add(Question::ARCHIVED, null);
		}

		$q = Question::getQuery(@$_GET, $q);

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'Question';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}
		return $this['questions'] = $this['pager']->fetchPage();
	}

	/**
	 * Form to create or edit a Question. Example:
	 * GET /questions/edit/1
	 *
	 * @return Question
	 */
	function edit($id = null) {
		$q = $this->getQuestion($id);
		$this['question'] = $q->fromArray(@$_GET);
		$this['quiz_id'] = $q->getQuizId();
		$this['answers'] = !empty($_REQUEST['answers']) ? $_REQUEST['answers'] : array();

		if (!$this['quiz_id'] && !empty($_REQUEST['quiz_id'])) {
			$this['quiz_id'] = $_REQUEST['quiz_id'];
		}
	}

	/**
	 * Saves a Question. Examples:
	 * POST /questions/save/1
	 * POST /rest/questions/.json
	 * PUT /rest/questions/1.json
	 */
	function save($id = null) {

		if ($this['quiz'] && !App::can(Perm::ACTION_EDIT, $this['quiz'])) {
			$this->flash['errors'][] = 'You are not allowed to add questions to this quiz.';
			$this->redirect('quizzes');
		}

		$question = $this->getQuestion($id);
		$new = $question->isNew();
		$conn = Question::getConnection();
		$conn->beginTransaction();

		try {
			$question->fromArray($_REQUEST);

			if ($new) {
				$question->setSession(App::getSession());
			}

			$validated = $question->validate();
			$this->flash['errors'] = $question->getValidationErrors();

			if ($question->isMultipleChoice()) {
				$answers = 0;

				foreach ($_REQUEST['answers'] as $id => $answer_text) {
					if (empty($answer_text)) {
						continue;
					}

					$answers++;
				}

				if ($answers < 2) {
					$this->flash['errors'][] = 'You must define at least two answers.';
				}
			}

			if ($validated && empty($this->flash['errors'])) {
				$question->save();

				if ($question->isMultipleChoice()) {

					if (!$new) {

						//only exclude answers that are new
						$exclude_ids = array_map(function($id) {
							if (strpos($id, 'n') === false) {
								return $id;
							}
						}, array_keys($_REQUEST['answers']));

						$question->clearAnswers($exclude_ids);
					}

					$correct_answer_id = null;
					$i = 1;

					foreach ($_REQUEST['answers'] as $id => $answer_text) {

						if (empty($answer_text)) {
							continue;
						}

						$qa = strpos($id, 'n') !== false ? new QuestionAnswer() : QuestionAnswer::retrieveByPK($id);
						$qa->setText($answer_text);
						$qa->setQuestionId($question->getId());
						$qa->setPriority($i);

						if ($qa->isNew()) {
							$qa->setSession(App::getSession());
						}

						$qa->save();

						if ($i == $_REQUEST['correct_answer']) {
							$correct_answer_id = $qa->getId();
						}

						$i++;
					}

					if ($correct_answer_id === null) {
						throw new RuntimeException('Error: No correct answer selected for question "' . $question->getText() . '"');
					}

					$question->setCorrectAnswerId($correct_answer_id);
				}

				if($question->isTrueFalse()) {
					$question->setCorrectAnswerBoolean($_REQUEST['correct_answer_bool']);
				}

				$question->save();
				$this->flash['messages'][] = 'Question saved';
				$go_to = 'questions/show/' . $question->getId();

				if ($this['quiz'] instanceof Quiz) {
					$go_to = 'questions/edit?quiz_id=' . $this['quiz']->getId();
				}

				$conn->commit();
				$this->redirect($go_to);
			}

		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$conn->rollBack();
		$this->redirect('questions/edit/' . $question->getId() . '?' . http_build_query($_REQUEST));
	}

	/**
	 * Returns the Question with the id. Examples:
	 * GET /questions/show/1
	 * GET /rest/questions/1.json
	 *
	 * @return Question
	 */
	function show($id = null) {
		return $this->getQuestion($id);
	}

	/**
	 * Deletes the Question with the id. Examples:
	 * GET /questions/delete/1
	 * DELETE /rest/questions/1.json
	 */
	function delete($id = null) {
		$question = $this->getQuestion($id);

		try {
			if (null !== $question && $question->delete()) {
				$this['messages'][] = 'Question deleted';
			} else {
				$this['errors'][] = 'Question could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect('questions');
		}
	}

	/**
	 * @return Question
	 */
	private function getQuestion($id = null) {
		// look for id in param or in $_REQUEST array
		if (null === $id && isset($_REQUEST[Question::getPrimaryKey()])) {
			$id = $_REQUEST[Question::getPrimaryKey()];
		}

		if ('' === $id || null === $id) {
			// if no primary key provided, create new Question
			$this['question'] = new Question;
		} else {
			// if primary key provided, retrieve the record from the db
			$this['question'] = Question::retrieveByPK($id);
		}
		return $this['question'];
	}

}