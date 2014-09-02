<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseClassroom extends ApplicationModel {

	const ID = 'classroom.id';
	const SESSION_ID = 'classroom.session_id';
	const NAME = 'classroom.name';
	const ARCHIVED = 'classroom.archived';
	const CREATED = 'classroom.created';
	const UPDATED = 'classroom.updated';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'classroom';

	/**
	 * Cache of objects retrieved from the database
	 * @var Classroom[]
	 */
	protected static $_instancePool = array();

	protected static $_instancePoolCount = 0;

	protected static $_poolEnabled = true;

	/**
	 * Array of objects to batch insert
	 */
	protected static $_insertBatch = array();

	/**
	 * Maximum size of the insert batch
	 */
	protected static $_insertBatchSize = 500;

	/**
	 * Array of all primary keys
	 * @var string[]
	 */
	protected static $_primaryKeys = array(
		'id',
	);

	/**
	 * string name of the primary key column
	 * @var string
	 */
	protected static $_primaryKey = 'id';

	/**
	 * true if primary key is an auto-increment column
	 * @var bool
	 */
	protected static $_isAutoIncrement = true;

	/**
	 * array of all fully-qualified(table.column) columns
	 * @var string[]
	 */
	protected static $_columns = array(
		Classroom::ID,
		Classroom::SESSION_ID,
		Classroom::NAME,
		Classroom::ARCHIVED,
		Classroom::CREATED,
		Classroom::UPDATED,
	);

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'id',
		'session_id',
		'name',
		'archived',
		'created',
		'updated',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => Model::COLUMN_TYPE_INTEGER,
		'session_id' => Model::COLUMN_TYPE_INTEGER,
		'name' => Model::COLUMN_TYPE_VARCHAR,
		'archived' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'created' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
		'updated' => Model::COLUMN_TYPE_INTEGER_TIMESTAMP,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `session_id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $session_id;

	/**
	 * `name` VARCHAR NOT NULL
	 * @var string
	 */
	protected $name;

	/**
	 * `archived` INTEGER_TIMESTAMP DEFAULT ''
	 * @var int
	 */
	protected $archived;

	/**
	 * `created` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $created;

	/**
	 * `updated` INTEGER_TIMESTAMP NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $updated;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Classroom
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the session_id field
	 */
	function getSessionId() {
		return $this->session_id;
	}

	/**
	 * Sets the value of the session_id field
	 * @return Classroom
	 */
	function setSessionId($value) {
		return $this->setColumnValue('session_id', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Convenience function for Classroom::getSessionId
	 * final because getSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Classroom::getSessionId
	 */
	final function getSession_id() {
		return $this->getSessionId();
	}

	/**
	 * Convenience function for Classroom::setSessionId
	 * final because setSessionId should be extended instead
	 * to ensure consistent behavior
	 * @see Classroom::setSessionId
	 * @return Classroom
	 */
	final function setSession_id($value) {
		return $this->setSessionId($value);
	}

	/**
	 * Gets the value of the name field
	 */
	function getName() {
		return $this->name;
	}

	/**
	 * Sets the value of the name field
	 * @return Classroom
	 */
	function setName($value) {
		return $this->setColumnValue('name', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the archived field
	 */
	function getArchived($format = 'Y-m-d H:i:s') {
		if (null === $this->archived || null === $format) {
			return $this->archived;
		}
		return date($format, $this->archived);
	}

	/**
	 * Sets the value of the archived field
	 * @return Classroom
	 */
	function setArchived($value) {
		return $this->setColumnValue('archived', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the created field
	 */
	function getCreated($format = 'Y-m-d H:i:s') {
		if (null === $this->created || null === $format) {
			return $this->created;
		}
		return date($format, $this->created);
	}

	/**
	 * Sets the value of the created field
	 * @return Classroom
	 */
	function setCreated($value) {
		return $this->setColumnValue('created', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * Gets the value of the updated field
	 */
	function getUpdated($format = 'Y-m-d H:i:s') {
		if (null === $this->updated || null === $format) {
			return $this->updated;
		}
		return date($format, $this->updated);
	}

	/**
	 * Sets the value of the updated field
	 * @return Classroom
	 */
	function setUpdated($value) {
		return $this->setColumnValue('updated', $value, Model::COLUMN_TYPE_INTEGER_TIMESTAMP);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_connection');
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Classroom
	 */
	 static function retrieveByPK($id) {
		return static::retrieveByPKs($id);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Classroom
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		if (static::$_poolEnabled) {
			$pool_instance = static::retrieveFromPool($id);
			if (null !== $pool_instance) {
				return $pool_instance;
			}
		}
		$q = new Query;
		$q->add('id', $id);
		return static::doSelectOne($q);
	}

	/**
	 * Searches the database for a row with a id
	 * value that matches the one provided
	 * @return Classroom
	 */
	static function retrieveById($value) {
		return Classroom::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a session_id
	 * value that matches the one provided
	 * @return Classroom
	 */
	static function retrieveBySessionId($value) {
		return static::retrieveByColumn('session_id', $value);
	}

	/**
	 * Searches the database for a row with a name
	 * value that matches the one provided
	 * @return Classroom
	 */
	static function retrieveByName($value) {
		return static::retrieveByColumn('name', $value);
	}

	/**
	 * Searches the database for a row with a archived
	 * value that matches the one provided
	 * @return Classroom
	 */
	static function retrieveByArchived($value) {
		return static::retrieveByColumn('archived', $value);
	}

	/**
	 * Searches the database for a row with a created
	 * value that matches the one provided
	 * @return Classroom
	 */
	static function retrieveByCreated($value) {
		return static::retrieveByColumn('created', $value);
	}

	/**
	 * Searches the database for a row with a updated
	 * value that matches the one provided
	 * @return Classroom
	 */
	static function retrieveByUpdated($value) {
		return static::retrieveByColumn('updated', $value);
	}


	/**
	 * Casts values of int fields to (int)
	 * @return Classroom
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->session_id = (null === $this->session_id) ? null : (int) $this->session_id;
		$this->archived = (null === $this->archived) ? null : (int) $this->archived;
		$this->created = (null === $this->created) ? null : (int) $this->created;
		$this->updated = (null === $this->updated) ? null : (int) $this->updated;
		return $this;
	}

	/**
	 * @return Classroom
	 */
	function setSession(Session $session = null) {
		return $this->setSessionRelatedBySessionId($session);
	}

	/**
	 * @return Classroom
	 */
	function setSessionRelatedBySessionId(Session $session = null) {
		if (null === $session) {
			$this->setsession_id(null);
		} else {
			if (!$session->getid()) {
				throw new Exception('Cannot connect a Session without a id');
			}
			$this->setsession_id($session->getid());
		}
		return $this;
	}

	/**
	 * Returns a session object with a id
	 * that matches $this->session_id.
	 * @return Session
	 */
	function getSession() {
		return $this->getSessionRelatedBySessionId();
	}

	/**
	 * Returns a session object with a id
	 * that matches $this->session_id.
	 * @return Session
	 */
	function getSessionRelatedBySessionId() {
		$fk_value = $this->getsession_id();
		if (null === $fk_value) {
			return null;
		}
		return Session::retrieveByPK($fk_value);
	}

	static function doSelectJoinSession(Query $q = null, $join_type = Query::LEFT_JOIN) {
		return static::doSelectJoinSessionRelatedBySessionId($q, $join_type);
	}

	/**
	 * @return Classroom[]
	 */
	static function doSelectJoinSessionRelatedBySessionId(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : static::getTableName();
		if (!$columns) {
			if ($alias) {
				foreach (static::getColumns() as $column_name) {
					$columns[] = $alias . '.' . $column_name;
				}
			} else {
				$columns = static::getColumns();
			}
		}

		$to_table = Session::getTableName();
		$q->join($to_table, $this_table . '.session_id = ' . $to_table . '.id', $join_type);
		foreach (Session::getColumns() as $column) {
			$columns[] = $column;
		}
		$q->setColumns($columns);

		return static::doSelect($q, array('Session'));
	}

	/**
	 * @return Classroom[]
	 */
	static function doSelectJoinAll(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : static::getTableName();
		if (!$columns) {
			if ($alias) {
				foreach (static::getColumns() as $column_name) {
					$columns[] = $alias . '.' . $column_name;
				}
			} else {
				$columns = static::getColumns();
			}
		}

		$to_table = Session::getTableName();
		$q->join($to_table, $this_table . '.session_id = ' . $to_table . '.id', $join_type);
		foreach (Session::getColumns() as $column) {
			$columns[] = $column;
		}
		$classes[] = 'Session';
	
		$q->setColumns($columns);
		return static::doSelect($q, $classes);
	}

	/**
	 * Returns a Query for selecting device Objects(rows) from the device table
	 * with a classroom_id that matches $this->id.
	 * @return Query
	 */
	function getDevicesRelatedByClassroomIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('device', 'classroom_id', 'id', $q);
	}

	/**
	 * Returns the count of Device Objects(rows) from the device table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function countDevicesRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Device::doCount($this->getDevicesRelatedByClassroomIdQuery($q));
	}

	/**
	 * Deletes the device Objects(rows) from the device table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function deleteDevicesRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->DevicesRelatedByClassroomId_c = array();
		return Device::doDelete($this->getDevicesRelatedByClassroomIdQuery($q));
	}

	protected $DevicesRelatedByClassroomId_c = array();

	/**
	 * Returns an array of Device objects with a classroom_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Device[]
	 */
	function getDevicesRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->DevicesRelatedByClassroomId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->DevicesRelatedByClassroomId_c;
		}

		$result = Device::doSelect($this->getDevicesRelatedByClassroomIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->DevicesRelatedByClassroomId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting quiz Objects(rows) from the quiz table
	 * with a classroom_id that matches $this->id.
	 * @return Query
	 */
	function getQuizsRelatedByClassroomIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz', 'classroom_id', 'id', $q);
	}

	/**
	 * Returns the count of Quiz Objects(rows) from the quiz table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function countQuizsRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Quiz::doCount($this->getQuizsRelatedByClassroomIdQuery($q));
	}

	/**
	 * Deletes the quiz Objects(rows) from the quiz table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function deleteQuizsRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->QuizsRelatedByClassroomId_c = array();
		return Quiz::doDelete($this->getQuizsRelatedByClassroomIdQuery($q));
	}

	protected $QuizsRelatedByClassroomId_c = array();

	/**
	 * Returns an array of Quiz objects with a classroom_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Quiz[]
	 */
	function getQuizsRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->QuizsRelatedByClassroomId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->QuizsRelatedByClassroomId_c;
		}

		$result = Quiz::doSelect($this->getQuizsRelatedByClassroomIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->QuizsRelatedByClassroomId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting session Objects(rows) from the session table
	 * with a classroom_id that matches $this->id.
	 * @return Query
	 */
	function getSessionsRelatedByClassroomIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('session', 'classroom_id', 'id', $q);
	}

	/**
	 * Returns the count of Session Objects(rows) from the session table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function countSessionsRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return Session::doCount($this->getSessionsRelatedByClassroomIdQuery($q));
	}

	/**
	 * Deletes the session Objects(rows) from the session table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function deleteSessionsRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->SessionsRelatedByClassroomId_c = array();
		return Session::doDelete($this->getSessionsRelatedByClassroomIdQuery($q));
	}

	protected $SessionsRelatedByClassroomId_c = array();

	/**
	 * Returns an array of Session objects with a classroom_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return Session[]
	 */
	function getSessionsRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->SessionsRelatedByClassroomId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->SessionsRelatedByClassroomId_c;
		}

		$result = Session::doSelect($this->getSessionsRelatedByClassroomIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->SessionsRelatedByClassroomId_c = $result;
		}
		return $result;
	}

	/**
	 * Returns a Query for selecting user_role Objects(rows) from the user_role table
	 * with a classroom_id that matches $this->id.
	 * @return Query
	 */
	function getUserRolesRelatedByClassroomIdQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user_role', 'classroom_id', 'id', $q);
	}

	/**
	 * Returns the count of UserRole Objects(rows) from the user_role table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function countUserRolesRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		return UserRole::doCount($this->getUserRolesRelatedByClassroomIdQuery($q));
	}

	/**
	 * Deletes the user_role Objects(rows) from the user_role table
	 * with a classroom_id that matches $this->id.
	 * @return int
	 */
	function deleteUserRolesRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return 0;
		}
		$this->UserRolesRelatedByClassroomId_c = array();
		return UserRole::doDelete($this->getUserRolesRelatedByClassroomIdQuery($q));
	}

	protected $UserRolesRelatedByClassroomId_c = array();

	/**
	 * Returns an array of UserRole objects with a classroom_id
	 * that matches $this->id.
	 * When first called, this method will cache the result.
	 * After that, if $this->id is not modified, the
	 * method will return the cached result instead of querying the database
	 * a second time(for performance purposes).
	 * @return UserRole[]
	 */
	function getUserRolesRelatedByClassroomId(Query $q = null) {
		if (null === $this->getid()) {
			return array();
		}

		if (
			null === $q
			&& $this->getCacheResults()
			&& !empty($this->UserRolesRelatedByClassroomId_c)
			&& !$this->isColumnModified('id')
		) {
			return $this->UserRolesRelatedByClassroomId_c;
		}

		$result = UserRole::doSelect($this->getUserRolesRelatedByClassroomIdQuery($q));

		if ($q !== null) {
			return $result;
		}

		if ($this->getCacheResults()) {
			$this->UserRolesRelatedByClassroomId_c = $result;
		}
		return $result;
	}

	/**
	 * Convenience function for Classroom::getDevicesRelatedByclassroom_id
	 * @return Device[]
	 * @see Classroom::getDevicesRelatedByClassroomId
	 */
	function getDevices($extra = null) {
		return $this->getDevicesRelatedByClassroomId($extra);
	}

	/**
	  * Convenience function for Classroom::getDevicesRelatedByclassroom_idQuery
	  * @return Query
	  * @see Classroom::getDevicesRelatedByclassroom_idQuery
	  */
	function getDevicesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('device', 'classroom_id','id', $q);
	}

	/**
	  * Convenience function for Classroom::deleteDevicesRelatedByclassroom_id
	  * @return int
	  * @see Classroom::deleteDevicesRelatedByclassroom_id
	  */
	function deleteDevices(Query $q = null) {
		return $this->deleteDevicesRelatedByClassroomId($q);
	}

	/**
	  * Convenience function for Classroom::countDevicesRelatedByclassroom_id
	  * @return int
	  * @see Classroom::countDevicesRelatedByClassroomId
	  */
	function countDevices(Query $q = null) {
		return $this->countDevicesRelatedByClassroomId($q);
	}

	/**
	 * Convenience function for Classroom::getQuizsRelatedByclassroom_id
	 * @return Quiz[]
	 * @see Classroom::getQuizsRelatedByClassroomId
	 */
	function getQuizs($extra = null) {
		return $this->getQuizsRelatedByClassroomId($extra);
	}

	/**
	  * Convenience function for Classroom::getQuizsRelatedByclassroom_idQuery
	  * @return Query
	  * @see Classroom::getQuizsRelatedByclassroom_idQuery
	  */
	function getQuizsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('quiz', 'classroom_id','id', $q);
	}

	/**
	  * Convenience function for Classroom::deleteQuizsRelatedByclassroom_id
	  * @return int
	  * @see Classroom::deleteQuizsRelatedByclassroom_id
	  */
	function deleteQuizs(Query $q = null) {
		return $this->deleteQuizsRelatedByClassroomId($q);
	}

	/**
	  * Convenience function for Classroom::countQuizsRelatedByclassroom_id
	  * @return int
	  * @see Classroom::countQuizsRelatedByClassroomId
	  */
	function countQuizs(Query $q = null) {
		return $this->countQuizsRelatedByClassroomId($q);
	}

	/**
	 * Convenience function for Classroom::getSessionsRelatedByclassroom_id
	 * @return Session[]
	 * @see Classroom::getSessionsRelatedByClassroomId
	 */
	function getSessions($extra = null) {
		return $this->getSessionsRelatedByClassroomId($extra);
	}

	/**
	  * Convenience function for Classroom::getSessionsRelatedByclassroom_idQuery
	  * @return Query
	  * @see Classroom::getSessionsRelatedByclassroom_idQuery
	  */
	function getSessionsQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('session', 'classroom_id','id', $q);
	}

	/**
	  * Convenience function for Classroom::deleteSessionsRelatedByclassroom_id
	  * @return int
	  * @see Classroom::deleteSessionsRelatedByclassroom_id
	  */
	function deleteSessions(Query $q = null) {
		return $this->deleteSessionsRelatedByClassroomId($q);
	}

	/**
	  * Convenience function for Classroom::countSessionsRelatedByclassroom_id
	  * @return int
	  * @see Classroom::countSessionsRelatedByClassroomId
	  */
	function countSessions(Query $q = null) {
		return $this->countSessionsRelatedByClassroomId($q);
	}

	/**
	 * Convenience function for Classroom::getUserRolesRelatedByclassroom_id
	 * @return UserRole[]
	 * @see Classroom::getUserRolesRelatedByClassroomId
	 */
	function getUserRoles($extra = null) {
		return $this->getUserRolesRelatedByClassroomId($extra);
	}

	/**
	  * Convenience function for Classroom::getUserRolesRelatedByclassroom_idQuery
	  * @return Query
	  * @see Classroom::getUserRolesRelatedByclassroom_idQuery
	  */
	function getUserRolesQuery(Query $q = null) {
		return $this->getForeignObjectsQuery('user_role', 'classroom_id','id', $q);
	}

	/**
	  * Convenience function for Classroom::deleteUserRolesRelatedByclassroom_id
	  * @return int
	  * @see Classroom::deleteUserRolesRelatedByclassroom_id
	  */
	function deleteUserRoles(Query $q = null) {
		return $this->deleteUserRolesRelatedByClassroomId($q);
	}

	/**
	  * Convenience function for Classroom::countUserRolesRelatedByclassroom_id
	  * @return int
	  * @see Classroom::countUserRolesRelatedByClassroomId
	  */
	function countUserRoles(Query $q = null) {
		return $this->countUserRolesRelatedByClassroomId($q);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getsession_id()) {
			$this->_validationErrors[] = 'session_id must not be null';
		}
		if (null === $this->getname()) {
			$this->_validationErrors[] = 'name must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}