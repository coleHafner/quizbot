<?php

class UsersController extends LoggedInApplicationController {

	/**
	 * Returns all User records matching the query. Examples:
	 * GET /users?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/users.json&limit=5
	 *
	 * @return User[]
	 */
	function index() {

		$q = null;

		if (!App::hasPerm(Perm::REACTIVATE)) {
			$q = Query::create()->add(User::ACTIVE, true);
		}

		$q = User::getQuery(@$_GET, $q);

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'User';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}
		return $this['users'] = $this['pager']->fetchPage();
	}

	/**
	 * Form to create or edit a User. Example:
	 * GET /users/edit/1
	 *
	 * @return User
	 */
	function edit($id = null) {
		return $this->getUser($id)->fromArray(@$_GET);
	}

	/**
	 * Saves a User. Examples:
	 * POST /users/save/1
	 * POST /rest/users/.json
	 * PUT /rest/users/1.json
	 */
	function save($id = null) {
		$user = $this->getUser($id);
		$conn = User::getConnection();
		$conn->beginTransaction();

		try {
			$user->fromArray($_REQUEST);

			if ($user->isNew()) {
				$user->setSalt(User::generateSalt());
				$user->setSession(App::getSession());

				if (empty($_REQUEST['password1']) || empty($_REQUEST['password2'])) {
					$this->flash['errors'][] = 'You must define a password';
				}
			}

			if (empty($this->flash['errors'])
				&& (!empty($_REQUEST['password1']) || !empty($_REQUEST['password2']))
				&& ($_REQUEST['password1'] != $_REQUEST['password2'])) {
				print_r($_REQUEST);die;
				$this->flash['errors'][] = 'Passwords do not match.';
			}

			if (empty($this->flash['errors'])
				&& (!empty($_REQUEST['password1']) || !empty($_REQUEST['password2']))) {
				$user->setPassword(User::encryptPassword($_REQUEST['password1'], $user->getSalt()));
			}

			if (empty($this->flash['errors'])) {
				$user->validate();
				$this->flash['errors'] = $user->getValidationErrors();
			}

			if (empty($this->flash['errors'])) {
				$user->save();

				if (App::hasPerm(Perm::USER_EDIT_ROLE) && !empty($_REQUEST['roles']['id'])) {

					$user->clearRoles();
					$i = 0;

					foreach ($_REQUEST['roles']['id'] as $id) {
						$classroom_id = @$_REQUEST['roles']['classroom'][$i];

						if (Role::requiresClassroom($id) && !$classroom_id) {
							throw new RuntimeException('Role ' . Role::getLabel($id) . '" requires a classroom specification.');
						}

						$user->addRole($id, App::getSession(), $classroom_id);
						$i++;
					}
				}

				$conn->commit();
				$this->flash['messages'][] = 'User saved';
				$this->redirect('users/show/' . $user->getId());
			}

		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$conn->rollBack();
		$this->redirect('users/edit/' . $user->getId() . '?' . http_build_query($_REQUEST));
	}

	/**
	 * Returns the User with the id. Examples:
	 * GET /users/show/1
	 * GET /rest/users/1.json
	 *
	 * @return User
	 */
	function show($id = null) {
		return $this->getUser($id);
	}

	/**
	 * Deletes the User with the id. Examples:
	 * GET /users/delete/1
	 * DELETE /rest/users/1.json
	 */
	function delete($id = null) {
		$user = $this->getUser($id);

		try {
			if (null !== $user && $user->delete()) {
				$this['messages'][] = 'User deleted';
			} else {
				$this['errors'][] = 'User could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect('users');
		}
	}

	/**
	 * @return User
	 */
	private function getUser($id = null) {
		// look for id in param or in $_REQUEST array
		if (null === $id && isset($_REQUEST[User::getPrimaryKey()])) {
			$id = $_REQUEST[User::getPrimaryKey()];
		}

		if ('' === $id || null === $id) {
			// if no primary key provided, create new User
			$this['user'] = new User;
		} else {
			// if primary key provided, retrieve the record from the db
			$this['user'] = User::retrieveByPK($id);
		}
		return $this['user'];
	}

}