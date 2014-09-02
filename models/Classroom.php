<?php

class Classroom extends baseClassroom {

	/**
	 * @return	User
	 */
	function getTeacher() {

		$q = Query::create()
			->setTable(User::getTableName())
			->join(User::ID, UserRole::USER_ID)
			->add(UserRole::ROLE_ID, Role::TEACHER)
			->add(UserRole::CLASSROOM_ID, $this->getId())
			->add(User::ACTIVE, true);
		return User::doSelectOne($q);
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