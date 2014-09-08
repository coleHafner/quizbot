<?php

class Classroom extends baseClassroom {

	/**
	 * @return	User[]
	 */
	function getTeacher() {
		return User::doSelectOne($this->getTeachersQuery());
	}

	/**
	 * @return	User[]
	 */
	function getStudents() {
		return User::doSelect($this->getStudentsQuery());

	}

	/**
	 * @return	Query
	 */
	function getTeachersQuery() {
		return $this->getUserRolesQuery(Query::create()->add(UserRole::ROLE_ID, Role::TEACHER));
	}

	/**
	 * @return	Query
	 */
	function getStudentsQuery() {
		return $this->getUserRolesQuery(Query::create()->add(UserRole::ROLE_ID, Role::STUDENT));
	}

	/**
	 * @param	Query	$q		optional
	 * @return	Query
	 */
	function getUserRolesQuery(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$q->join(User::ID, UserRole::USER_ID);
		$q->add(User::ARCHIVED, null);
		return parent::getUserRolesQuery($q);
	}

	/**
	 * @return	Quiz[]
	 */
	function getQuizzes() {
		$q = Query::create()
			->add(Quiz::CLASSROOM_ID, $this->getId())
			->orderBy(Quiz::NAME, Query::ASC);
		
		return Quiz::doSelect($q);
	}

	function __toString() {
		return $this->getName();
	}

	/**
	 * @return	Classroom[]
	 */
	static function getActive() {
		return self::doSelect(Query::create()->add(Classroom::ARCHIVED, null));
	}
}