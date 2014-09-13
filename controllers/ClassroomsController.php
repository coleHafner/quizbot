<?php

class ClassroomsController extends LoggedInApplicationController {

	/**
	 * Returns all Classroom records matching the query. Examples:
	 * GET /classrooms?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/classrooms.json&limit=5
	 *
	 * @return Classroom[]
	 */
	function index() {
		$q = null;

		if (!App::hasPerm(Perm::REACTIVATE)) {
			$q = Query::create()->add(Classroom::ARCHIVED, null);
		}

		$q = Classroom::getQuery(@$_GET, $q);

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'Classroom';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}

		$this['classrooms'] = $this['pager']->fetchPage();
	}

	/**
	 * Form to create or edit a Classroom. Example:
	 * GET /classrooms/edit/1
	 *
	 * @return Classroom
	 */
	function edit($id = null) {
		$this['teachers'] = User::doSelect();
		return $this->getClassroom($id)->fromArray(@$_GET);
	}

	/**
	 * Saves a Classroom. Examples:
	 * POST /classrooms/save/1
	 * POST /rest/classrooms/.json
	 * PUT /rest/classrooms/1.json
	 */
	function save($id = null) {
		$classroom = $this->getClassroom($id);

		try {
			$classroom->fromArray($_REQUEST);

			if ($session = App::getSession()) {
				$classroom->setSession($session);
			}

			if ($classroom->validate()) {
				$classroom->save();
				$teacher = !empty($_REQUEST['teacher_id']) ? User::retrieveByPk($_REQUEST['teacher_id']) : null;

				if ($teacher && !$teacher->hasClassroom($classroom)) {
					$teacher->addRole(Role::TEACHER, App::getSession(), $classroom->getId());
				}

				$this->flash['messages'][] = 'Classroom saved';
				$this->redirect('classrooms/show/' . $classroom->getId());
			}
			$this->flash['errors'] = $classroom->getValidationErrors();
		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$this->redirect('classrooms/edit/' . $classroom->getId() . '?' . http_build_query($_REQUEST));
	}

	/**
	 * Returns the Classroom with the id. Examples:
	 * GET /classrooms/show/1
	 * GET /rest/classrooms/1.json
	 *
	 * @return Classroom
	 */
	function show($id = null) {
		return $this->getClassroom($id);
	}

	/**
	 * Deletes the Classroom with the id. Examples:
	 * GET /classrooms/delete/1
	 * DELETE /rest/classrooms/1.json
	 */
	function delete($id = null) {
		$classroom = $this->getClassroom($id);

		try {
			if (null !== $classroom && $classroom->delete()) {
				$this['messages'][] = 'Classroom deleted';
			} else {
				$this['errors'][] = 'Classroom could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect('classrooms');
		}
	}

	/**
	 * @return Classroom
	 */
	private function getClassroom($id = null) {
		// look for id in param or in $_REQUEST array
		if (null === $id && isset($_REQUEST[Classroom::getPrimaryKey()])) {
			$id = $_REQUEST[Classroom::getPrimaryKey()];
		}



		if ('' === $id || null === $id) {
			// if no primary key provided, create new Classroom
			$this['room'] = new Classroom;
		} else {
			// if primary key provided, retrieve the record from the db
			$this['room'] = Classroom::retrieveByPK($id);
		}

		error_log('classroom id: ' . $this['room']->getId() . ' name: ' . $this['room']->getName());
		return $this['room'];
	}

}