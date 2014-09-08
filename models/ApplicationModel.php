<?php

abstract class ApplicationModel extends Model {

	/**
	 * @return	string
	 */
	function getStatus() {
		return method_exists($this, 'getArchived') && $this->getArchived() ? 'Deleted' : 'Active';
	}

	/**
	 * @return	User
	 */
	function getCreatedByUser() {
		return method_exists($this, 'getSession') && $this->getSession() ? $this->getSession()->getUser() : null;
	}

	/**
	 * @return string
	 */
	function getCreatedByUserEmail() {
		return $this->getCreatedByUser() ? $this->getCreatedByUser()->getEmail() : null;
	}

	/**
	 * @param	User	$user
	 * @return	boolean
	 */
	function wasCreatedBy(User $user) {
		if (!method_exists($this, 'getSession')) {
			return false;
		}

		return ($this->getSession() && $this->getSession()->getUserId() == $user->getId());
	}

	function delete($override = false) {

		if (method_exists($this, 'getArchived') && $override == false) {
			$this->setArchived(time());
			$this->save();
			return true;
		}

		return parent::delete();
	}

	function activate() {
		if (!method_exists($this, 'getArchived')) {
			throw new RuntimeException('Error: Record of type "' . get_class($this) . '" does not have an activate method.');
		}

		$this->setArchived(null);
		return $this->save();
	}
}