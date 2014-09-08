<?php

class UsersController extends LoggedInApplicationController {

	function __construct(ControllerRoute $route = null) {
		$type = strtolower(str_replace('Controller', '', get_class($this)));
		$this['view_dir'] = $type;
		$this['user_type'] = ucfirst(substr($type, 0, (strlen($type) - 1)));
		parent::__construct($route);
	}

	/**
	 * Returns all User records matching the query. Examples:
	 * GET /users?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/users.json&limit=5
	 *
	 * @return User[]
	 */
	function index() {

		$q = $this->getQuery();

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
		$new = $user->isNew();
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
				$this->flash['errors'][] = 'Passwords do not match.';
			}

			if (empty($this->flash['errors'])
				&& (!empty($_REQUEST['password1']) || !empty($_REQUEST['password2']))) {
				$user->setPassword(User::encryptPassword($_REQUEST['password1'], $user->getSalt()));
			}

			if (!App::hasPerm(Perm::USER_EDIT_TYPE)) {
				$user->setType(User::TYPE_USER);
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
				}else if ($new) {

					$role_id = null;

					switch($this['user_type']) {
						case 'Student':
							$role_id = Role::STUDENT;
							break;

						case 'Teacher':
							$role_id = Role::TEACHER;
							break;
					}

					if ($role_id === null || !App::getClassroomId()) {
						$user = new User;
						throw new RuntimeException('Error: No classroom or user type defined.');
					}

					$user->addRole($role_id, App::getSession(), App::getClassroomId());
				}

				$conn->commit();
				$this->flash['messages'][] = 'User saved';
				$this->redirect($this['view_dir'] . '/show/' . $user->getId());
			}

		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

//		print_r($this->flash['errors']);
//		print_r($user);die;
		$conn->rollBack();
		$this->redirect($this['view_dir'] . '/edit/' . $user->getId() . '?' . http_build_query($_REQUEST));
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

	function getQuery() {

		$q = User::getQuery($_GET);

		if (!App::hasPerm(Perm::REACTIVATE)) {
			$q->add(User::ARCHIVED, null);
		}

		return $q;
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